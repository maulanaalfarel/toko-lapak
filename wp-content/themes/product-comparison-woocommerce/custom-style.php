<?php

	$product_comparison_woocommerce_custom_css= "";

	/*---------------------------Width Layout -------------------*/

	$product_comparison_woocommerce_theme_lay = get_theme_mod( 'product_comparison_woocommerce_width_option','Full Width');
    if($product_comparison_woocommerce_theme_lay == 'Boxed'){
		$product_comparison_woocommerce_custom_css .='body{';
			$product_comparison_woocommerce_custom_css .='max-width: 1140px; width: 100%; margin-right: auto; margin-left: auto;';
		$product_comparison_woocommerce_custom_css .='}';
		$product_comparison_woocommerce_custom_css .='.scrollup i{';
			$product_comparison_woocommerce_custom_css .='right: 100px;';
		$product_comparison_woocommerce_custom_css .='}';
		$product_comparison_woocommerce_custom_css .='.row.outer-logo{';
			$product_comparison_woocommerce_custom_css .='margin-left: 0px;';
		$product_comparison_woocommerce_custom_css .='}';
	}else if($product_comparison_woocommerce_theme_lay == 'Wide Width'){
		$product_comparison_woocommerce_custom_css .='body{';
			$product_comparison_woocommerce_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$product_comparison_woocommerce_custom_css .='}';
		$product_comparison_woocommerce_custom_css .='.scrollup i{';
			$product_comparison_woocommerce_custom_css .='right: 30px;';
		$product_comparison_woocommerce_custom_css .='}';
		$product_comparison_woocommerce_custom_css .='.row.outer-logo{';
			$product_comparison_woocommerce_custom_css .='margin-left: 0px;';
		$product_comparison_woocommerce_custom_css .='}';
	}else if($product_comparison_woocommerce_theme_lay == 'Full Width'){
		$product_comparison_woocommerce_custom_css .='body{';
			$product_comparison_woocommerce_custom_css .='max-width: 100%;';
		$product_comparison_woocommerce_custom_css .='}';
	}

	/*----------------Responsive Media -----------------------*/

	$product_comparison_woocommerce_resp_slider = get_theme_mod( 'product_comparison_woocommerce_resp_slider_hide_show',false);
	if($product_comparison_woocommerce_resp_slider == true && get_theme_mod( 'product_comparison_woocommerce_slider_hide_show', false) == false){
    	$product_comparison_woocommerce_custom_css .='#slider{';
			$product_comparison_woocommerce_custom_css .='display:none;';
		$product_comparison_woocommerce_custom_css .='} ';
	}
    if($product_comparison_woocommerce_resp_slider == true){
    	$product_comparison_woocommerce_custom_css .='@media screen and (max-width:575px) {';
		$product_comparison_woocommerce_custom_css .='#slider{';
			$product_comparison_woocommerce_custom_css .='display:block;';
		$product_comparison_woocommerce_custom_css .='} }';
	}else if($product_comparison_woocommerce_resp_slider == false){
		$product_comparison_woocommerce_custom_css .='@media screen and (max-width:575px) {';
		$product_comparison_woocommerce_custom_css .='#slider{';
			$product_comparison_woocommerce_custom_css .='display:none;';
		$product_comparison_woocommerce_custom_css .='} }';
		$product_comparison_woocommerce_custom_css .='@media screen and (max-width:575px){';
		$product_comparison_woocommerce_custom_css .='.page-template-custom-home-page.admin-bar .homepageheader{';
			$product_comparison_woocommerce_custom_css .='margin-top: 45px;';
		$product_comparison_woocommerce_custom_css .='} }';
	}

	$product_comparison_woocommerce_resp_sidebar = get_theme_mod( 'product_comparison_woocommerce_sidebar_hide_show',true);
    if($product_comparison_woocommerce_resp_sidebar == true){
    	$product_comparison_woocommerce_custom_css .='@media screen and (max-width:575px) {';
		$product_comparison_woocommerce_custom_css .='#sidebar{';
			$product_comparison_woocommerce_custom_css .='display:block;';
		$product_comparison_woocommerce_custom_css .='} }';
	}else if($product_comparison_woocommerce_resp_sidebar == false){
		$product_comparison_woocommerce_custom_css .='@media screen and (max-width:575px) {';
		$product_comparison_woocommerce_custom_css .='#sidebar{';
			$product_comparison_woocommerce_custom_css .='display:none;';
		$product_comparison_woocommerce_custom_css .='} }';
	}

	$product_comparison_woocommerce_resp_scroll_top = get_theme_mod( 'product_comparison_woocommerce_resp_scroll_top_hide_show',true);
	if($product_comparison_woocommerce_resp_scroll_top == true && get_theme_mod( 'product_comparison_woocommerce_hide_show_scroll',true) == false){
    	$product_comparison_woocommerce_custom_css .='.scrollup i{';
			$product_comparison_woocommerce_custom_css .='visibility:hidden !important;';
		$product_comparison_woocommerce_custom_css .='} ';
	}
    if($product_comparison_woocommerce_resp_scroll_top == true){
    	$product_comparison_woocommerce_custom_css .='@media screen and (max-width:575px) {';
		$product_comparison_woocommerce_custom_css .='.scrollup i{';
			$product_comparison_woocommerce_custom_css .='visibility:visible !important;';
		$product_comparison_woocommerce_custom_css .='} }';
	}else if($product_comparison_woocommerce_resp_scroll_top == false){
		$product_comparison_woocommerce_custom_css .='@media screen and (max-width:575px){';
		$product_comparison_woocommerce_custom_css .='.scrollup i{';
			$product_comparison_woocommerce_custom_css .='visibility:hidden !important;';
		$product_comparison_woocommerce_custom_css .='} }';
	}

	/*-------------- Copyright Alignment ----------------*/

	$product_comparison_woocommerce_copyright_alingment = get_theme_mod('product_comparison_woocommerce_copyright_alingment');
	if($product_comparison_woocommerce_copyright_alingment != false){
		$product_comparison_woocommerce_custom_css .='.copyright p{';
			$product_comparison_woocommerce_custom_css .='text-align: '.esc_attr($product_comparison_woocommerce_copyright_alingment).';';
		$product_comparison_woocommerce_custom_css .='}';
	}

	/*------------- Preloader Background Color  -------------------*/

	$product_comparison_woocommerce_preloader_bg_color = get_theme_mod('product_comparison_woocommerce_preloader_bg_color');
	if($product_comparison_woocommerce_preloader_bg_color != false){
		$product_comparison_woocommerce_custom_css .='#preloader{';
			$product_comparison_woocommerce_custom_css .='background-color: '.esc_attr($product_comparison_woocommerce_preloader_bg_color).';';
		$product_comparison_woocommerce_custom_css .='}';
	}

	$product_comparison_woocommerce_preloader_border_color = get_theme_mod('product_comparison_woocommerce_preloader_border_color');
	if($product_comparison_woocommerce_preloader_border_color != false){
		$product_comparison_woocommerce_custom_css .='.loader-line{';
			$product_comparison_woocommerce_custom_css .='border-color: '.esc_attr($product_comparison_woocommerce_preloader_border_color).'!important;';
		$product_comparison_woocommerce_custom_css .='}';
	}

	// banner background img

	$product_comparison_woocommerce_banner_image = get_theme_mod('product_comparison_woocommerce_banner_image');
	if($product_comparison_woocommerce_banner_image != false){
		$product_comparison_woocommerce_custom_css .='#banner{';
			$product_comparison_woocommerce_custom_css .='background: url('.esc_url($product_comparison_woocommerce_banner_image).');';
		$product_comparison_woocommerce_custom_css .='}';
	}

	/*----------------- Banner -----------------*/

	$product_comparison_woocommerce_show_hide_banner = get_theme_mod('product_comparison_woocommerce_show_hide_banner');
	if($product_comparison_woocommerce_show_hide_banner == false){
		$product_comparison_woocommerce_custom_css .='.page-template-custom-home-page .home-page-header{';
			$product_comparison_woocommerce_custom_css .='position: static; border-bottom:2px solid #eb353c; padding: 30px 0;margin-top:0;';
		$product_comparison_woocommerce_custom_css .='}';
	}
