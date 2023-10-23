<?php
/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */

class Product_Comparison_Woocommerce_Control_Typography extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'product-comparison-woocommerce-typography';

	/**
	 * Array 
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = array();

	/**
	 * Set up our control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $id
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $id, $args = array() ) {

		// Let the parent class do its thing.
		parent::__construct( $manager, $id, $args );

		// Make sure we have labels.
		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'color'       => esc_html__( 'Font Color', 'product-comparison-woocommerce' ),
				'family'      => esc_html__( 'Font Family', 'product-comparison-woocommerce' ),
				'size'        => esc_html__( 'Font Size',   'product-comparison-woocommerce' ),
				'weight'      => esc_html__( 'Font Weight', 'product-comparison-woocommerce' ),
				'style'       => esc_html__( 'Font Style',  'product-comparison-woocommerce' ),
				'line_height' => esc_html__( 'Line Height', 'product-comparison-woocommerce' ),
				'letter_spacing' => esc_html__( 'Letter Spacing', 'product-comparison-woocommerce' ),
			)
		);
	}

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'product-comparison-woocommerce-ctypo-customize-controls' );
		wp_enqueue_style(  'product-comparison-woocommerce-ctypo-customize-controls' );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		// Loop through each of the settings and set up the data for it.
		foreach ( $this->settings as $setting_key => $setting_id ) {

			$this->json[ $setting_key ] = array(
				'link'  => $this->get_link( $setting_key ),
				'value' => $this->value( $setting_key ),
				'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
			);

			if ( 'family' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_families();

			elseif ( 'weight' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();

			elseif ( 'style' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_style_choices();
		}
	}

	/**
	 * Underscore JS template to handle the control's output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function content_template() { ?>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

		<ul>

		<# if ( data.family && data.family.choices ) { #>

			<li class="typography-font-family">

				<# if ( data.family.label ) { #>
					<span class="customize-control-title">{{ data.family.label }}</span>
				<# } #>

				<select {{{ data.family.link }}}>

					<# _.each( data.family.choices, function( label, choice ) { #>
						<option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.weight && data.weight.choices ) { #>

			<li class="typography-font-weight">

				<# if ( data.weight.label ) { #>
					<span class="customize-control-title">{{ data.weight.label }}</span>
				<# } #>

				<select {{{ data.weight.link }}}>

					<# _.each( data.weight.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.weight.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.style && data.style.choices ) { #>

			<li class="typography-font-style">

				<# if ( data.style.label ) { #>
					<span class="customize-control-title">{{ data.style.label }}</span>
				<# } #>

				<select {{{ data.style.link }}}>

					<# _.each( data.style.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.size ) { #>

			<li class="typography-font-size">

				<# if ( data.size.label ) { #>
					<span class="customize-control-title">{{ data.size.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.size.link }}} value="{{ data.size.value }}" />

			</li>
		<# } #>

		<# if ( data.line_height ) { #>

			<li class="typography-line-height">

				<# if ( data.line_height.label ) { #>
					<span class="customize-control-title">{{ data.line_height.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.line_height.link }}} value="{{ data.line_height.value }}" />

			</li>
		<# } #>

		<# if ( data.letter_spacing ) { #>

			<li class="typography-letter-spacing">

				<# if ( data.letter_spacing.label ) { #>
					<span class="customize-control-title">{{ data.letter_spacing.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.letter_spacing.link }}} value="{{ data.letter_spacing.value }}" />

			</li>
		<# } #>

		</ul>
	<?php }

	/**
	 * Returns the available fonts.  Fonts should have available weights, styles, and subsets.
	 *
	 * @todo Integrate with Google fonts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_fonts() { return array(); }

	/**
	 * Returns the available font families.
	 *
	 * @todo Pull families from `get_fonts()`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function get_font_families() {

		return array(
			'' => __( 'No Fonts', 'product-comparison-woocommerce' ),
        'Abril Fatface' => __( 'Abril Fatface', 'product-comparison-woocommerce' ),
        'Acme' => __( 'Acme', 'product-comparison-woocommerce' ),
        'Anton' => __( 'Anton', 'product-comparison-woocommerce' ),
        'Architects Daughter' => __( 'Architects Daughter', 'product-comparison-woocommerce' ),
        'Arimo' => __( 'Arimo', 'product-comparison-woocommerce' ),
        'Arsenal' => __( 'Arsenal', 'product-comparison-woocommerce' ),
        'Arvo' => __( 'Arvo', 'product-comparison-woocommerce' ),
        'Alegreya' => __( 'Alegreya', 'product-comparison-woocommerce' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'product-comparison-woocommerce' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'product-comparison-woocommerce' ),
        'Bangers' => __( 'Bangers', 'product-comparison-woocommerce' ),
        'Boogaloo' => __( 'Boogaloo', 'product-comparison-woocommerce' ),
        'Bad Script' => __( 'Bad Script', 'product-comparison-woocommerce' ),
        'Bitter' => __( 'Bitter', 'product-comparison-woocommerce' ),
        'Bree Serif' => __( 'Bree Serif', 'product-comparison-woocommerce' ),
        'BenchNine' => __( 'BenchNine', 'product-comparison-woocommerce' ),
        'Cabin' => __( 'Cabin', 'product-comparison-woocommerce' ),
        'Cardo' => __( 'Cardo', 'product-comparison-woocommerce' ),
        'Courgette' => __( 'Courgette', 'product-comparison-woocommerce' ),
        'Cherry Swash' => __( 'Cherry Swash', 'product-comparison-woocommerce' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'product-comparison-woocommerce' ),
        'Crimson Text' => __( 'Crimson Text', 'product-comparison-woocommerce' ),
        'Cuprum' => __( 'Cuprum', 'product-comparison-woocommerce' ),
        'Cookie' => __( 'Cookie', 'product-comparison-woocommerce' ),
        'Chewy' => __( 'Chewy', 'product-comparison-woocommerce' ),
        'Days One' => __( 'Days One', 'product-comparison-woocommerce' ),
        'Dosis' => __( 'Dosis', 'product-comparison-woocommerce' ),
        'Droid Sans' => __( 'Droid Sans', 'product-comparison-woocommerce' ),
        'Economica' => __( 'Economica', 'product-comparison-woocommerce' ),
        'Fredoka One' => __( 'Fredoka One', 'product-comparison-woocommerce' ),
        'Fjalla One' => __( 'Fjalla One', 'product-comparison-woocommerce' ),
        'Francois One' => __( 'Francois One', 'product-comparison-woocommerce' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'product-comparison-woocommerce' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'product-comparison-woocommerce' ),
        'Great Vibes' => __( 'Great Vibes', 'product-comparison-woocommerce' ),
        'Handlee' => __( 'Handlee', 'product-comparison-woocommerce' ),
        'Hammersmith One' => __( 'Hammersmith One', 'product-comparison-woocommerce' ),
        'Inconsolata' => __( 'Inconsolata', 'product-comparison-woocommerce' ),
        'Indie Flower' => __( 'Indie Flower', 'product-comparison-woocommerce' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'product-comparison-woocommerce' ),
        'Julius Sans One' => __( 'Julius Sans One', 'product-comparison-woocommerce' ),
        'Josefin Slab' => __( 'Josefin Slab', 'product-comparison-woocommerce' ),
        'Josefin Sans' => __( 'Josefin Sans', 'product-comparison-woocommerce' ),
        'Kanit' => __( 'Kanit', 'product-comparison-woocommerce' ),
        'Lobster' => __( 'Lobster', 'product-comparison-woocommerce' ),
        'Lato' => __( 'Lato', 'product-comparison-woocommerce' ),
        'Lora' => __( 'Lora', 'product-comparison-woocommerce' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'product-comparison-woocommerce' ),
        'Lobster Two' => __( 'Lobster Two', 'product-comparison-woocommerce' ),
        'Merriweather' => __( 'Merriweather', 'product-comparison-woocommerce' ),
        'Monda' => __( 'Monda', 'product-comparison-woocommerce' ),
        'Montserrat' => __( 'Montserrat', 'product-comparison-woocommerce' ),
        'Muli' => __( 'Muli', 'product-comparison-woocommerce' ),
        'Marck Script' => __( 'Marck Script', 'product-comparison-woocommerce' ),
        'Noto Serif' => __( 'Noto Serif', 'product-comparison-woocommerce' ),
        'Open Sans' => __( 'Open Sans', 'product-comparison-woocommerce' ),
        'Overpass' => __( 'Overpass', 'product-comparison-woocommerce' ),
        'Overpass Mono' => __( 'Overpass Mono', 'product-comparison-woocommerce' ),
        'Oxygen' => __( 'Oxygen', 'product-comparison-woocommerce' ),
        'Orbitron' => __( 'Orbitron', 'product-comparison-woocommerce' ),
        'Patua One' => __( 'Patua One', 'product-comparison-woocommerce' ),
        'Pacifico' => __( 'Pacifico', 'product-comparison-woocommerce' ),
        'Padauk' => __( 'Padauk', 'product-comparison-woocommerce' ),
        'Playball' => __( 'Playball', 'product-comparison-woocommerce' ),
        'Playfair Display' => __( 'Playfair Display', 'product-comparison-woocommerce' ),
        'PT Sans' => __( 'PT Sans', 'product-comparison-woocommerce' ),
        'Philosopher' => __( 'Philosopher', 'product-comparison-woocommerce' ),
        'Permanent Marker' => __( 'Permanent Marker', 'product-comparison-woocommerce' ),
        'Poiret One' => __( 'Poiret One', 'product-comparison-woocommerce' ),
        'Quicksand' => __( 'Quicksand', 'product-comparison-woocommerce' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'product-comparison-woocommerce' ),
        'Raleway' => __( 'Raleway', 'product-comparison-woocommerce' ),
        'Rubik' => __( 'Rubik', 'product-comparison-woocommerce' ),
        'Rokkitt' => __( 'Rokkitt', 'product-comparison-woocommerce' ),
        'Russo One' => __( 'Russo One', 'product-comparison-woocommerce' ),
        'Righteous' => __( 'Righteous', 'product-comparison-woocommerce' ),
        'Slabo' => __( 'Slabo', 'product-comparison-woocommerce' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'product-comparison-woocommerce' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'product-comparison-woocommerce'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'product-comparison-woocommerce' ),
        'Sacramento' => __( 'Sacramento', 'product-comparison-woocommerce' ),
        'Shrikhand' => __( 'Shrikhand', 'product-comparison-woocommerce' ),
        'Tangerine' => __( 'Tangerine', 'product-comparison-woocommerce' ),
        'Ubuntu' => __( 'Ubuntu', 'product-comparison-woocommerce' ),
        'VT323' => __( 'VT323', 'product-comparison-woocommerce' ),
        'Varela Round' => __( 'Varela Round', 'product-comparison-woocommerce' ),
        'Vampiro One' => __( 'Vampiro One', 'product-comparison-woocommerce' ),
        'Vollkorn' => __( 'Vollkorn', 'product-comparison-woocommerce' ),
        'Volkhov' => __( 'Volkhov', 'product-comparison-woocommerce' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'product-comparison-woocommerce' )
		);
	}

	/**
	 * Returns the available font weights.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_weight_choices() {

		return array(
			'' => esc_html__( 'No Fonts weight', 'product-comparison-woocommerce' ),
			'100' => esc_html__( 'Thin',       'product-comparison-woocommerce' ),
			'300' => esc_html__( 'Light',      'product-comparison-woocommerce' ),
			'400' => esc_html__( 'Normal',     'product-comparison-woocommerce' ),
			'500' => esc_html__( 'Medium',     'product-comparison-woocommerce' ),
			'700' => esc_html__( 'Bold',       'product-comparison-woocommerce' ),
			'900' => esc_html__( 'Ultra Bold', 'product-comparison-woocommerce' ),
		);
	}

	/**
	 * Returns the available font styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_style_choices() {

		return array(
			'' => esc_html__( 'No Fonts Style', 'product-comparison-woocommerce' ),
			'normal'  => esc_html__( 'Normal', 'product-comparison-woocommerce' ),
			'italic'  => esc_html__( 'Italic', 'product-comparison-woocommerce' ),
			'oblique' => esc_html__( 'Oblique', 'product-comparison-woocommerce' )
		);
	}
}
