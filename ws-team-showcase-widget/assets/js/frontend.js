(function () {
	'use strict';

	function toNumber(value, fallback) {
		var parsed = parseInt(value, 10);
		return Number.isNaN(parsed) ? fallback : parsed;
	}

	function getVisibleSlides(showcase) {
		var value = window.getComputedStyle(showcase).getPropertyValue('--ws-carousel-items');
		return Math.max(1, toNumber(value, 1));
	}

	function toMilliseconds(value, fallback) {
		var raw = String(value || '').trim();
		var parsed = parseFloat(raw);

		if (Number.isNaN(parsed)) {
			return fallback;
		}

		return raw.indexOf('ms') > -1 ? parsed : parsed * 1000;
	}

	function initLoadMore(showcase) {
		var button = showcase.querySelector('.ws-team-showcase__load-more');
		var cards = Array.prototype.slice.call(showcase.querySelectorAll('.ws-team-showcase__card'));
		var perPage = toNumber(showcase.getAttribute('data-items-per-page'), 6);
		var state = {
			matches: cards.map(function (card) {
				return toNumber(card.dataset.memberIndex, 0);
			}),
			visible: perPage
		};

		if (!cards.length) {
			return;
		}

		function applyMatches(matches, visibleCount) {
			var visibleMap = {};
			var noResults = showcase.querySelector('.ws-team-showcase__no-results');

			state.matches = matches;
			state.visible = visibleCount;

			matches.slice(0, visibleCount).forEach(function (index) {
				visibleMap[index] = true;
			});

			cards.forEach(function (card) {
				var index = toNumber(card.dataset.memberIndex, 0);
				card.classList.toggle('ws-team-showcase__card--hidden', !visibleMap[index]);
			});

			if (button && button.parentElement) {
				button.parentElement.style.display = matches.length > visibleCount ? 'flex' : 'none';
			}

			if (noResults) {
				noResults.hidden = matches.length > 0;
			}
		}

		function collectItems() {
			return cards.map(function (card) {
				return {
					index: card.dataset.memberIndex || '0',
					name: card.dataset.memberName || '',
					designation: card.dataset.memberDesignation || '',
					department: card.dataset.memberDepartment || '',
					bio: card.dataset.memberBio || ''
				};
			});
		}

		function filterMembers() {
			var search = showcase.querySelector('.ws-team-showcase__search-input');
			var filter = showcase.querySelector('.ws-team-showcase__filter-select');
			var params = new window.URLSearchParams();

			if (!window.wsTeamShowcase || !window.wsTeamShowcase.ajaxUrl) {
				return;
			}

			params.append('action', 'ws_team_showcase_filter');
			params.append('nonce', window.wsTeamShowcase.nonce || '');
			params.append('search', search ? search.value : '');
			params.append('designation', filter ? filter.value : '');

			collectItems().forEach(function (item, itemIndex) {
				Object.keys(item).forEach(function (key) {
					params.append('items[' + itemIndex + '][' + key + ']', item[key]);
				});
			});

			showcase.classList.add('ws-team-showcase--loading');

			window.fetch(window.wsTeamShowcase.ajaxUrl, {
				method: 'POST',
				credentials: 'same-origin',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
				},
				body: params.toString()
			})
				.then(function (response) {
					return response.json();
				})
				.then(function (response) {
					var matches = response && response.success && response.data ? response.data.matches : [];
					applyMatches(matches.map(function (index) {
						return toNumber(index, 0);
					}), perPage);
				})
				.catch(function () {
					applyMatches(state.matches, perPage);
				})
				.finally(function () {
					showcase.classList.remove('ws-team-showcase--loading');
				});
		}

		function debounce(fn, wait) {
			var timer = null;

			return function () {
				window.clearTimeout(timer);
				timer = window.setTimeout(fn, wait);
			};
		}

		if (button) {
			button.addEventListener('click', function () {
				applyMatches(state.matches, state.visible + perPage);
			});
		}

		var searchInput = showcase.querySelector('.ws-team-showcase__search-input');
		var filterSelect = showcase.querySelector('.ws-team-showcase__filter-select');
		var debouncedFilter = debounce(filterMembers, 250);

		if (searchInput) {
			searchInput.addEventListener('input', debouncedFilter);
		}

		if (filterSelect) {
			filterSelect.addEventListener('change', filterMembers);
		}

		applyMatches(state.matches, perPage);
	}

	function initCarousel(showcase) {
		var track = showcase.querySelector('.ws-team-showcase__grid');
		var cards = Array.prototype.slice.call(showcase.querySelectorAll('.ws-team-showcase__card'));
		var prev = showcase.querySelector('.ws-team-showcase__carousel-button--prev');
		var next = showcase.querySelector('.ws-team-showcase__carousel-button--next');
		var dotsWrap = showcase.querySelector('.ws-team-showcase__dots');
		var loop = showcase.getAttribute('data-loop') === 'yes';
		var autoplay = showcase.getAttribute('data-autoplay') === 'yes';
		var delay = toNumber(showcase.getAttribute('data-autoplay-delay'), 3000);
		var speed = toNumber(showcase.getAttribute('data-speed'), 350);
		var index = 0;
		var timer = null;

		if (!track || !cards.length) {
			return;
		}

		track.style.transitionDuration = speed + 'ms';

		function getMaxIndex() {
			return Math.max(0, cards.length - getVisibleSlides(showcase));
		}

		function setIndex(nextIndex) {
			var maxIndex = getMaxIndex();

			if (loop) {
				if (nextIndex > maxIndex) {
					nextIndex = 0;
				}

				if (nextIndex < 0) {
					nextIndex = maxIndex;
				}
			} else {
				nextIndex = Math.min(Math.max(nextIndex, 0), maxIndex);
			}

			index = nextIndex;
			update();
		}

		function renderDots() {
			var maxIndex = getMaxIndex();

			if (!dotsWrap) {
				return;
			}

			dotsWrap.innerHTML = '';

			for (var i = 0; i <= maxIndex; i += 1) {
				var dot = document.createElement('button');
				dot.type = 'button';
				dot.className = 'ws-team-showcase__dot';
				dot.setAttribute('aria-label', 'Go to slide ' + (i + 1));
				dot.dataset.index = String(i);
				dotsWrap.appendChild(dot);
			}
		}

		function update() {
			var maxIndex = getMaxIndex();
			var offset = cards[index] ? cards[index].offsetLeft : 0;

			track.style.transform = 'translateX(-' + offset + 'px)';

			if (prev && next && !loop) {
				prev.disabled = index <= 0;
				next.disabled = index >= maxIndex;
			}

			if (dotsWrap) {
				Array.prototype.forEach.call(dotsWrap.children, function (dot, dotIndex) {
					dot.classList.toggle('is-active', dotIndex === index);
				});
			}
		}

		function restartAutoplay() {
			if (!autoplay || getMaxIndex() <= 0) {
				return;
			}

			window.clearInterval(timer);
			timer = window.setInterval(function () {
				setIndex(index + 1);
			}, delay);
		}

		if (prev) {
			prev.addEventListener('click', function () {
				setIndex(index - 1);
				restartAutoplay();
			});
		}

		if (next) {
			next.addEventListener('click', function () {
				setIndex(index + 1);
				restartAutoplay();
			});
		}

		if (dotsWrap) {
			dotsWrap.addEventListener('click', function (event) {
				var target = event.target.closest('.ws-team-showcase__dot');

				if (!target) {
					return;
				}

				setIndex(toNumber(target.dataset.index, 0));
				restartAutoplay();
			});
		}

		showcase.addEventListener('mouseenter', function () {
			window.clearInterval(timer);
		});

		showcase.addEventListener('mouseleave', restartAutoplay);

		window.addEventListener('resize', function () {
			renderDots();
			setIndex(Math.min(index, getMaxIndex()));
		});

		renderDots();
		update();
		restartAutoplay();
	}

	function initProfilePopup(showcase) {
		var modal = showcase.querySelector('.ws-team-showcase__modal');
		var nameNode = modal ? modal.querySelector('.ws-team-showcase__modal-name') : null;
		var designationNode = modal ? modal.querySelector('.ws-team-showcase__modal-designation') : null;
		var descriptionNode = modal ? modal.querySelector('.ws-team-showcase__modal-description') : null;
		var closeButton = modal ? modal.querySelector('.ws-team-showcase__modal-close') : null;
		var previousFocus = null;
		var closeTimer = null;

		if (!modal) {
			return;
		}

		function getFocusableItems() {
			return Array.prototype.slice.call(modal.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])')).filter(function (item) {
				return !item.disabled && item.offsetParent !== null;
			});
		}

		function openModal(button) {
			window.clearTimeout(closeTimer);
			previousFocus = document.activeElement;

			if (nameNode) {
				nameNode.textContent = button.dataset.profileName || '';
			}

			if (designationNode) {
				designationNode.textContent = button.dataset.profileDesignation || '';
				designationNode.hidden = !button.dataset.profileDesignation;
			}

			if (descriptionNode) {
				descriptionNode.textContent = button.dataset.profileDescription || '';
			}

			modal.hidden = false;
			modal.classList.remove('is-closing');
			document.body.classList.add('ws-team-showcase-modal-open');
			window.requestAnimationFrame(function () {
				modal.classList.add('is-open');
			});

			if (closeButton) {
				closeButton.focus();
			}
		}

		function closeModal() {
			var duration = toMilliseconds(window.getComputedStyle(showcase).getPropertyValue('--ws-popup-animation-duration'), 220);

			if (modal.hidden) {
				return;
			}

			modal.classList.remove('is-open');
			modal.classList.add('is-closing');
			document.body.classList.remove('ws-team-showcase-modal-open');

			closeTimer = window.setTimeout(function () {
				modal.hidden = true;
				modal.classList.remove('is-closing');

				if (previousFocus && typeof previousFocus.focus === 'function') {
					previousFocus.focus();
				}
			}, duration + 30);
		}

		showcase.addEventListener('click', function (event) {
			var openButton = event.target.closest('[data-ws-profile-popup]');
			var closeTarget = event.target.closest('[data-ws-profile-popup-close]');

			if (openButton) {
				event.preventDefault();
				openModal(openButton);
				return;
			}

			if (closeTarget) {
				closeModal();
			}
		});

		modal.addEventListener('keydown', function (event) {
			var focusableItems;
			var firstItem;
			var lastItem;

			if (event.key === 'Escape') {
				closeModal();
				return;
			}

			if (event.key !== 'Tab') {
				return;
			}

			focusableItems = getFocusableItems();
			firstItem = focusableItems[0];
			lastItem = focusableItems[focusableItems.length - 1];

			if (!firstItem || !lastItem) {
				return;
			}

			if (event.shiftKey && document.activeElement === firstItem) {
				event.preventDefault();
				lastItem.focus();
			} else if (!event.shiftKey && document.activeElement === lastItem) {
				event.preventDefault();
				firstItem.focus();
			}
		});
	}

	function initShowcase(showcase) {
		if (showcase.dataset.wsTeamShowcaseReady === 'yes') {
			return;
		}

		showcase.dataset.wsTeamShowcaseReady = 'yes';

		if (showcase.getAttribute('data-layout') === 'carousel') {
			initCarousel(showcase);
		} else {
			initLoadMore(showcase);
		}

		initProfilePopup(showcase);
	}

	function initAll(context) {
		var scope = context || document;
		var showcases = scope.querySelectorAll('[data-ws-team-showcase]');

		Array.prototype.forEach.call(showcases, initShowcase);
	}

	document.addEventListener('DOMContentLoaded', function () {
		initAll(document);
	});

	window.addEventListener('load', function () {
		initAll(document);
	});

	if (window.elementorFrontend && window.elementorFrontend.hooks) {
		window.elementorFrontend.hooks.addAction('frontend/element_ready/ws_team_showcase.default', function ($scope) {
			var node = $scope && $scope[0] ? $scope[0] : document;
			initAll(node);
		});
	}
}());
