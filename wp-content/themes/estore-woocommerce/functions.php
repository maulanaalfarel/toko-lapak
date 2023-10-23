<?php
/**
 * Estore Woocommerce functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Estore Woocommerce
 */

include get_theme_file_path( 'vendor/wptrt/autoload/src/Estore_Woocommerce_Loader.php' );

$Estore_Woocommerce_Loader = new \WPTRT\Autoload\Estore_Woocommerce_Loader();

$Estore_Woocommerce_Loader->estore_woocommerce_add( 'WPTRT\\Customize\\Section', get_theme_file_path( 'vendor/wptrt/customize-section-button/src' ) );

$Estore_Woocommerce_Loader->estore_woocommerce_register();

if ( ! function_exists( 'estore_woocommerce_setup' ) ) :

	function estore_woocommerce_setup() {

		load_theme_textdomain( 'estore-woocommerce', get_template_directory() . '/languages' );

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		*/
		add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

		add_theme_support( 'woocommerce' );
		add_theme_support( "responsive-embeds" );
		add_theme_support( "align-wide" );
		add_theme_support( "wp-block-styles" );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
        add_image_size('estore-woocommerce-featured-header-image', 2000, 660, true);

        register_nav_menus( array(
            'primary' => esc_html__( 'Primary','estore-woocommerce' ),
	        'footer'=> esc_html__( 'Footer Menu','estore-woocommerce' ),
        ) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'custom-background', apply_filters( 'estore_woocommerce_custom_background_args', array(
			'default-color' => 'f7ebe5',
			'default-image' => '',
		) ) );

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'custom-logo', array(
			'height'      => 50,
			'width'       => 50,
			'flex-width'  => true,
		) );

		add_editor_style( array( '/editor-style.css' ) );
	}
endif;
add_action( 'after_setup_theme', 'estore_woocommerce_setup' );


