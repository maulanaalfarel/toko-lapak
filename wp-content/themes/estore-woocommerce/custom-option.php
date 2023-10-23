<?php

    $estore_woocommerce_theme_css= "";

    /*--------------------------- Scroll to top positions -------------------*/

    $estore_woocommerce_scroll_position = get_theme_mod( 'estore_woocommerce_scroll_top_position','Right');
    if($estore_woocommerce_scroll_position == 'Right'){
        $estore_woocommerce_theme_css .='#button{';
            $estore_woocommerce_theme_css .='right: 20px;';
        $estore_woocommerce_theme_css .='}';
    }else if($estore_woocommerce_scroll_position == 'Left'){
        $estore_woocommerce_theme_css .='#button{';
            $estore_woocommerce_theme_css .='left: 20px;';
        $estore_woocommerce_theme_css .='}';
    }else if($estore_woocommerce_scroll_position == 'Center'){
        $estore_woocommerce_theme_css .='#button{';
            $estore_woocommerce_theme_css .='right: 50%;left: 50%;';
        $estore_woocommerce_theme_css .='}';
    }

    /*--------------------------- Slider Opacity -------------------*/

    $estore_woocommerce_theme_lay = get_theme_mod( 'estore_woocommerce_slider_opacity_color','0.5');
    if($estore_woocommerce_theme_lay == '0'){
        $estore_woocommerce_theme_css .='.slider-box img{';
            $estore_woocommerce_theme_css .='opacity:0';
        $estore_woocommerce_theme_css .='}';
        }else if($estore_woocommerce_theme_lay == '0.1'){
        $estore_woocommerce_theme_css .='.slider-box img{';
            $estore_woocommerce_theme_css .='opacity:0.1';
        $estore_woocommerce_theme_css .='}';
        }else if($estore_woocommerce_theme_lay == '0.2'){
        $estore_woocommerce_theme_css .='.slider-box img{';
            $estore_woocommerce_theme_css .='opacity:0.2';
        $estore_woocommerce_theme_css .='}';
        }else if($estore_woocommerce_theme_lay == '0.3'){
        $estore_woocommerce_theme_css .='.slider-box img{';
            $estore_woocommerce_theme_css .='opacity:0.3';
        $estore_woocommerce_theme_css .='}';
        }else if($estore_woocommerce_theme_lay == '0.4'){
        $estore_woocommerce_theme_css .='.slider-box img{';
            $estore_woocommerce_theme_css .='opacity:0.4';
        $estore_woocommerce_theme_css .='}';
        }else if($estore_woocommerce_theme_lay == '0.5'){
        $estore_woocommerce_theme_css .='.slider-box img{';
            $estore_woocommerce_theme_css .='opacity:0.5';
        $estore_woocommerce_theme_css .='}';
        }else if($estore_woocommerce_theme_lay == '0.6'){
        $estore_woocommerce_theme_css .='.slider-box img{';
            $estore_woocommerce_theme_css .='opacity:0.6';
        $estore_woocommerce_theme_css .='}';
        }else if($estore_woocommerce_theme_lay == '0.7'){
        $estore_woocommerce_theme_css .='.slider-box img{';
            $estore_woocommerce_theme_css .='opacity:0.7';
        $estore_woocommerce_theme_css .='}';
        }else if($estore_woocommerce_theme_lay == '0.8'){
        $estore_woocommerce_theme_css .='.slider-box img{';
            $estore_woocommerce_theme_css .='opacity:0.8';
        $estore_woocommerce_theme_css .='}';
        }else if($estore_woocommerce_theme_lay == '0.9'){
        $estore_woocommerce_theme_css .='.slider-box img{';
            $estore_woocommerce_theme_css .='opacity:0.9';
        $estore_woocommerce_theme_css .='}';
        }