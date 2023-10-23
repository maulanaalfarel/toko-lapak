<?php
/**
 * Product Comparison Woocommerce Theme Customizer
 *
 * @package Product Comparison Woocommerce
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function product_comparison_woocommerce_custom_controls() {
	load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'product_comparison_woocommerce_custom_controls' );

function product_comparison_woocommerce_customize_register( $wp_customize ) {


	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.logo .site-title a',
	 	'render_callback' => 'product_comparison_woocommerce_Customize_partial_blogname',
	));

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => 'p.site-description',
		'render_callback' => 'product_comparison_woocommerce_Customize_partial_blogdescription',
	));

	// add home page setting pannel
	$wp_customize->add_panel( 'product_comparison_woocommerce_panel_id', array(
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => esc_html__( 'Homepage Settings', 'product-comparison-woocommerce' ),
		'priority' => 10,
	));

	// Layout
	$wp_customize->add_section( 'product_comparison_woocommerce_left_right', array(
    	'title' => esc_html__('General Settings', 'product-comparison-woocommerce'),
		'panel' => 'product_comparison_woocommerce_panel_id'
	) );

	$wp_customize->add_setting('product_comparison_woocommerce_width_option',array(
        'default' => 'Full Width',
        'sanitize_callback' => 'product_comparison_woocommerce_sanitize_choices'
	));
	$wp_customize->add_control(new Product_Comparison_Woocommerce_Image_Radio_Control($wp_customize, 'product_comparison_woocommerce_width_option', array(
        'type' => 'select',
        'label' => esc_html__('Width Layouts','product-comparison-woocommerce'),
        'description' => esc_html__('Here you can change the width layout of Website.','product-comparison-woocommerce'),
        'section' => 'product_comparison_woocommerce_left_right',
        'choices' => array(
            'Full Width' => esc_url(get_template_directory_uri()).'/assets/images/full-width.png',
            'Wide Width' => esc_url(get_template_directory_uri()).'/assets/images/wide-width.png',
            'Boxed' => esc_url(get_template_directory_uri()).'/assets/images/boxed-width.png',
    ))));

	$wp_customize->add_setting('product_comparison_woocommerce_theme_options',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'product_comparison_woocommerce_sanitize_choices'
	));
	$wp_customize->add_control('product_comparison_woocommerce_theme_options',array(
        'type' => 'select',
        'label' => esc_html__('Post Sidebar Layout','product-comparison-woocommerce'),
        'description' => esc_html__('Here you can change the sidebar layout for posts. ','product-comparison-woocommerce'),
        'section' => 'product_comparison_woocommerce_left_right',
        'choices' => array(
            'Left Sidebar' => esc_html__('Left Sidebar','product-comparison-woocommerce'),
            'Right Sidebar' => esc_html__('Right Sidebar','product-comparison-woocommerce'),
            'One Column' => esc_html__('One Column','product-comparison-woocommerce'),
            'Grid Layout' => esc_html__('Grid Layout','product-comparison-woocommerce')
        ),
	) );

	$wp_customize->add_setting('product_comparison_woocommerce_page_layout',array(
        'default' => 'One_Column',
        'sanitize_callback' => 'product_comparison_woocommerce_sanitize_choices'
	));
	$wp_customize->add_control('product_comparison_woocommerce_page_layout',array(
        'type' => 'select',
        'label' => esc_html__('Page Sidebar Layout','product-comparison-woocommerce'),
        'description' => esc_html__('Here you can change the sidebar layout for pages. ','product-comparison-woocommerce'),
        'section' => 'product_comparison_woocommerce_left_right',
        'choices' => array(
            'Left_Sidebar' => esc_html__('Left Sidebar','product-comparison-woocommerce'),
            'Right_Sidebar' => esc_html__('Right Sidebar','product-comparison-woocommerce'),
            'One_Column' => esc_html__('One Column','product-comparison-woocommerce')
        ),
	) );

	// Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'product_comparison_woocommerce_woocommerce_shop_page_sidebar', array( 'selector' => '.post-type-archive-product #sidebar',
		'render_callback' => 'product_comparison_woocommerce_customize_partial_product_comparison_woocommerce_woocommerce_shop_page_sidebar', ) );

    // Woocommerce Shop Page Sidebar
	$wp_customize->add_setting( 'product_comparison_woocommerce_woocommerce_shop_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'product_comparison_woocommerce_switch_sanitization'
    ) );
    $wp_customize->add_control( new Product_Comparison_Woocommerce_Toggle_Switch_Custom_Control( $wp_customize, 'product_comparison_woocommerce_woocommerce_shop_page_sidebar',array(
		'label' => esc_html__( 'Shop Page Sidebar','product-comparison-woocommerce' ),
		'section' => 'product_comparison_woocommerce_left_right'
    )));

    // Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'product_comparison_woocommerce_woocommerce_single_product_page_sidebar', array( 'selector' => '.single-product #sidebar',
		'render_callback' => 'product_comparison_woocommerce_customize_partial_product_comparison_woocommerce_woocommerce_single_product_page_sidebar', ) );

    //Woocommerce Single Product page Sidebar
	$wp_customize->add_setting( 'product_comparison_woocommerce_woocommerce_single_product_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'product_comparison_woocommerce_switch_sanitization'
    ) );
    $wp_customize->add_control( new Product_Comparison_Woocommerce_Toggle_Switch_Custom_Control( $wp_customize, 'product_comparison_woocommerce_woocommerce_single_product_page_sidebar',array(
		'label' => esc_html__( 'Single Product Sidebar','product-comparison-woocommerce' ),
		'section' => 'product_comparison_woocommerce_left_right'
    )));

    // Pre-Loader
	$wp_customize->add_setting( 'product_comparison_woocommerce_loader_enable',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'product_comparison_woocommerce_switch_sanitization'
    ) );
    $wp_customize->add_control( new Product_Comparison_Woocommerce_Toggle_Switch_Custom_Control( $wp_customize, 'product_comparison_woocommerce_loader_enable',array(
        'label' => esc_html__( 'Pre-Loader','product-comparison-woocommerce' ),
        'section' => 'product_comparison_woocommerce_left_right'
    )));

	$wp_customize->add_setting('product_comparison_woocommerce_preloader_bg_color', array(
		'default'           => '#D50000',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'product_comparison_woocommerce_preloader_bg_color', array(
		'label'    => __('Pre-Loader Background Color', 'product-comparison-woocommerce'),
		'section'  => 'product_comparison_woocommerce_left_right',
	)));

	$wp_customize->add_setting('product_comparison_woocommerce_preloader_border_color', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'product_comparison_woocommerce_preloader_border_color', array(
		'label'    => __('Pre-Loader Border Color', 'product-comparison-woocommerce'),
		'section'  => 'product_comparison_woocommerce_left_right',
	)));

	//Topbar
	$wp_customize->add_section('product_comparison_woocommerce_topbar_section' , array(
  		'title' => __( 'Topbar Section', 'product-comparison-woocommerce' ),
		'panel' => 'product_comparison_woocommerce_panel_id'
	) );

	$wp_customize->add_setting( 'product_comparison_woocommerce_header_topbar',array(
    	'default' => 0,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'product_comparison_woocommerce_switch_sanitization'
    ));
    $wp_customize->add_control( new Product_Comparison_Woocommerce_Toggle_Switch_Custom_Control( $wp_customize, 'product_comparison_woocommerce_header_topbar',array(
      	'label' => esc_html__( 'Show / Hide Topbar','product-comparison-woocommerce' ),
      	'section' => 'product_comparison_woocommerce_topbar_section'
    )));

	$wp_customize->add_setting('product_comparison_woocommerce_reviews_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('product_comparison_woocommerce_reviews_text',array(
		'label'	=> esc_html__('Add Reviews Text','product-comparison-woocommerce'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Reviews', 'product-comparison-woocommerce' ),
        ),
		'section'=> 'product_comparison_woocommerce_topbar_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('product_comparison_woocommerce_meta_field_separator_topheader',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('product_comparison_woocommerce_meta_field_separator_topheader',array(
		'label'	=> __('Add Meta Separator','product-comparison-woocommerce'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','product-comparison-woocommerce'),
		'section'=> 'product_comparison_woocommerce_topbar_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('product_comparison_woocommerce_reviews_link',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('product_comparison_woocommerce_reviews_link',array(
		'label'	=> esc_html__('Reviews Link','product-comparison-woocommerce'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'https://example.com/page', 'product-comparison-woocommerce' ),
        ),
		'section'=> 'product_comparison_woocommerce_topbar_section',
		'type'=> 'url'
	));

	$wp_customize->add_setting('product_comparison_woocommerce_supports_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('product_comparison_woocommerce_supports_text',array(
		'label'	=> esc_html__('Add Supports Text','product-comparison-woocommerce'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Supports', 'product-comparison-woocommerce' ),
        ),
		'section'=> 'product_comparison_woocommerce_topbar_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('product_comparison_woocommerce_supports_link',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('product_comparison_woocommerce_supports_link',array(
		'label'	=> esc_html__('Supports Link','product-comparison-woocommerce'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'https://example.com/page', 'product-comparison-woocommerce' ),
        ),
		'section'=> 'product_comparison_woocommerce_topbar_section',
		'type'=> 'url'
	));

	$wp_customize->add_setting('product_comparison_woocommerce_total_order',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('product_comparison_woocommerce_total_order',array(
		'label'	=> esc_html__('Add Total Order Text','product-comparison-woocommerce'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Free Shipping Above $100 Total Order', 'product-comparison-woocommerce' ),
        ),
		'section'=> 'product_comparison_woocommerce_topbar_section',
		'type'=> 'text'
	));

    $wp_customize->add_setting('product_comparison_woocommerce_phone_number',array(
		'default'=> '',
		'sanitize_callback'	=> 'product_comparison_woocommerce_sanitize_phone_number'
	));
	$wp_customize->add_control('product_comparison_woocommerce_phone_number',array(
		'label'	=> __('Add Phone number','product-comparison-woocommerce'),
		'input_attrs' => array(
            'placeholder' => __( '+101 987-456-3210', 'product-comparison-woocommerce' ),
        ),
		'section'=> 'product_comparison_woocommerce_topbar_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('product_comparison_woocommerce_lite_email',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_email'
	));
	$wp_customize->add_control('product_comparison_woocommerce_lite_email',array(
		'label' => __('Add Email','product-comparison-woocommerce'),
		'input_attrs' => array(
            'placeholder' => __( 'xyz123@example.com', 'product-comparison-woocommerce' ),
        ),
		'section' => 'product_comparison_woocommerce_topbar_section',
		'setting' => 'product_comparison_woocommerce_lite_email',
		'type'    => 'text'
	));

	// Middle Header
	$wp_customize->add_setting( 'product_comparison_woocommerce_header_search',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'product_comparison_woocommerce_switch_sanitization'
    ));
    $wp_customize->add_control( new Product_Comparison_Woocommerce_Toggle_Switch_Custom_Control( $wp_customize, 'product_comparison_woocommerce_header_search',array(
      	'label' => esc_html__( 'Show / Hide Search','product-comparison-woocommerce' ),
      	'section' => 'product_comparison_woocommerce_topbar_section'
    )));

	//Banner section
  	$wp_customize->add_section('product_comparison_woocommerce_banner',array(
		'title' => __('Banner Section','product-comparison-woocommerce'),
		'priority'  => null,
		'panel' => 'product_comparison_woocommerce_panel_id',
	)); 

	$wp_customize->add_setting( 'product_comparison_woocommerce_show_hide_banner',array(
    	'default' => 0,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'product_comparison_woocommerce_switch_sanitization'
    ));
    $wp_customize->add_control( new Product_Comparison_Woocommerce_Toggle_Switch_Custom_Control( $wp_customize, 'product_comparison_woocommerce_show_hide_banner',array(
      	'label' => esc_html__( 'Show / Hide Banner','product-comparison-woocommerce' ),
      	'section' => 'product_comparison_woocommerce_banner'
    )));

	$wp_customize->add_setting('product_comparison_woocommerce_banner_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'product_comparison_woocommerce_banner_image',array(
        'label' => __('Banner Background Image','product-comparison-woocommerce'),
        'description' => __('Image size (1400px x 750px)','product-comparison-woocommerce'),
        'section' => 'product_comparison_woocommerce_banner'
	)));

   $wp_customize->add_setting('product_comparison_woocommerce_tagline_title',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('product_comparison_woocommerce_tagline_title',array(
		'label'	=> __('Banner Title','product-comparison-woocommerce'),
		'section'	=> 'product_comparison_woocommerce_banner',
		'input_attrs' => array(
            'placeholder' => __( 'Compare Price & Product', 'product-comparison-woocommerce' ),
        ),
		'type'		=> 'text'
	));

	 $wp_customize->add_setting('product_comparison_woocommerce_designation_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('product_comparison_woocommerce_designation_text',array(
		'label'	=> __('Banner Small Text','product-comparison-woocommerce'),
		'section'	=> 'product_comparison_woocommerce_banner',
		'type'		=> 'text',
		'input_attrs' => array(
            'placeholder' => __( 'Sell custom on-demand printed products without any up-front investment. From print providers directly to your customers.', 'product-comparison-woocommerce' ),
        ),
	));

	$wp_customize->add_setting('product_comparison_woocommerce_banner_button_label',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field'
	));
	$wp_customize->add_control('product_comparison_woocommerce_banner_button_label',array(
		'label' => __('Button','product-comparison-woocommerce'),
		'section' => 'product_comparison_woocommerce_banner',
		'setting' => 'product_comparison_woocommerce_banner_button_label',
		'type' => 'text'
	));
	$wp_customize->add_setting('product_comparison_woocommerce_top_button_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));

	$wp_customize->add_control('product_comparison_woocommerce_top_button_url',array(
		'label'	=> __('Add Button URL','product-comparison-woocommerce'),
		'section'	=> 'product_comparison_woocommerce_banner',
		'setting'	=> 'product_comparison_woocommerce_top_button_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting( 'product_comparison_woocommerce_show_hide_product',array(
    	'default' => 0,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'product_comparison_woocommerce_switch_sanitization'
    ));
    $wp_customize->add_control( new Product_Comparison_Woocommerce_Toggle_Switch_Custom_Control( $wp_customize, 'product_comparison_woocommerce_show_hide_product',array(
      	'label' => esc_html__( 'Show / Hide Product','product-comparison-woocommerce' ),
      	'section' => 'product_comparison_woocommerce_banner'
    )));
	
	$args = array(
       'type'      => 'product',
        'taxonomy' => 'product_cat'
    );
	$categories = get_categories($args);
		$cat_posts = array();
			$i = 0;
			$cat_posts[]='Select';
		foreach($categories as $category){
			if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_posts[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('product_comparison_woocommerce_product_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'product_comparison_woocommerce_sanitize_choices',
	));
	$wp_customize->add_control('product_comparison_woocommerce_product_category',array(
		'type'    => 'select',
		'choices' => $cat_posts,
		'label' => __('Select Popular Product Category','product-comparison-woocommerce'),
		'section' => 'product_comparison_woocommerce_banner',
	));


	//  Best Product Section
	$wp_customize->add_section('product_comparison_woocommerce_best_product_section',array(
		'title'	=> __('Best Product Section','product-comparison-woocommerce'),
		'panel' => 'product_comparison_woocommerce_panel_id',
	));

	$wp_customize->add_setting( 'product_comparison_woocommerce_best_product_heading', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'product_comparison_woocommerce_best_product_heading', array(
		'label'    => __( 'Add Section Heading', 'product-comparison-woocommerce' ),
		'input_attrs' => array(
            'placeholder' => __( 'Popular Compare', 'product-comparison-woocommerce' ),
        ),
		'section'  => 'product_comparison_woocommerce_best_product_section',
		'type'     => 'text'
	) );

	$wp_customize->add_setting( 'product_comparison_woocommerce_best_product_small_title', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'product_comparison_woocommerce_best_product_small_title', array(
		'label'    => __( 'Add Section Text', 'product-comparison-woocommerce' ),
		'section'  => 'product_comparison_woocommerce_best_product_section',
		'type'     => 'text'
	) );

	$args = array(
       'type'      => 'product',
        'taxonomy' => 'product_cat'
    );
	$categories = get_categories($args);
		$cat_posts = array();
			$i = 0;
			$cat_posts[]='Select';
		foreach($categories as $category){
			if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_posts[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('product_comparison_woocommerce_best_product_category',array(
		'default'	=> 'select',
		'sanitize_callback' => 'product_comparison_woocommerce_sanitize_choices',
	));
	$wp_customize->add_control('product_comparison_woocommerce_best_product_category',array(
		'type'    => 'select',
		'choices' => $cat_posts,
		'label' => __('Select Product Category','product-comparison-woocommerce'),
		'section' => 'product_comparison_woocommerce_best_product_section',
	));

	//Blog Post
	$wp_customize->add_panel( 'product_comparison_woocommerce_blog_post_parent_panel', array(
		'title' => esc_html__( 'Blog Post Settings', 'product-comparison-woocommerce' ),
		'panel' => 'product_comparison_woocommerce_panel_id',
		'priority' => 20,
	));

	// Add example section and controls to the middle (second) panel
	$wp_customize->add_section( 'product_comparison_woocommerce_post_settings', array(
		'title' => esc_html__( 'Post Settings', 'product-comparison-woocommerce' ),
		'panel' => 'product_comparison_woocommerce_blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('product_comparison_woocommerce_toggle_postdate', array(
		'selector' => '.post-main-box h2 a',
		'render_callback' => 'product_comparison_woocommerce_Customize_partial_product_comparison_woocommerce_toggle_postdate',
	));

	$wp_customize->add_setting( 'product_comparison_woocommerce_toggle_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'product_comparison_woocommerce_switch_sanitization'
    ) );
    $wp_customize->add_control( new Product_Comparison_Woocommerce_Toggle_Switch_Custom_Control( $wp_customize, 'product_comparison_woocommerce_toggle_postdate',array(
        'label' => esc_html__( 'Post Date','product-comparison-woocommerce' ),
        'section' => 'product_comparison_woocommerce_post_settings'
    )));

    $wp_customize->add_setting( 'product_comparison_woocommerce_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'product_comparison_woocommerce_switch_sanitization'
    ) );
    $wp_customize->add_control( new Product_Comparison_Woocommerce_Toggle_Switch_Custom_Control( $wp_customize, 'product_comparison_woocommerce_toggle_author',array(
		'label' => esc_html__( 'Author','product-comparison-woocommerce' ),
		'section' => 'product_comparison_woocommerce_post_settings'
    )));

    $wp_customize->add_setting( 'product_comparison_woocommerce_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'product_comparison_woocommerce_switch_sanitization'
    ) );
    $wp_customize->add_control( new Product_Comparison_Woocommerce_Toggle_Switch_Custom_Control( $wp_customize, 'product_comparison_woocommerce_toggle_comments',array(
		'label' => esc_html__( 'Comments','product-comparison-woocommerce' ),
		'section' => 'product_comparison_woocommerce_post_settings'
    )));

    $wp_customize->add_setting( 'product_comparison_woocommerce_toggle_time',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'product_comparison_woocommerce_switch_sanitization'
    ) );
    $wp_customize->add_control( new Product_Comparison_Woocommerce_Toggle_Switch_Custom_Control( $wp_customize, 'product_comparison_woocommerce_toggle_time',array(
		'label' => esc_html__( 'Time','product-comparison-woocommerce' ),
		'section' => 'product_comparison_woocommerce_post_settings'
    )));

    $wp_customize->add_setting( 'product_comparison_woocommerce_featured_image_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'product_comparison_woocommerce_switch_sanitization'
	));
    $wp_customize->add_control( new Product_Comparison_Woocommerce_Toggle_Switch_Custom_Control( $wp_customize, 'product_comparison_woocommerce_featured_image_hide_show', array(
		'label' => esc_html__( 'Featured Image','product-comparison-woocommerce' ),
		'section' => 'product_comparison_woocommerce_post_settings'
    )));

    $wp_customize->add_setting( 'product_comparison_woocommerce_toggle_tags',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'product_comparison_woocommerce_switch_sanitization'
	));
    $wp_customize->add_control( new Product_Comparison_Woocommerce_Toggle_Switch_Custom_Control( $wp_customize, 'product_comparison_woocommerce_toggle_tags', array(
		'label' => esc_html__( 'Tags','product-comparison-woocommerce' ),
		'section' => 'product_comparison_woocommerce_post_settings'
    )));

    $wp_customize->add_setting( 'product_comparison_woocommerce_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'product_comparison_woocommerce_sanitize_number_range',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'product_comparison_woocommerce_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','product-comparison-woocommerce' ),
		'section'     => 'product_comparison_woocommerce_post_settings',
		'type'        => 'range',
		'settings'    => 'product_comparison_woocommerce_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('product_comparison_woocommerce_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('product_comparison_woocommerce_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','product-comparison-woocommerce'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','product-comparison-woocommerce'),
		'section'=> 'product_comparison_woocommerce_post_settings',
		'type'=> 'text'
	));

    $wp_customize->add_setting('product_comparison_woocommerce_excerpt_settings',array(
        'default' => 'Excerpt',
        'transport' => 'refresh',
        'sanitize_callback' => 'product_comparison_woocommerce_sanitize_choices'
	));
	$wp_customize->add_control('product_comparison_woocommerce_excerpt_settings',array(
        'type' => 'select',
        'label' => esc_html__('Post Content','product-comparison-woocommerce'),
        'section' => 'product_comparison_woocommerce_post_settings',
        'choices' => array(
        	'Content' => esc_html__('Content','product-comparison-woocommerce'),
            'Excerpt' => esc_html__('Excerpt','product-comparison-woocommerce'),
            'No Content' => esc_html__('No Content','product-comparison-woocommerce')
        ),
	) );

    // Button Settings
	$wp_customize->add_section( 'product_comparison_woocommerce_button_settings', array(
		'title' => esc_html__( 'Button Settings', 'product-comparison-woocommerce' ),
		'panel' => 'product_comparison_woocommerce_blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('product_comparison_woocommerce_button_text', array(
		'selector' => '.post-main-box .more-btn a',
		'render_callback' => 'product_comparison_woocommerce_Customize_partial_product_comparison_woocommerce_button_text',
	));

    $wp_customize->add_setting('product_comparison_woocommerce_button_text',array(
		'default'=> esc_html__('Read More','product-comparison-woocommerce'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('product_comparison_woocommerce_button_text',array(
		'label'	=> esc_html__('Add Button Text','product-comparison-woocommerce'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Read More', 'product-comparison-woocommerce' ),
        ),
		'section'=> 'product_comparison_woocommerce_button_settings',
		'type'=> 'text'
	));

	// Related Post Settings
	$wp_customize->add_section( 'product_comparison_woocommerce_related_posts_settings', array(
		'title' => esc_html__( 'Related Posts Settings', 'product-comparison-woocommerce' ),
		'panel' => 'product_comparison_woocommerce_blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('product_comparison_woocommerce_related_post_title', array(
		'selector' => '.related-post h3',
		'render_callback' => 'product_comparison_woocommerce_Customize_partial_product_comparison_woocommerce_related_post_title',
	));

    $wp_customize->add_setting( 'product_comparison_woocommerce_related_post',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'product_comparison_woocommerce_switch_sanitization'
    ) );
    $wp_customize->add_control( new Product_Comparison_Woocommerce_Toggle_Switch_Custom_Control( $wp_customize, 'product_comparison_woocommerce_related_post',array(
		'label' => esc_html__( 'Related Post','product-comparison-woocommerce' ),
		'section' => 'product_comparison_woocommerce_related_posts_settings'
    )));

    $wp_customize->add_setting('product_comparison_woocommerce_related_post_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('product_comparison_woocommerce_related_post_title',array(
		'label'	=> esc_html__('Add Related Post Title','product-comparison-woocommerce'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Related Post', 'product-comparison-woocommerce' ),
        ),
		'section'=> 'product_comparison_woocommerce_related_posts_settings',
		'type'=> 'text'
	));

   	$wp_customize->add_setting('product_comparison_woocommerce_related_posts_count',array(
		'default'=> 3,
		'sanitize_callback'	=> 'product_comparison_woocommerce_sanitize_number_absint'
	));
	$wp_customize->add_control('product_comparison_woocommerce_related_posts_count',array(
		'label'	=> esc_html__('Add Related Post Count','product-comparison-woocommerce'),
		'input_attrs' => array(
            'placeholder' => esc_html__( '3', 'product-comparison-woocommerce' ),
        ),
		'section'=> 'product_comparison_woocommerce_related_posts_settings',
		'type'=> 'number'
	));

	//Responsive Media Settings
	$wp_customize->add_section('product_comparison_woocommerce_responsive_media',array(
		'title'	=> esc_html__('Responsive Media','product-comparison-woocommerce'),
		'panel' => 'product_comparison_woocommerce_panel_id',
	));

    $wp_customize->add_setting( 'product_comparison_woocommerce_resp_scroll_top_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'product_comparison_woocommerce_switch_sanitization'
    ));
    $wp_customize->add_control( new Product_Comparison_Woocommerce_Toggle_Switch_Custom_Control( $wp_customize, 'product_comparison_woocommerce_resp_scroll_top_hide_show',array(
      	'label' => esc_html__( 'Show / Hide Scroll To Top','product-comparison-woocommerce' ),
      	'section' => 'product_comparison_woocommerce_responsive_media'
    )));

	//Footer Text
	$wp_customize->add_section('product_comparison_woocommerce_footer',array(
		'title'	=> esc_html__('Footer Settings','product-comparison-woocommerce'),
		'panel' => 'product_comparison_woocommerce_panel_id',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('product_comparison_woocommerce_footer_text', array(
		'selector' => '.copyright p',
		'render_callback' => 'product_comparison_woocommerce_Customize_partial_product_comparison_woocommerce_footer_text',
	));

	$wp_customize->add_setting('product_comparison_woocommerce_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('product_comparison_woocommerce_footer_text',array(
		'label'	=> esc_html__('Copyright Text','product-comparison-woocommerce'),
		'input_attrs' => array(
            'placeholder' => esc_html__( 'Copyright 2021, .....', 'product-comparison-woocommerce' ),
        ),
		'section'=> 'product_comparison_woocommerce_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('product_comparison_woocommerce_copyright_alingment',array(
        'default' => 'center',
        'sanitize_callback' => 'product_comparison_woocommerce_sanitize_choices'
	));
	$wp_customize->add_control(new Product_Comparison_Woocommerce_Image_Radio_Control($wp_customize, 'product_comparison_woocommerce_copyright_alingment', array(
        'type' => 'select',
        'label' => esc_html__('Copyright Alignment','product-comparison-woocommerce'),
        'section' => 'product_comparison_woocommerce_footer',
        'settings' => 'product_comparison_woocommerce_copyright_alingment',
        'choices' => array(
            'left' => esc_url(get_template_directory_uri()).'/assets/images/copyright1.png',
            'center' => esc_url(get_template_directory_uri()).'/assets/images/copyright2.png',
            'right' => esc_url(get_template_directory_uri()).'/assets/images/copyright3.png'
    ))));

    $wp_customize->add_setting( 'product_comparison_woocommerce_hide_show_scroll',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'product_comparison_woocommerce_switch_sanitization'
    ));
    $wp_customize->add_control( new Product_Comparison_Woocommerce_Toggle_Switch_Custom_Control( $wp_customize, 'product_comparison_woocommerce_hide_show_scroll',array(
      	'label' => esc_html__( 'Show / Hide Scroll to Top','product-comparison-woocommerce' ),
      	'section' => 'product_comparison_woocommerce_footer'
    )));

    //Selective Refresh
	$wp_customize->selective_refresh->add_partial('product_comparison_woocommerce_scroll_to_top_icon', array(
		'selector' => '.scrollup i',
		'render_callback' => 'product_comparison_woocommerce_Customize_partial_product_comparison_woocommerce_scroll_to_top_icon',
	));

    $wp_customize->add_setting('product_comparison_woocommerce_scroll_top_alignment',array(
        'default' => 'Right',
        'sanitize_callback' => 'product_comparison_woocommerce_sanitize_choices'
	));
	$wp_customize->add_control(new Product_Comparison_Woocommerce_Image_Radio_Control($wp_customize, 'product_comparison_woocommerce_scroll_top_alignment', array(
        'type' => 'select',
        'label' => esc_html__('Scroll To Top','product-comparison-woocommerce'),
        'section' => 'product_comparison_woocommerce_footer',
        'settings' => 'product_comparison_woocommerce_scroll_top_alignment',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/assets/images/layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/assets/images/layout2.png',
            'Right' => esc_url(get_template_directory_uri()).'/assets/images/layout3.png'
    ))));
}

add_action( 'customize_register', 'product_comparison_woocommerce_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Product_Comparison_Woocommerce_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	*/
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Product_Comparison_Woocommerce_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section( new Product_Comparison_Woocommerce_Customize_Section_Pro( $manager,'product_comparison_woocommerce_go_pro', array(
			'priority'   => 1,
			'title'    => esc_html__( 'PRODUCT COMPARISON PRO', 'product-comparison-woocommerce' ),
			'pro_text' => esc_html__( 'UPGRADE PRO', 'product-comparison-woocommerce' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/themes/price-comparison-wordpress-theme/'),
		) )	);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'product-comparison-woocommerce-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'product-comparison-woocommerce-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Product_Comparison_Woocommerce_Customize::get_instance();