function estore_woocommerce_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'estore_woocommerce_content_width', 1170 );
}
add_action( 'after_setup_theme', 'estore_woocommerce_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function estore_woocommerce_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'estore-woocommerce' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'estore-woocommerce' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Woocommerce Single Product Page Sidebar', 'estore-woocommerce' ),
		'id'            => 'woocommerce-single-product-page-sidebar',
		'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Woocommerce Shop Page Sidebar', 'estore-woocommerce' ),
		'id'            => 'woocommerce-shop-page-sidebar',
		'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'estore-woocommerce' ),
		'id'            => 'estore-woocommerce-footer1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'estore-woocommerce' ),
		'id'            => 'estore-woocommerce-footer2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'estore-woocommerce' ),
		'id'            => 'estore-woocommerce-footer3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'estore_woocommerce_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function estore_woocommerce_scripts() {

	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

	wp_enqueue_style(
		'montserrat',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' ),
		array(),
		'1.0'
	);

	wp_enqueue_style( 'estore-woocommerce-block-editor-style', get_theme_file_uri('/assets/css/block-editor-style.css') );

	// load bootstrap css
    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.css');

    wp_enqueue_style( 'owl.carousel-css', get_template_directory_uri() . '/assets/css/owl.carousel.css');

	wp_enqueue_style( 'estore-woocommerce-style', get_stylesheet_uri() );
	require get_parent_theme_file_path( '/custom-option.php' );
	wp_add_inline_style( 'estore-woocommerce-style',$estore_woocommerce_theme_css );

	wp_style_add_data('estore-woocommerce-basic-style', 'rtl', 'replace');

	// fontawesome
	wp_enqueue_style( 'fontawesome-style', get_template_directory_uri() .'/assets/css/fontawesome/css/all.css' );

    wp_enqueue_script('estore-woocommerce-theme-js', get_template_directory_uri() . '/assets/js/theme-script.js', array('jquery'), '', true );

    wp_enqueue_script('owl.carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'estore_woocommerce_scripts' );

/**
 * Enqueue Preloader.
 */
function estore_woocommerce_preloader() {

  $estore_woocommerce_theme_color_css = '';
  $estore_woocommerce_preloader_bg_color = get_theme_mod('estore_woocommerce_preloader_bg_color');
  $estore_woocommerce_preloader_dot_1_color = get_theme_mod('estore_woocommerce_preloader_dot_1_color');
  $estore_woocommerce_preloader_dot_2_color = get_theme_mod('estore_woocommerce_preloader_dot_2_color');
  $estore_woocommerce_logo_max_height = get_theme_mod('estore_woocommerce_logo_max_height');

  	if(get_theme_mod('estore_woocommerce_logo_max_height') == '') {
		$estore_woocommerce_logo_max_height = '24';
	}

	if(get_theme_mod('estore_woocommerce_preloader_bg_color') == '') {
		$estore_woocommerce_preloader_bg_color = '#ffffff';
	}
	if(get_theme_mod('estore_woocommerce_preloader_dot_1_color') == '') {
		$estore_woocommerce_preloader_dot_1_color = '#29AAE2';
	}
	if(get_theme_mod('estore_woocommerce_preloader_dot_2_color') == '') {
		$estore_woocommerce_preloader_dot_2_color = '#151515';
	}
	$estore_woocommerce_theme_color_css = '
		.custom-logo-link img{
			max-height: '.esc_attr($estore_woocommerce_logo_max_height).'px;
	 	}
		.loading{
			background-color: '.esc_attr($estore_woocommerce_preloader_bg_color).';
		 }
		 @keyframes loading {
		  0%,
		  100% {
		  	transform: translatey(-2.5rem);
		    background-color: '.esc_attr($estore_woocommerce_preloader_dot_1_color).';
		  }
		  50% {
		  	transform: translatey(2.5rem);
		    background-color: '.esc_attr($estore_woocommerce_preloader_dot_2_color).';
		  }
		}
	';
    wp_add_inline_style( 'estore-woocommerce-style',$estore_woocommerce_theme_color_css );

}
add_action( 'wp_enqueue_scripts', 'estore_woocommerce_preloader' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


function estore_woocommerce_sanitize_select( $input, $setting ){
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/*dropdown page sanitization*/
function estore_woocommerce_sanitize_dropdown_pages( $page_id, $setting ) {
	$page_id = absint( $page_id );
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function estore_woocommerce_sanitize_checkbox( $input ) {
  // Boolean check
  return ( ( isset( $input ) && true == $input ) ? true : false );
}

/*radio button sanitization*/
function estore_woocommerce_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function estore_woocommerce_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );

	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}

add_filter( 'woocommerce_sale_flash', 'estore_woocommerce_woocommerce_sale_flash_percentage', 10, 3 );

function estore_woocommerce_woocommerce_sale_flash_percentage( $html, $post, $product ) {

	$found = preg_match( '#(<span.*?>)(.*?)(</span>)#', $html, $matches );

	if ( ! $found ) {
		return $html;
	}

	$tag_open      = $matches[1];
	$tag_close     = $matches[3];
	$original_text = $matches[2];

	$percentages = estore_woocommerce_woocommerce_get_product_sale_percentages( $product );
	$label       = estore_woocommerce_woocommerce_get_product_sale_percentage_label( $percentages, $original_text );

	$html = $tag_open . $label . $tag_close;

	return $html;
}

function estore_woocommerce_woocommerce_get_product_sale_percentages( $product ) {
	$percentages = array(
		'min' => false,
		'max' => false,
	);

	switch ( $product->get_type() ) {
		case 'grouped':
			$children = array_filter( array_map( 'wc_get_product', $product->get_children() ), 'wc_products_array_filter_visible_grouped' );

			foreach ( $children as $child ) {
				if ( $child->is_purchasable() && ! $child->is_type( 'grouped' ) && $child->is_on_sale() ) {
					$child_percentage = estore_woocommerce_woocommerce_get_product_sale_percentages( $child );

					$percentages['min'] = false !== $percentages['min'] ? $percentages['min'] : $child_percentage['min'];
					$percentages['max'] = false !== $percentages['max'] ? $percentages['max'] : $child_percentage['max'];

					if ( $child_percentage['min'] < $percentages['min'] ) {
						$percentages['min'] = $child_percentage['min'];
					}

					if ( $child_percentage['max'] > $percentages['max'] ) {
						$percentages['max'] = $child_percentage['max'];
					}
				}
			}

			break;

		case 'variable':
			$prices = $product->get_variation_prices();

			foreach ( $prices['price'] as $variation_id => $price ) {
				$regular_price = (float) $prices['regular_price'][ $variation_id ];
				$sale_price    = (float) $prices['sale_price'][ $variation_id ];

				if ( $sale_price < $regular_price ) {
					$variation_percentage = ( ( $regular_price - $sale_price ) / $regular_price ) * 100;

					$percentages['min'] = false !== $percentages['min'] ? $percentages['min'] : $variation_percentage;
					$percentages['max'] = false !== $percentages['max'] ? $percentages['max'] : $variation_percentage;

					if ( $variation_percentage < $percentages['min'] ) {
						$percentages['min'] = $variation_percentage;
					}

					if ( $variation_percentage > $percentages['max'] ) {
						$percentages['max'] = $variation_percentage;
					}
				}
			}
			break;

		case 'external':
		case 'variation':
		case 'simple':
		default:
			$regular_price = (float) $product->get_regular_price();
			$sale_price    = (float) $product->get_sale_price();

			if ( $sale_price < $regular_price ) {
				$percentages['max'] = ( ( $regular_price - $sale_price ) / $regular_price ) * 100;
			}
	}
	return $percentages;
}

function estore_woocommerce_woocommerce_get_product_sale_percentage_label( $percentages, $original_label ) {
	$label = '';

	$rounded_percentages = $percentages;
	$rounded_percentages = array_map( 'round', $percentages );
	$rounded_percentages = array_map( 'intval', $rounded_percentages );

	if ( ( empty( $percentages['min'] ) || empty( $percentages['max'] ) ) || ( $percentages['min'] === $percentages['max'] ) ) {
		$label = sprintf( _x( '-%1$d%%', 'product discount', 'estore-woocommerce' ), max( $rounded_percentages ) );
	} else {
		$label = sprintf( _x( '-%1$d%% / -%2$d%%', 'product discount', 'estore-woocommerce' ), $rounded_percentages['min'], $rounded_percentages['max'] );
	}

	$label = apply_filters( 'estore_woocommerce_woocommerce_sale_flash_percentage_label', $label, $rounded_percentages, $percentages, $original_label );

	return $label;
}

/**
 * Get CSS
 */

function estore_woocommerce_getpage_css($hook) {
	if ( 'appearance_page_estore-woocommerce-info' != $hook ) {
		return;
	}
	wp_enqueue_style( 'estore-woocommerce-demo-style', get_template_directory_uri() . '/assets/css/demo.css' );
}
add_action( 'admin_enqueue_scripts', 'estore_woocommerce_getpage_css' );

function estore_woocommerce_page_redirection() {
	global $pagenow;
		if (isset($_GET['activated']) && ('themes.php' == $pagenow) && is_admin()) {
		wp_safe_redirect(admin_url("themes.php?page=estore-woocommerce-info.php"));
	}
}
add_action('after_setup_theme', 'estore_woocommerce_page_redirection');

if ( ! defined( 'ESTORE_WOOCOMMERCE_CONTACT_SUPPORT' ) ) {
define('ESTORE_WOOCOMMERCE_CONTACT_SUPPORT',__('https://wordpress.org/support/theme/estore-woocommerce/','estore-woocommerce'));
}
if ( ! defined( 'ESTORE_WOOCOMMERCE_REVIEW' ) ) {
define('ESTORE_WOOCOMMERCE_REVIEW',__('https://wordpress.org/support/theme/estore-woocommerce/reviews/','estore-woocommerce'));
}
if ( ! defined( 'ESTORE_WOOCOMMERCE_LIVE_DEMO' ) ) {
define('ESTORE_WOOCOMMERCE_LIVE_DEMO',__('https://themagnifico.net/demo/woocommerce-estore/','estore-woocommerce'));
}
if ( ! defined( 'ESTORE_WOOCOMMERCE_GET_PREMIUM_PRO' ) ) {
define('ESTORE_WOOCOMMERCE_GET_PREMIUM_PRO',__('https://www.themagnifico.net/themes/estore-wordpress-theme/','estore-woocommerce'));
}
if ( ! defined( 'ESTORE_WOOCOMMERCE_PRO_DOC' ) ) {
define('ESTORE_WOOCOMMERCE_PRO_DOC',__('https://www.themagnifico.net/eard/wathiqa/woocommerce-estore-doc/','estore-woocommerce'));
}

add_action('admin_menu', 'estore_woocommerce_themepage');
function estore_woocommerce_themepage(){

	$estore_woocommerce_theme_test = wp_get_theme();

	$estore_woocommerce_theme_info = add_theme_page( __('Theme Options','estore-woocommerce'), __(' Theme Options','estore-woocommerce'), 'manage_options', 'estore-woocommerce-info.php', 'estore_woocommerce_info_page' );
}

function estore_woocommerce_info_page() {
	$estore_woocommerce_theme_user = wp_get_current_user();
	$estore_woocommerce_theme = wp_get_theme();
	?>
	<div class="wrap about-wrap estore-woocommerce-add-css">
		<div>
			<h1>
				<?php esc_html_e('Welcome To ','estore-woocommerce'); ?><?php echo esc_html( $estore_woocommerce_theme ); ?>
			</h1>
			<div class="feature-section three-col">
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Contact Support", "estore-woocommerce"); ?></h3>
						<p><?php esc_html_e("Thank you for trying Estore Woocommerce , feel free to contact us for any support regarding our theme.", "estore-woocommerce"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( ESTORE_WOOCOMMERCE_CONTACT_SUPPORT ); ?>" class="button button-primary get">
							<?php esc_html_e("Contact Support", "estore-woocommerce"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Checkout Premium", "estore-woocommerce"); ?></h3>
						<p><?php esc_html_e("Our premium theme comes with extended features like demo content import , responsive layouts etc.", "estore-woocommerce"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( ESTORE_WOOCOMMERCE_GET_PREMIUM_PRO ); ?>" class="button button-primary get">
							<?php esc_html_e("Get Premium", "estore-woocommerce"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Review", "estore-woocommerce"); ?></h3>
						<p><?php esc_html_e("If You love Estore Woocommerce theme then we would appreciate your review about our theme.", "estore-woocommerce"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( ESTORE_WOOCOMMERCE_REVIEW ); ?>" class="button button-primary get">
							<?php esc_html_e("Review", "estore-woocommerce"); ?>
						</a></p>
					</div>
				</div>
			</div>
		</div>
		<hr>

		<h2><?php esc_html_e("Free Vs Premium","estore-woocommerce"); ?></h2>
		<div class="estore-woocommerce-button-container">
			<a target="_blank" href="<?php echo esc_url( ESTORE_WOOCOMMERCE_PRO_DOC ); ?>" class="button button-primary get">
				<?php esc_html_e("Checkout Documentation", "estore-woocommerce"); ?>
			</a>
			<a target="_blank" href="<?php echo esc_url( ESTORE_WOOCOMMERCE_LIVE_DEMO ); ?>" class="button button-primary get">
				<?php esc_html_e("View Theme Demo", "estore-woocommerce"); ?>
			</a>
		</div>


		<table class="wp-list-table widefat">
			<thead class="table-book">
				<tr>
					<th><strong><?php esc_html_e("Theme Feature", "estore-woocommerce"); ?></strong></th>
					<th><strong><?php esc_html_e("Basic Version", "estore-woocommerce"); ?></strong></th>
					<th><strong><?php esc_html_e("Premium Version", "estore-woocommerce"); ?></strong></th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td><?php esc_html_e("Header Background Color", "estore-woocommerce"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Custom Navigation Logo Or Text", "estore-woocommerce"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Hide Logo Text", "estore-woocommerce"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>

				<tr>
					<td><?php esc_html_e("Premium Support", "estore-woocommerce"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Fully SEO Optimized", "estore-woocommerce"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Recent Posts Widget", "estore-woocommerce"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>

				<tr>
					<td><?php esc_html_e("Easy Google Fonts", "estore-woocommerce"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Pagespeed Plugin", "estore-woocommerce"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Only Show Header Image On Front Page", "estore-woocommerce"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Show Header Everywhere", "estore-woocommerce"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Custom Text On Header Image", "estore-woocommerce"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Full Width (Hide Sidebar)", "estore-woocommerce"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Only Show Upper Widgets On Front Page", "estore-woocommerce"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Replace Copyright Text", "estore-woocommerce"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Upper Widgets Colors", "estore-woocommerce"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Navigation Color", "estore-woocommerce"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Post/Page Color", "estore-woocommerce"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Blog Feed Color", "estore-woocommerce"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Footer Color", "estore-woocommerce"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Sidebar Color", "estore-woocommerce"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Background Color", "estore-woocommerce"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Importable Demo Content	", "estore-woocommerce"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
			</tbody>
		</table>
		<div class="estore-woocommerce-button-container">
			<a target="_blank" href="<?php echo esc_url( ESTORE_WOOCOMMERCE_GET_PREMIUM_PRO ); ?>" class="button button-primary get">
				<?php esc_html_e("Go Premium", "estore-woocommerce"); ?>
			</a>
		</div>
	</div>
	<?php
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'estore_woocommerce_loop_columns');
if (!function_exists('estore_woocommerce_loop_columns')) {
	function estore_woocommerce_loop_columns() {
		$columns = get_theme_mod( 'estore_woocommerce_products_per_row', 3 );
		return $columns; // 3 products per row
	}
}