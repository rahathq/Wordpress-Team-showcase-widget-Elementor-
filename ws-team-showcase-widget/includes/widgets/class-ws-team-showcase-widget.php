<?php
/**
 * WS Team Showcase Elementor widget.
 *
 * @package WS_Team_Showcase_Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Team showcase widget.
 */
class WS_Team_Showcase_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'ws_team_showcase';
	}

	/**
	 * Get widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return esc_html__( 'WS Team Showcase', 'ws-team-showcase-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-person';
	}

	/**
	 * Get widget categories.
	 *
	 * @return array
	 */
	public function get_categories() {
		return array( 'general' );
	}

	/**
	 * Get style dependencies.
	 *
	 * @return array
	 */
	public function get_style_depends() {
		return array( 'ws-team-showcase' );
	}

	/**
	 * Get script dependencies.
	 *
	 * @return array
	 */
	public function get_script_depends() {
		return array( 'ws-team-showcase' );
	}

	/**
	 * Register widget controls.
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'Section Content', 'ws-team-showcase-widget' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'       => esc_html__( 'Heading', 'ws-team-showcase-widget' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Our Team', 'ws-team-showcase-widget' ),
				'placeholder' => esc_html__( 'Enter heading', 'ws-team-showcase-widget' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'show_description',
			array(
				'label'        => esc_html__( 'Show Description', 'ws-team-showcase-widget' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'ws-team-showcase-widget' ),
				'label_off'    => esc_html__( 'Hide', 'ws-team-showcase-widget' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => esc_html__( 'Description', 'ws-team-showcase-widget' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Meet the people bringing strategy, creativity, and technical care to every project.', 'ws-team-showcase-widget' ),
				'placeholder' => esc_html__( 'Enter section description', 'ws-team-showcase-widget' ),
				'rows'        => 3,
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'show_description' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_member',
			array(
				'label' => esc_html__( 'Team Members', 'ws-team-showcase-widget' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'member_image',
			array(
				'label'   => esc_html__( 'Profile Image', 'ws-team-showcase-widget' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'member_name',
			array(
				'label'       => esc_html__( 'Name', 'ws-team-showcase-widget' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Jane Cooper', 'ws-team-showcase-widget' ),
				'placeholder' => esc_html__( 'Enter member name', 'ws-team-showcase-widget' ),
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'member_designation',
			array(
				'label'       => esc_html__( 'Designation', 'ws-team-showcase-widget' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Creative Director', 'ws-team-showcase-widget' ),
				'placeholder' => esc_html__( 'Enter designation', 'ws-team-showcase-widget' ),
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'member_department',
			array(
				'label'       => esc_html__( 'Department', 'ws-team-showcase-widget' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Design', 'ws-team-showcase-widget' ),
				'placeholder' => esc_html__( 'Example: Design, Development, Marketing', 'ws-team-showcase-widget' ),
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'member_experience',
			array(
				'label'       => esc_html__( 'Experience', 'ws-team-showcase-widget' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( '8+ Years', 'ws-team-showcase-widget' ),
				'placeholder' => esc_html__( 'Example: 5+ Years', 'ws-team-showcase-widget' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'member_bio',
			array(
				'label'       => esc_html__( 'Short Bio', 'ws-team-showcase-widget' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Leads brand systems, campaign direction, and polished digital experiences for ambitious teams.', 'ws-team-showcase-widget' ),
				'placeholder' => esc_html__( 'Enter a short description', 'ws-team-showcase-widget' ),
				'rows'        => 4,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'member_detailed_description',
			array(
				'label'       => esc_html__( 'Detailed Description', 'ws-team-showcase-widget' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Add a fuller profile description here. This content appears inside the profile popup when popup mode is enabled.', 'ws-team-showcase-widget' ),
				'placeholder' => esc_html__( 'Enter detailed profile description', 'ws-team-showcase-widget' ),
				'rows'        => 8,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'linkedin_url',
			array(
				'label'       => esc_html__( 'LinkedIn URL', 'ws-team-showcase-widget' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => 'https://linkedin.com/in/username',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'twitter_url',
			array(
				'label'       => esc_html__( 'X / Twitter URL', 'ws-team-showcase-widget' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => 'https://x.com/username',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'facebook_url',
			array(
				'label'       => esc_html__( 'Facebook URL', 'ws-team-showcase-widget' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => 'https://facebook.com/username',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'instagram_url',
			array(
				'label'       => esc_html__( 'Instagram URL', 'ws-team-showcase-widget' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => 'https://instagram.com/username',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'button_text',
			array(
				'label'       => esc_html__( 'Button Text', 'ws-team-showcase-widget' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'View Profile', 'ws-team-showcase-widget' ),
				'placeholder' => esc_html__( 'Enter button text', 'ws-team-showcase-widget' ),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$repeater->add_control(
			'button_url',
			array(
				'label'       => esc_html__( 'Button URL', 'ws-team-showcase-widget' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => 'https://example.com',
				'default'     => array(
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => false,
				),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'show_profile_button',
			array(
				'label'        => esc_html__( 'Show Profile Button', 'ws-team-showcase-widget' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'ws-team-showcase-widget' ),
				'label_off'    => esc_html__( 'Hide', 'ws-team-showcase-widget' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'profile_button_action',
			array(
				'label'     => esc_html__( 'Button Action', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'link',
				'options'   => array(
					'link'  => esc_html__( 'Open Link', 'ws-team-showcase-widget' ),
					'popup' => esc_html__( 'Open Popup', 'ws-team-showcase-widget' ),
				),
				'condition' => array(
					'show_profile_button' => 'yes',
				),
			)
		);

		$this->add_control(
			'profile_popup_animation',
			array(
				'label'     => esc_html__( 'Popup Animation', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'zoom',
				'options'   => array(
					'fade'     => esc_html__( 'Fade', 'ws-team-showcase-widget' ),
					'zoom'     => esc_html__( 'Zoom', 'ws-team-showcase-widget' ),
					'slide-up' => esc_html__( 'Slide Up', 'ws-team-showcase-widget' ),
					'flip'     => esc_html__( 'Flip', 'ws-team-showcase-widget' ),
				),
				'condition' => array(
					'show_profile_button'   => 'yes',
					'profile_button_action' => 'popup',
				),
			)
		);

		$this->add_control(
			'profile_popup_animation_duration',
			array(
				'label'      => esc_html__( 'Popup Animation Duration', 'ws-team-showcase-widget' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'ms' ),
				'range'      => array(
					'ms' => array(
						'min'  => 100,
						'max'  => 1200,
						'step' => 50,
					),
				),
				'default'    => array(
					'unit' => 'ms',
					'size' => 220,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ws-team-showcase' => '--ws-popup-animation-duration: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'show_profile_button'   => 'yes',
					'profile_button_action' => 'popup',
				),
			)
		);

		$this->add_control(
			'team_members',
			array(
				'label'       => esc_html__( 'Members', 'ws-team-showcase-widget' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'member_name'        => esc_html__( 'Jane Cooper', 'ws-team-showcase-widget' ),
						'member_designation' => esc_html__( 'Creative Director', 'ws-team-showcase-widget' ),
						'member_department'  => esc_html__( 'Design', 'ws-team-showcase-widget' ),
						'member_experience'  => esc_html__( '8+ Years', 'ws-team-showcase-widget' ),
						'member_bio'         => esc_html__( 'Leads brand systems, campaign direction, and polished digital experiences for ambitious teams.', 'ws-team-showcase-widget' ),
						'member_detailed_description' => esc_html__( 'Jane combines creative direction with practical delivery, helping teams turn loose brand ideas into clear visual systems and polished campaign assets.', 'ws-team-showcase-widget' ),
						'button_text'        => esc_html__( 'View Profile', 'ws-team-showcase-widget' ),
						'button_url'         => array(
							'url' => '#',
						),
					),
					array(
						'member_name'        => esc_html__( 'Michael Chen', 'ws-team-showcase-widget' ),
						'member_designation' => esc_html__( 'Lead Developer', 'ws-team-showcase-widget' ),
						'member_department'  => esc_html__( 'Development', 'ws-team-showcase-widget' ),
						'member_experience'  => esc_html__( '10+ Years', 'ws-team-showcase-widget' ),
						'member_bio'         => esc_html__( 'Builds scalable WordPress systems, custom integrations, and reliable frontend experiences.', 'ws-team-showcase-widget' ),
						'member_detailed_description' => esc_html__( 'Michael focuses on dependable architecture, clean integrations, and frontend details that make custom WordPress builds easier to maintain.', 'ws-team-showcase-widget' ),
						'button_text'        => esc_html__( 'View Profile', 'ws-team-showcase-widget' ),
						'button_url'         => array(
							'url' => '#',
						),
					),
					array(
						'member_name'        => esc_html__( 'Ava Martinez', 'ws-team-showcase-widget' ),
						'member_designation' => esc_html__( 'Marketing Strategist', 'ws-team-showcase-widget' ),
						'member_department'  => esc_html__( 'Marketing', 'ws-team-showcase-widget' ),
						'member_experience'  => esc_html__( '6+ Years', 'ws-team-showcase-widget' ),
						'member_bio'         => esc_html__( 'Turns audience research into campaigns that are clear, measurable, and conversion-focused.', 'ws-team-showcase-widget' ),
						'member_detailed_description' => esc_html__( 'Ava translates audience research into practical messaging, campaign plans, and reporting workflows that help teams understand what is working.', 'ws-team-showcase-widget' ),
						'button_text'        => esc_html__( 'View Profile', 'ws-team-showcase-widget' ),
						'button_url'         => array(
							'url' => '#',
						),
					),
				),
				'title_field' => '{{{ member_name }}} - {{{ member_department }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_layout',
			array(
				'label' => esc_html__( 'Layout & Pagination', 'ws-team-showcase-widget' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'layout_type',
			array(
				'label'   => esc_html__( 'Layout Type', 'ws-team-showcase-widget' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'grid',
				'options' => array(
					'grid'     => esc_html__( 'Loop Grid', 'ws-team-showcase-widget' ),
					'carousel' => esc_html__( 'Loop Carousel', 'ws-team-showcase-widget' ),
				),
			)
		);

		$this->add_control(
			'items_per_page',
			array(
				'label'     => esc_html__( 'Items Per Page', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 50,
				'step'      => 1,
				'default'   => 6,
				'condition' => array(
					'layout_type' => 'grid',
				),
			)
		);

		$this->add_responsive_control(
			'layout_grid_columns',
			array(
				'label'     => esc_html__( 'Grid Columns', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '3',
				'options'   => array(
					'1' => esc_html__( '1 Column', 'ws-team-showcase-widget' ),
					'2' => esc_html__( '2 Columns', 'ws-team-showcase-widget' ),
					'3' => esc_html__( '3 Columns', 'ws-team-showcase-widget' ),
					'4' => esc_html__( '4 Columns', 'ws-team-showcase-widget' ),
					'5' => esc_html__( '5 Columns', 'ws-team-showcase-widget' ),
					'6' => esc_html__( '6 Columns', 'ws-team-showcase-widget' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase--grid .ws-team-showcase__grid' => 'grid-template-columns: repeat({{VALUE}}, minmax(0, 1fr));',
				),
				'condition' => array(
					'layout_type' => 'grid',
				),
			)
		);

		$this->add_control(
			'load_more_text',
			array(
				'label'     => esc_html__( 'Load More Text', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Load More', 'ws-team-showcase-widget' ),
				'condition' => array(
					'layout_type' => 'grid',
				),
			)
		);

		$this->add_responsive_control(
			'carousel_slides_per_view',
			array(
				'label'     => esc_html__( 'Slides Per View', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '3',
				'options'   => array(
					'1' => esc_html__( '1 Slide', 'ws-team-showcase-widget' ),
					'2' => esc_html__( '2 Slides', 'ws-team-showcase-widget' ),
					'3' => esc_html__( '3 Slides', 'ws-team-showcase-widget' ),
					'4' => esc_html__( '4 Slides', 'ws-team-showcase-widget' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase' => '--ws-carousel-items: {{VALUE}};',
				),
				'condition' => array(
					'layout_type' => 'carousel',
				),
			)
		);

		$this->add_control(
			'carousel_navigation',
			array(
				'label'        => esc_html__( 'Show Arrows', 'ws-team-showcase-widget' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'ws-team-showcase-widget' ),
				'label_off'    => esc_html__( 'Hide', 'ws-team-showcase-widget' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'layout_type' => 'carousel',
				),
			)
		);

		$this->add_control(
			'carousel_dots',
			array(
				'label'        => esc_html__( 'Show Dots', 'ws-team-showcase-widget' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'ws-team-showcase-widget' ),
				'label_off'    => esc_html__( 'Hide', 'ws-team-showcase-widget' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'layout_type' => 'carousel',
				),
			)
		);

		$this->add_control(
			'carousel_loop',
			array(
				'label'        => esc_html__( 'Loop', 'ws-team-showcase-widget' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'ws-team-showcase-widget' ),
				'label_off'    => esc_html__( 'No', 'ws-team-showcase-widget' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'layout_type' => 'carousel',
				),
			)
		);

		$this->add_control(
			'carousel_autoplay',
			array(
				'label'        => esc_html__( 'Autoplay', 'ws-team-showcase-widget' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'ws-team-showcase-widget' ),
				'label_off'    => esc_html__( 'No', 'ws-team-showcase-widget' ),
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => array(
					'layout_type' => 'carousel',
				),
			)
		);

		$this->add_control(
			'carousel_autoplay_delay',
			array(
				'label'     => esc_html__( 'Autoplay Delay', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 1000,
				'max'       => 10000,
				'step'      => 500,
				'default'   => 3000,
				'condition' => array(
					'layout_type'       => 'carousel',
					'carousel_autoplay' => 'yes',
				),
			)
		);

		$this->add_control(
			'carousel_speed',
			array(
				'label'     => esc_html__( 'Transition Speed', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 100,
				'max'       => 3000,
				'step'      => 50,
				'default'   => 350,
				'condition' => array(
					'layout_type' => 'carousel',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_grid_search_filter',
			array(
				'label'     => esc_html__( 'Grid Search & Filter', 'ws-team-showcase-widget' ),
				'tab'       => \Elementor\Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'layout_type' => 'grid',
				),
			)
		);

		$this->add_control(
			'show_search',
			array(
				'label'        => esc_html__( 'Show Search', 'ws-team-showcase-widget' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'ws-team-showcase-widget' ),
				'label_off'    => esc_html__( 'Hide', 'ws-team-showcase-widget' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'search_placeholder',
			array(
				'label'     => esc_html__( 'Search Placeholder', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'Search team members...', 'ws-team-showcase-widget' ),
				'condition' => array(
					'show_search' => 'yes',
				),
			)
		);

		$this->add_control(
			'show_designation_filter',
			array(
				'label'        => esc_html__( 'Show Designation Filter', 'ws-team-showcase-widget' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'ws-team-showcase-widget' ),
				'label_off'    => esc_html__( 'Hide', 'ws-team-showcase-widget' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'designation_all_label',
			array(
				'label'     => esc_html__( 'All Filter Label', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'default'   => esc_html__( 'All Designations', 'ws-team-showcase-widget' ),
				'condition' => array(
					'show_designation_filter' => 'yes',
				),
			)
		);

		$this->add_control(
			'no_results_text',
			array(
				'label'   => esc_html__( 'No Results Text', 'ws-team-showcase-widget' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'No team members found.', 'ws-team-showcase-widget' ),
			)
		);

		$this->end_controls_section();

		$this->register_style_controls();
	}

	/**
	 * Register Style tab controls.
	 */
	private function register_style_controls() {
		$this->start_controls_section(
			'section_heading_style',
			array(
				'label' => esc_html__( 'Heading', 'ws-team-showcase-widget' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'heading_alignment',
			array(
				'label'     => esc_html__( 'Alignment', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'ws-team-showcase-widget' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'ws-team-showcase-widget' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'ws-team-showcase-widget' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'left',
				'toggle'    => false,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__heading' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'heading_color',
			array(
				'label'     => esc_html__( 'Text Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__heading' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'label'    => esc_html__( 'Heading Typography', 'ws-team-showcase-widget' ),
				'selector' => '{{WRAPPER}} .ws-team-showcase__heading',
			)
		);

		$this->add_responsive_control(
			'heading_spacing',
			array(
				'label'      => esc_html__( 'Bottom Spacing', 'ws-team-showcase-widget' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ws-team-showcase__heading' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'description_style_heading',
			array(
				'label'     => esc_html__( 'Description', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'show_description' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'description_alignment',
			array(
				'label'     => esc_html__( 'Description Alignment', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'ws-team-showcase-widget' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'ws-team-showcase-widget' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'ws-team-showcase-widget' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'left',
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__description' => 'text-align: {{VALUE}};',
				),
				'condition' => array(
					'show_description' => 'yes',
				),
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => esc_html__( 'Description Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__description' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'show_description' => 'yes',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'      => 'description_typography',
				'label'     => esc_html__( 'Description Typography', 'ws-team-showcase-widget' ),
				'selector'  => '{{WRAPPER}} .ws-team-showcase__description',
				'condition' => array(
					'show_description' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'description_spacing',
			array(
				'label'      => esc_html__( 'Description Bottom Spacing', 'ws-team-showcase-widget' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ws-team-showcase__description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'show_description' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_card_style',
			array(
				'label' => esc_html__( 'Card', 'ws-team-showcase-widget' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'card_background',
			array(
				'label'     => esc_html__( 'Background Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__card' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			array(
				'name'     => 'card_border',
				'label'    => esc_html__( 'Border', 'ws-team-showcase-widget' ),
				'selector' => '{{WRAPPER}} .ws-team-showcase__card',
			)
		);

		$this->add_responsive_control(
			'card_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'ws-team-showcase-widget' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .ws-team-showcase__card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'card_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'ws-team-showcase-widget' ),
				'selector' => '{{WRAPPER}} .ws-team-showcase__card',
			)
		);

		$this->add_control(
			'card_hover_animation',
			array(
				'label'     => esc_html__( 'Hover Animation', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'lift',
				'options'   => array(
					'none'  => esc_html__( 'None', 'ws-team-showcase-widget' ),
					'lift'  => esc_html__( 'Lift', 'ws-team-showcase-widget' ),
					'scale' => esc_html__( 'Scale', 'ws-team-showcase-widget' ),
					'glow'  => esc_html__( 'Glow', 'ws-team-showcase-widget' ),
					'tilt'  => esc_html__( 'Tilt', 'ws-team-showcase-widget' ),
				),
			)
		);

		$this->add_control(
			'card_hover_animation_duration',
			array(
				'label'      => esc_html__( 'Hover Animation Duration', 'ws-team-showcase-widget' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'ms' ),
				'range'      => array(
					'ms' => array(
						'min'  => 100,
						'max'  => 1200,
						'step' => 50,
					),
				),
				'default'    => array(
					'unit' => 'ms',
					'size' => 220,
				),
				'selectors'  => array(
					'{{WRAPPER}} .ws-team-showcase' => '--ws-card-hover-duration: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'card_padding',
			array(
				'label'      => esc_html__( 'Content Padding', 'ws-team-showcase-widget' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .ws-team-showcase__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'card_text_alignment',
			array(
				'label'     => esc_html__( 'Content Alignment', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'ws-team-showcase-widget' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'ws-team-showcase-widget' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'ws-team-showcase-widget' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'left',
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__content' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'grid_columns',
			array(
				'label'     => esc_html__( 'Grid Columns', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => '3',
				'options'   => array(
					'1' => esc_html__( '1 Column', 'ws-team-showcase-widget' ),
					'2' => esc_html__( '2 Columns', 'ws-team-showcase-widget' ),
					'3' => esc_html__( '3 Columns', 'ws-team-showcase-widget' ),
					'4' => esc_html__( '4 Columns', 'ws-team-showcase-widget' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__grid' => 'grid-template-columns: repeat({{VALUE}}, minmax(0, 1fr));',
				),
			)
		);

		$this->add_responsive_control(
			'grid_gap',
			array(
				'label'      => esc_html__( 'Grid Gap', 'ws-team-showcase-widget' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 80,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ws-team-showcase' => '--ws-grid-gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ws-team-showcase__grid' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			array(
				'label' => esc_html__( 'Image', 'ws-team-showcase-widget' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'image_width',
			array(
				'label'      => esc_html__( 'Image Width', 'ws-team-showcase-widget' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
					'px' => array(
						'min' => 80,
						'max' => 800,
					),
					'%'  => array(
						'min' => 10,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ws-team-showcase__image-wrap' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_max_width',
			array(
				'label'      => esc_html__( 'Image Max Width', 'ws-team-showcase-widget' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
					'px' => array(
						'min' => 80,
						'max' => 800,
					),
					'%'  => array(
						'min' => 10,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ws-team-showcase__image-wrap' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_alignment',
			array(
				'label'     => esc_html__( 'Image Alignment', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => array(
					'0 auto 0 0' => array(
						'title' => esc_html__( 'Left', 'ws-team-showcase-widget' ),
						'icon'  => 'eicon-text-align-left',
					),
					'0 auto'     => array(
						'title' => esc_html__( 'Center', 'ws-team-showcase-widget' ),
						'icon'  => 'eicon-text-align-center',
					),
					'0 0 0 auto' => array(
						'title' => esc_html__( 'Right', 'ws-team-showcase-widget' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__image-wrap' => 'margin: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_height',
			array(
				'label'      => esc_html__( 'Image Height', 'ws-team-showcase-widget' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'vh' ),
				'range'      => array(
					'px' => array(
						'min' => 80,
						'max' => 800,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ws-team-showcase__image-wrap' => 'height: {{SIZE}}{{UNIT}}; aspect-ratio: auto;',
				),
			)
		);

		$this->add_control(
			'image_object_fit',
			array(
				'label'     => esc_html__( 'Image Fit', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'default'   => 'cover',
				'options'   => array(
					'cover'   => esc_html__( 'Cover', 'ws-team-showcase-widget' ),
					'contain' => esc_html__( 'Contain', 'ws-team-showcase-widget' ),
					'fill'    => esc_html__( 'Fill', 'ws-team-showcase-widget' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__image' => 'object-fit: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'image_shape',
			array(
				'label'        => esc_html__( 'Image Shape', 'ws-team-showcase-widget' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'rectangle',
				'options'      => array(
					'rectangle' => esc_html__( 'Rectangle', 'ws-team-showcase-widget' ),
					'rounded'   => esc_html__( 'Rounded', 'ws-team-showcase-widget' ),
					'circle'    => esc_html__( 'Circle', 'ws-team-showcase-widget' ),
				),
				'prefix_class' => 'ws-team-showcase-image-shape-',
			)
		);

		$this->add_responsive_control(
			'image_border_radius',
			array(
				'label'      => esc_html__( 'Custom Image Border Radius', 'ws-team-showcase-widget' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .ws-team-showcase__image-wrap, {{WRAPPER}} .ws-team-showcase__image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_spacing',
			array(
				'label'      => esc_html__( 'Image Bottom Spacing', 'ws-team-showcase-widget' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 80,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ws-team-showcase__image-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			array(
				'label' => esc_html__( 'Card Texts', 'ws-team-showcase-widget' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'department_style_heading',
			array(
				'label' => esc_html__( 'Department Badge', 'ws-team-showcase-widget' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'department_color',
			array(
				'label'     => esc_html__( 'Text Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__department' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'department_background',
			array(
				'label'     => esc_html__( 'Background Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__department' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'department_typography',
				'label'    => esc_html__( 'Department Typography', 'ws-team-showcase-widget' ),
				'selector' => '{{WRAPPER}} .ws-team-showcase__department',
			)
		);

		$this->add_control(
			'name_style_heading',
			array(
				'label'     => esc_html__( 'Member Name', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'name_color',
			array(
				'label'     => esc_html__( 'Text Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__name' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'name_typography',
				'label'    => esc_html__( 'Name Typography', 'ws-team-showcase-widget' ),
				'selector' => '{{WRAPPER}} .ws-team-showcase__name',
			)
		);

		$this->add_control(
			'designation_style_heading',
			array(
				'label'     => esc_html__( 'Designation', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'designation_color',
			array(
				'label'     => esc_html__( 'Text Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__designation' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'designation_typography',
				'label'    => esc_html__( 'Designation Typography', 'ws-team-showcase-widget' ),
				'selector' => '{{WRAPPER}} .ws-team-showcase__designation',
			)
		);

		$this->add_control(
			'bio_style_heading',
			array(
				'label'     => esc_html__( 'Short Bio', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'bio_color',
			array(
				'label'     => esc_html__( 'Text Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__bio' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'bio_typography',
				'label'    => esc_html__( 'Bio Typography', 'ws-team-showcase-widget' ),
				'selector' => '{{WRAPPER}} .ws-team-showcase__bio',
			)
		);

		$this->add_control(
			'experience_style_heading',
			array(
				'label'     => esc_html__( 'Experience Text', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'experience_label_color',
			array(
				'label'     => esc_html__( 'Label Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__meta-label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'experience_value_color',
			array(
				'label'     => esc_html__( 'Value Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__meta-value' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'experience_typography',
				'label'    => esc_html__( 'Experience Typography', 'ws-team-showcase-widget' ),
				'selector' => '{{WRAPPER}} .ws-team-showcase__meta-label, {{WRAPPER}} .ws-team-showcase__meta-value',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_social_style',
			array(
				'label' => esc_html__( 'Social Links', 'ws-team-showcase-widget' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'social_alignment',
			array(
				'label'     => esc_html__( 'Social Links Alignment', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Left', 'ws-team-showcase-widget' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'ws-team-showcase-widget' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'Right', 'ws-team-showcase-widget' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__socials' => 'justify-content: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'social_color',
			array(
				'label'     => esc_html__( 'Icon Text Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__social-link' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'social_background',
			array(
				'label'     => esc_html__( 'Background Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__social-link' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'social_hover_color',
			array(
				'label'     => esc_html__( 'Hover Icon Text Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__social-link:hover, {{WRAPPER}} .ws-team-showcase__social-link:focus' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'social_hover_background',
			array(
				'label'     => esc_html__( 'Hover Background Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__social-link:hover, {{WRAPPER}} .ws-team-showcase__social-link:focus' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'social_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'ws-team-showcase-widget' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 24,
						'max' => 80,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ws-team-showcase__social-link' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			array(
				'label' => esc_html__( 'Button', 'ws-team-showcase-widget' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'label'    => esc_html__( 'Button Typography', 'ws-team-showcase-widget' ),
				'selector' => '{{WRAPPER}} .ws-team-showcase__button',
			)
		);

		$this->start_controls_tabs( 'button_style_tabs' );

		$this->start_controls_tab(
			'button_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'ws-team-showcase-widget' ),
			)
		);

		$this->add_control(
			'button_color',
			array(
				'label'     => esc_html__( 'Text Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__button' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_background',
			array(
				'label'     => esc_html__( 'Background Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__button' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'ws-team-showcase-widget' ),
			)
		);

		$this->add_control(
			'button_hover_color',
			array(
				'label'     => esc_html__( 'Text Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__button:hover, {{WRAPPER}} .ws-team-showcase__button:focus' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_hover_background',
			array(
				'label'     => esc_html__( 'Background Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__button:hover, {{WRAPPER}} .ws-team-showcase__button:focus' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'button_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'ws-team-showcase-widget' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem' ),
				'separator'  => 'before',
				'selectors'  => array(
					'{{WRAPPER}} .ws-team-showcase__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => esc_html__( 'Padding', 'ws-team-showcase-widget' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .ws-team-showcase__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_search_filter_style',
			array(
				'label'     => esc_html__( 'Search & Filter', 'ws-team-showcase-widget' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout_type' => 'grid',
				),
			)
		);

		$this->add_responsive_control(
			'toolbar_gap',
			array(
				'label'      => esc_html__( 'Column Gap', 'ws-team-showcase-widget' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 80,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ws-team-showcase__toolbar' => 'gap: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'toolbar_spacing',
			array(
				'label'      => esc_html__( 'Bottom Spacing', 'ws-team-showcase-widget' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ws-team-showcase__toolbar' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'search_field_heading',
			array(
				'label' => esc_html__( 'Search Field', 'ws-team-showcase-widget' ),
				'type'  => \Elementor\Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'search_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__search-input' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'search_background',
			array(
				'label'     => esc_html__( 'Background Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__search-input' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'search_typography',
				'label'    => esc_html__( 'Typography', 'ws-team-showcase-widget' ),
				'selector' => '{{WRAPPER}} .ws-team-showcase__search-input, {{WRAPPER}} .ws-team-showcase__filter-select',
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			array(
				'name'     => 'search_border',
				'label'    => esc_html__( 'Border', 'ws-team-showcase-widget' ),
				'selector' => '{{WRAPPER}} .ws-team-showcase__search-input, {{WRAPPER}} .ws-team-showcase__filter-select',
			)
		);

		$this->add_responsive_control(
			'search_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'ws-team-showcase-widget' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .ws-team-showcase__search-input, {{WRAPPER}} .ws-team-showcase__filter-select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'search_padding',
			array(
				'label'      => esc_html__( 'Padding', 'ws-team-showcase-widget' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .ws-team-showcase__search-input, {{WRAPPER}} .ws-team-showcase__filter-select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'search_width',
			array(
				'label'      => esc_html__( 'Search Width', 'ws-team-showcase-widget' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'vw' ),
				'range'      => array(
					'px' => array(
						'min' => 160,
						'max' => 900,
					),
					'%'  => array(
						'min' => 10,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ws-team-showcase__search' => 'flex: 0 1 {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'show_search' => 'yes',
				),
			)
		);

		$this->add_control(
			'filter_field_heading',
			array(
				'label'     => esc_html__( 'Designation Filter', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'filter_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__filter-select' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'filter_background',
			array(
				'label'     => esc_html__( 'Background Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__filter-select' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_load_more_style',
			array(
				'label'     => esc_html__( 'Load More Button', 'ws-team-showcase-widget' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout_type' => 'grid',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name'     => 'load_more_typography',
				'label'    => esc_html__( 'Typography', 'ws-team-showcase-widget' ),
				'selector' => '{{WRAPPER}} .ws-team-showcase__load-more',
			)
		);

		$this->start_controls_tabs( 'load_more_style_tabs' );

		$this->start_controls_tab(
			'load_more_normal_tab',
			array(
				'label' => esc_html__( 'Normal', 'ws-team-showcase-widget' ),
			)
		);

		$this->add_control(
			'load_more_color',
			array(
				'label'     => esc_html__( 'Text Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__load-more' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'load_more_background',
			array(
				'label'     => esc_html__( 'Background Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__load-more' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'load_more_hover_tab',
			array(
				'label' => esc_html__( 'Hover', 'ws-team-showcase-widget' ),
			)
		);

		$this->add_control(
			'load_more_hover_color',
			array(
				'label'     => esc_html__( 'Text Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__load-more:hover, {{WRAPPER}} .ws-team-showcase__load-more:focus' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'load_more_hover_background',
			array(
				'label'     => esc_html__( 'Background Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__load-more:hover, {{WRAPPER}} .ws-team-showcase__load-more:focus' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_responsive_control(
			'load_more_padding',
			array(
				'label'      => esc_html__( 'Padding', 'ws-team-showcase-widget' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', 'rem' ),
				'separator'  => 'before',
				'selectors'  => array(
					'{{WRAPPER}} .ws-team-showcase__load-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'load_more_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'ws-team-showcase-widget' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em', 'rem' ),
				'selectors'  => array(
					'{{WRAPPER}} .ws-team-showcase__load-more' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'load_more_alignment',
			array(
				'label'     => esc_html__( 'Alignment', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Left', 'ws-team-showcase-widget' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'ws-team-showcase-widget' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'Right', 'ws-team-showcase-widget' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__load-more-wrap' => 'justify-content: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_carousel_style',
			array(
				'label'     => esc_html__( 'Carousel Controls', 'ws-team-showcase-widget' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout_type' => 'carousel',
				),
			)
		);

		$this->add_control(
			'carousel_arrow_color',
			array(
				'label'     => esc_html__( 'Arrow Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__carousel-button' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'carousel_arrow_background',
			array(
				'label'     => esc_html__( 'Arrow Background', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__carousel-button' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'carousel_arrow_size',
			array(
				'label'      => esc_html__( 'Arrow Size', 'ws-team-showcase-widget' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 28,
						'max' => 80,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .ws-team-showcase__carousel-button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'carousel_dot_color',
			array(
				'label'     => esc_html__( 'Dot Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__dot' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'carousel_dot_active_color',
			array(
				'label'     => esc_html__( 'Active Dot Color', 'ws-team-showcase-widget' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .ws-team-showcase__dot.is-active' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output.
	 */
	protected function render() {
		$settings     = $this->get_settings_for_display();
		$heading      = ! empty( $settings['heading'] ) ? $settings['heading'] : '';
		$description  = ! empty( $settings['description'] ) ? $settings['description'] : '';
		$team_members = ! empty( $settings['team_members'] ) && is_array( $settings['team_members'] ) ? $settings['team_members'] : array();
		$layout_type  = ! empty( $settings['layout_type'] ) ? $settings['layout_type'] : 'grid';
		$items_page   = ! empty( $settings['items_per_page'] ) ? absint( $settings['items_per_page'] ) : 6;
		$items_page   = max( 1, $items_page );
		$total_items  = count( $team_members );
		$is_carousel  = 'carousel' === $layout_type;
		$show_load    = ! $is_carousel && $total_items > $items_page;
		$root_classes = 'ws-team-showcase ws-team-showcase--' . $layout_type;
		$show_search  = ! $is_carousel && ! empty( $settings['show_search'] ) && 'yes' === $settings['show_search'];
		$show_filter  = ! $is_carousel && ! empty( $settings['show_designation_filter'] ) && 'yes' === $settings['show_designation_filter'];
		$designations = $this->get_unique_member_designations( $team_members );
		$show_profile_button  = ! empty( $settings['show_profile_button'] ) && 'yes' === $settings['show_profile_button'];
		$profile_button_action = ! empty( $settings['profile_button_action'] ) ? $settings['profile_button_action'] : 'link';
		$profile_button_action = in_array( $profile_button_action, array( 'link', 'popup' ), true ) ? $profile_button_action : 'link';
		$has_profile_popup    = $show_profile_button && 'popup' === $profile_button_action;
		$modal_title_id       = 'ws-team-showcase-modal-title-' . $this->get_id();
		$card_hover_animation = ! empty( $settings['card_hover_animation'] ) ? $settings['card_hover_animation'] : 'lift';
		$popup_animation      = ! empty( $settings['profile_popup_animation'] ) ? $settings['profile_popup_animation'] : 'zoom';
		$card_hover_animation = in_array( $card_hover_animation, array( 'none', 'lift', 'scale', 'glow', 'tilt' ), true ) ? $card_hover_animation : 'lift';
		$popup_animation      = in_array( $popup_animation, array( 'fade', 'zoom', 'slide-up', 'flip' ), true ) ? $popup_animation : 'zoom';
		$root_classes        .= ' ws-team-showcase-card-hover-' . $card_hover_animation;
		$root_classes        .= ' ws-team-showcase-popup-' . $popup_animation;
		?>
		<div
			class="<?php echo esc_attr( $root_classes ); ?>"
			data-ws-team-showcase
			data-layout="<?php echo esc_attr( $layout_type ); ?>"
			data-items-per-page="<?php echo esc_attr( $items_page ); ?>"
			data-loop="<?php echo esc_attr( ! empty( $settings['carousel_loop'] ) && 'yes' === $settings['carousel_loop'] ? 'yes' : 'no' ); ?>"
			data-autoplay="<?php echo esc_attr( ! empty( $settings['carousel_autoplay'] ) && 'yes' === $settings['carousel_autoplay'] ? 'yes' : 'no' ); ?>"
			data-autoplay-delay="<?php echo esc_attr( ! empty( $settings['carousel_autoplay_delay'] ) ? absint( $settings['carousel_autoplay_delay'] ) : 3000 ); ?>"
			data-speed="<?php echo esc_attr( ! empty( $settings['carousel_speed'] ) ? absint( $settings['carousel_speed'] ) : 350 ); ?>"
		>
			<?php if ( $heading ) : ?>
				<h2 class="ws-team-showcase__heading"><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>

			<?php if ( ! empty( $settings['show_description'] ) && 'yes' === $settings['show_description'] && $description ) : ?>
				<p class="ws-team-showcase__description"><?php echo esc_html( $description ); ?></p>
			<?php endif; ?>

			<?php if ( $show_search || $show_filter ) : ?>
				<div class="ws-team-showcase__toolbar">
					<?php if ( $show_search ) : ?>
						<label class="ws-team-showcase__search">
							<span class="screen-reader-text"><?php esc_html_e( 'Search team members', 'ws-team-showcase-widget' ); ?></span>
							<input
								class="ws-team-showcase__search-input"
								type="search"
								placeholder="<?php echo esc_attr( ! empty( $settings['search_placeholder'] ) ? $settings['search_placeholder'] : esc_html__( 'Search team members...', 'ws-team-showcase-widget' ) ); ?>"
								autocomplete="off"
							>
						</label>
					<?php endif; ?>

					<?php if ( $show_filter && ! empty( $designations ) ) : ?>
						<label class="ws-team-showcase__filter">
							<span class="screen-reader-text"><?php esc_html_e( 'Filter by designation', 'ws-team-showcase-widget' ); ?></span>
							<select class="ws-team-showcase__filter-select">
								<option value=""><?php echo esc_html( ! empty( $settings['designation_all_label'] ) ? $settings['designation_all_label'] : esc_html__( 'All Designations', 'ws-team-showcase-widget' ) ); ?></option>
								<?php foreach ( $designations as $designation ) : ?>
									<option value="<?php echo esc_attr( $designation ); ?>"><?php echo esc_html( $designation ); ?></option>
								<?php endforeach; ?>
							</select>
						</label>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<div class="ws-team-showcase__viewport">
				<div class="ws-team-showcase__grid">
				<?php foreach ( $team_members as $index => $member ) : ?>
					<?php $this->render_member_card( $member, ! $is_carousel && $index >= $items_page, $index, $show_profile_button, $profile_button_action ); ?>
				<?php endforeach; ?>
				</div>
			</div>

			<?php if ( ! $is_carousel ) : ?>
				<p class="ws-team-showcase__no-results" hidden>
					<?php echo esc_html( ! empty( $settings['no_results_text'] ) ? $settings['no_results_text'] : esc_html__( 'No team members found.', 'ws-team-showcase-widget' ) ); ?>
				</p>
			<?php endif; ?>

			<?php if ( $show_load ) : ?>
				<div class="ws-team-showcase__load-more-wrap">
					<button class="ws-team-showcase__load-more" type="button">
						<?php echo esc_html( ! empty( $settings['load_more_text'] ) ? $settings['load_more_text'] : esc_html__( 'Load More', 'ws-team-showcase-widget' ) ); ?>
					</button>
				</div>
			<?php endif; ?>

			<?php if ( $is_carousel && ! empty( $settings['carousel_navigation'] ) && 'yes' === $settings['carousel_navigation'] ) : ?>
				<div class="ws-team-showcase__carousel-nav" aria-label="<?php esc_attr_e( 'Carousel navigation', 'ws-team-showcase-widget' ); ?>">
					<button class="ws-team-showcase__carousel-button ws-team-showcase__carousel-button--prev" type="button" aria-label="<?php esc_attr_e( 'Previous', 'ws-team-showcase-widget' ); ?>">
						<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M15.7 19.7 8 12l7.7-7.7 1.4 1.4L10.8 12l6.3 6.3-1.4 1.4Z"/></svg>
					</button>
					<button class="ws-team-showcase__carousel-button ws-team-showcase__carousel-button--next" type="button" aria-label="<?php esc_attr_e( 'Next', 'ws-team-showcase-widget' ); ?>">
						<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="m8.3 19.7-1.4-1.4 6.3-6.3-6.3-6.3 1.4-1.4L16 12l-7.7 7.7Z"/></svg>
					</button>
				</div>
			<?php endif; ?>

			<?php if ( $is_carousel && ! empty( $settings['carousel_dots'] ) && 'yes' === $settings['carousel_dots'] ) : ?>
				<div class="ws-team-showcase__dots" aria-label="<?php esc_attr_e( 'Carousel pagination', 'ws-team-showcase-widget' ); ?>"></div>
			<?php endif; ?>

			<?php if ( $has_profile_popup ) : ?>
				<div class="ws-team-showcase__modal" role="dialog" aria-modal="true" aria-labelledby="<?php echo esc_attr( $modal_title_id ); ?>" hidden>
					<div class="ws-team-showcase__modal-backdrop" data-ws-profile-popup-close></div>
					<div class="ws-team-showcase__modal-panel" role="document">
						<button class="ws-team-showcase__modal-close" type="button" aria-label="<?php esc_attr_e( 'Close profile popup', 'ws-team-showcase-widget' ); ?>" data-ws-profile-popup-close>
							<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="m13.4 12 5.3-5.3-1.4-1.4-5.3 5.3-5.3-5.3-1.4 1.4 5.3 5.3-5.3 5.3 1.4 1.4 5.3-5.3 5.3 5.3 1.4-1.4-5.3-5.3Z"/></svg>
						</button>
						<h3 class="ws-team-showcase__modal-name" id="<?php echo esc_attr( $modal_title_id ); ?>"></h3>
						<p class="ws-team-showcase__modal-designation"></p>
						<div class="ws-team-showcase__modal-description"></div>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}

	/**
	 * Render a team member card.
	 *
	 * @param array $member Team member settings.
	 * @param bool  $is_hidden Whether the card should be hidden initially.
	 * @param int   $index Team member index.
	 * @param bool  $show_profile_button Whether the profile button should render.
	 * @param string $profile_button_action Profile button action.
	 */
	private function render_member_card( $member, $is_hidden = false, $index = 0, $show_profile_button = true, $profile_button_action = 'link' ) {
		$button_url            = ! empty( $member['button_url']['url'] ) ? $member['button_url']['url'] : '';
		$button_text           = ! empty( $member['button_text'] ) ? $member['button_text'] : '';
		$detailed_description  = ! empty( $member['member_detailed_description'] ) ? $member['member_detailed_description'] : '';
		$button_attrs          = '';
		$button_rel_values     = array();
		$card_classes          = 'ws-team-showcase__card';

		if ( $button_url ) {
			if ( ! empty( $member['button_url']['is_external'] ) ) {
				$button_attrs .= ' target="_blank"';
				$button_rel_values[] = 'noopener';
			}

			if ( ! empty( $member['button_url']['nofollow'] ) ) {
				$button_rel_values[] = 'nofollow';
			}

			if ( ! empty( $button_rel_values ) ) {
				$button_attrs .= ' rel="' . esc_attr( implode( ' ', array_unique( $button_rel_values ) ) ) . '"';
			}
		}

		if ( $is_hidden ) {
			$card_classes .= ' ws-team-showcase__card--hidden';
		}
		?>
		<article
			class="<?php echo esc_attr( $card_classes ); ?>"
			data-member-index="<?php echo esc_attr( absint( $index ) ); ?>"
			data-member-name="<?php echo esc_attr( ! empty( $member['member_name'] ) ? $member['member_name'] : '' ); ?>"
			data-member-designation="<?php echo esc_attr( ! empty( $member['member_designation'] ) ? $member['member_designation'] : '' ); ?>"
			data-member-department="<?php echo esc_attr( ! empty( $member['member_department'] ) ? $member['member_department'] : '' ); ?>"
			data-member-bio="<?php echo esc_attr( ! empty( $member['member_bio'] ) ? $member['member_bio'] : '' ); ?>"
		>
			<?php if ( ! empty( $member['member_image']['url'] ) ) : ?>
				<div class="ws-team-showcase__image-wrap">
					<img
						class="ws-team-showcase__image"
						src="<?php echo esc_url( $member['member_image']['url'] ); ?>"
						alt="<?php echo esc_attr( ! empty( $member['member_name'] ) ? $member['member_name'] : '' ); ?>"
						loading="lazy"
					>
				</div>
			<?php endif; ?>

			<div class="ws-team-showcase__content">
				<?php if ( ! empty( $member['member_department'] ) ) : ?>
					<span class="ws-team-showcase__department"><?php echo esc_html( $member['member_department'] ); ?></span>
				<?php endif; ?>

				<?php if ( ! empty( $member['member_name'] ) ) : ?>
					<h3 class="ws-team-showcase__name"><?php echo esc_html( $member['member_name'] ); ?></h3>
				<?php endif; ?>

				<?php if ( ! empty( $member['member_designation'] ) ) : ?>
					<p class="ws-team-showcase__designation"><?php echo esc_html( $member['member_designation'] ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $member['member_bio'] ) ) : ?>
					<p class="ws-team-showcase__bio"><?php echo esc_html( $member['member_bio'] ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $member['member_experience'] ) ) : ?>
					<div class="ws-team-showcase__meta">
						<span class="ws-team-showcase__meta-label"><?php esc_html_e( 'Experience', 'ws-team-showcase-widget' ); ?></span>
						<span class="ws-team-showcase__meta-value"><?php echo esc_html( $member['member_experience'] ); ?></span>
					</div>
				<?php endif; ?>

				<?php $this->render_social_links( $member ); ?>

				<?php if ( $show_profile_button && $button_text ) : ?>
					<?php if ( 'popup' === $profile_button_action ) : ?>
						<button
							class="ws-team-showcase__button"
							type="button"
							data-ws-profile-popup
							data-profile-name="<?php echo esc_attr( ! empty( $member['member_name'] ) ? $member['member_name'] : '' ); ?>"
							data-profile-designation="<?php echo esc_attr( ! empty( $member['member_designation'] ) ? $member['member_designation'] : '' ); ?>"
							data-profile-description="<?php echo esc_attr( $detailed_description ); ?>"
						>
							<?php echo esc_html( $button_text ); ?>
						</button>
					<?php elseif ( $button_url ) : ?>
						<a class="ws-team-showcase__button" href="<?php echo esc_url( $button_url ); ?>"<?php echo $button_attrs; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
							<?php echo esc_html( $button_text ); ?>
						</a>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</article>
		<?php
	}

	/**
	 * Get unique designations from member list.
	 *
	 * @param array $team_members Team member settings.
	 * @return array
	 */
	private function get_unique_member_designations( $team_members ) {
		$designations = array();

		foreach ( $team_members as $member ) {
			if ( empty( $member['member_designation'] ) ) {
				continue;
			}

			$designation = trim( wp_strip_all_tags( $member['member_designation'] ) );

			if ( '' === $designation ) {
				continue;
			}

			$designations[ strtolower( $designation ) ] = $designation;
		}

		return array_values( $designations );
	}

	/**
	 * Render social links.
	 *
	 * @param array $settings Widget settings.
	 */
	private function render_social_links( $settings ) {
		$social_links = array(
			'linkedin_url'  => array(
				'label' => esc_html__( 'LinkedIn', 'ws-team-showcase-widget' ),
				'icon'  => $this->get_social_icon_svg( 'linkedin' ),
			),
			'twitter_url'   => array(
				'label' => esc_html__( 'X', 'ws-team-showcase-widget' ),
				'icon'  => $this->get_social_icon_svg( 'x' ),
			),
			'facebook_url'  => array(
				'label' => esc_html__( 'Facebook', 'ws-team-showcase-widget' ),
				'icon'  => $this->get_social_icon_svg( 'facebook' ),
			),
			'instagram_url' => array(
				'label' => esc_html__( 'Instagram', 'ws-team-showcase-widget' ),
				'icon'  => $this->get_social_icon_svg( 'instagram' ),
			),
		);

		$has_links = false;

		foreach ( $social_links as $setting_key => $social_link ) {
			if ( ! empty( $settings[ $setting_key ]['url'] ) ) {
				$has_links = true;
				break;
			}
		}

		if ( ! $has_links ) {
			return;
		}
		?>
		<div class="ws-team-showcase__socials" aria-label="<?php esc_attr_e( 'Social links', 'ws-team-showcase-widget' ); ?>">
			<?php foreach ( $social_links as $setting_key => $social_link ) : ?>
				<?php
				if ( empty( $settings[ $setting_key ]['url'] ) ) {
					continue;
				}

				$url        = $settings[ $setting_key ]['url'];
				$target     = ! empty( $settings[ $setting_key ]['is_external'] ) ? ' target="_blank"' : '';
				$rel_values = array();

				if ( ! empty( $settings[ $setting_key ]['is_external'] ) ) {
					$rel_values[] = 'noopener';
				}

				if ( ! empty( $settings[ $setting_key ]['nofollow'] ) ) {
					$rel_values[] = 'nofollow';
				}

				$rel = ! empty( $rel_values ) ? ' rel="' . esc_attr( implode( ' ', array_unique( $rel_values ) ) ) . '"' : '';
				?>
				<a class="ws-team-showcase__social-link" href="<?php echo esc_url( $url ); ?>" aria-label="<?php echo esc_attr( $social_link['label'] ); ?>"<?php echo $target . $rel; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<?php echo $social_link['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
			<?php endforeach; ?>
		</div>
		<?php
	}

	/**
	 * Get inline SVG for a social platform.
	 *
	 * @param string $platform Social platform key.
	 * @return string
	 */
	private function get_social_icon_svg( $platform ) {
		$icons = array(
			'linkedin'  => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M4.98 3.5C4.98 4.88 3.87 6 2.5 6S.02 4.88.02 3.5 1.13 1 2.5 1s2.48 1.12 2.48 2.5ZM.35 8h4.3v14h-4.3V8Zm7.15 0h4.12v1.91h.06c.57-1.08 1.97-2.22 4.06-2.22 4.34 0 5.14 2.86 5.14 6.57V22h-4.3v-6.86c0-1.64-.03-3.74-2.28-3.74-2.28 0-2.63 1.78-2.63 3.62V22H7.5V8Z"/></svg>',
			'x'         => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M18.9 2h3.31l-7.23 8.26L23.5 22h-6.67l-5.22-6.83L5.64 22H2.31l7.73-8.84L1.87 2h6.84l4.72 6.24L18.9 2Zm-1.16 17.93h1.83L7.72 3.96H5.75l11.99 15.97Z"/></svg>',
			'facebook'  => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M22 12.06C22 6.5 17.52 2 12 2S2 6.5 2 12.06C2 17.08 5.66 21.25 10.44 22v-7.03H7.9v-2.91h2.54V9.84c0-2.52 1.49-3.91 3.77-3.91 1.09 0 2.23.2 2.23.2v2.46h-1.26c-1.24 0-1.63.78-1.63 1.57v1.9h2.77l-.44 2.91h-2.33V22C18.34 21.25 22 17.08 22 12.06Z"/></svg>',
			'instagram' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M7.8 2h8.4A5.81 5.81 0 0 1 22 7.8v8.4a5.81 5.81 0 0 1-5.8 5.8H7.8A5.81 5.81 0 0 1 2 16.2V7.8A5.81 5.81 0 0 1 7.8 2Zm-.2 2A3.6 3.6 0 0 0 4 7.6v8.8A3.6 3.6 0 0 0 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6A3.6 3.6 0 0 0 16.4 4H7.6Zm9.65 1.5a1.25 1.25 0 1 1 0 2.5 1.25 1.25 0 0 1 0-2.5ZM12 7.35A4.65 4.65 0 1 1 12 16.65 4.65 4.65 0 0 1 12 7.35Zm0 2A2.65 2.65 0 1 0 12 14.65 2.65 2.65 0 0 0 12 9.35Z"/></svg>',
		);

		return isset( $icons[ $platform ] ) ? $icons[ $platform ] : '';
	}
}
