<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor List Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_List_Widget_2 extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve list widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'ArtbeesPosts';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve list widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Artbees Posts', 'elementor-list-widget' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve list widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-bullet-list';
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url() {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the list widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the list widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'list', 'lists', 'ordered', 'unordered' ];
	}

	/**
	 * Register list widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'artbees-extensions' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ],
            'style_section',
            [
                'label' => esc_html__( 'Style Section', 'artbees-extensions' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
            
		);


        $this->add_control(
			'artbees_post_skin',
			[
				'label' => esc_html__( 'Skin', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'cards',
				'options' => [
					'cards'  => esc_html__( 'Cards', 'plugin-name' ),
					'classic' => esc_html__( 'Classic', 'plugin-name' ),
				],
			]
		);

        $this->add_control(
			'artbees_post_post_per_page',
			[
				'label' => esc_html__( 'Posts Per Page', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => '3',
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Style', 'artbees-extensions' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'flex_item',
			[
				'label' => esc_html__( 'Columns', 'artbees-extensions' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					'4'  => esc_html__( '4 columns', 'artbees-extensions' ),
					'3' => esc_html__( '3 columns', 'artbees-extensions' ),
					'2' => esc_html__( '2 columns', 'artbees-extensions' ),
				],
			]
		);

        $this->add_control(
			'border_style',
			[
				'label' => esc_html__( 'Border Style', 'artbees-extensions' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'solid'  => esc_html__( 'Solid', 'artbees-extensions' ),
					'dashed' => esc_html__( 'Dashed', 'artbees-extensions' ),
					'dotted' => esc_html__( 'Dotted', 'artbees-extensions' ),
					'double' => esc_html__( 'Double', 'artbees-extensions' ),
					'none' => esc_html__( 'None', 'artbees-extensions' ),
				],
			]
		);

        $this->add_responsive_control(
			'flex_padding',
			[
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'label' => esc_html__( 'Padding', 'artbees-extensions' ),
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .flex-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Box Shadow', 'artbees-extensions' ),
				'selector' => '{{WRAPPER}} .flex-container',
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render list widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
    protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div style="border-style: <?php echo esc_attr( $settings['border_style'] ); ?>" class="flex-container">
		<?php foreach ( $settings['list'] as $index => $item ) : ?>
				<?php
				if ( !$item['list_title'] ) {
					echo 'Nothing to show here!';
				} else {
					?>
                    <div class="flex-item">
                        <?php
                            echo '<img src="' . esc_url( $item['image']['url'] ) . '" alt="">';
                        ?>
                    </div>
                    
                    <?php
				}
				?>
		<?php endforeach; ?>
            </div>
		<?php
	}

	/**
	 * Render list widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() {
		?>
		<#
		html_tag = {
			'ordered': 'ol',
			'unordered': 'ul',
			'other': 'ul',
		};
		view.addRenderAttribute( 'list', 'class', 'elementor-list-widget' );
		#>
		<{{{ html_tag[ settings.marker_type ] }}} {{{ view.getRenderAttributeString( 'list' ) }}}>
			<# _.each( settings.list_items, function( item, index ) {
				var repeater_setting_key = view.getRepeaterSettingKey( 'text', 'list_items', index );
				view.addRenderAttribute( repeater_setting_key, 'class', 'elementor-list-widget-text' );
				view.addInlineEditingAttributes( repeater_setting_key );
				#>
				<li {{{ view.getRenderAttributeString( repeater_setting_key ) }}}>
					<# var title = item.text; #>
					<# if ( item.link ) { #>
						<# view.addRenderAttribute( `link_${index}`, item.link ); #>
						<a href="{{ item.link.url }}" {{{ view.getRenderAttributeString( `link_${index}` ) }}}>
							{{{title}}}
						</a>
					<# } else { #>
						{{{title}}}
					<# } #>
				</li>
			<# } ); #>
		</{{{ html_tag[ settings.marker_type ] }}}>
		<?php
	}

}
