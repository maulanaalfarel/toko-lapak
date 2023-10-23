<?php
//about theme info
add_action( 'admin_menu', 'product_comparison_woocommerce_gettingstarted' );
function product_comparison_woocommerce_gettingstarted() {
	add_theme_page( esc_html__('About Product Comparison Woocommerce ', 'product-comparison-woocommerce'), esc_html__('About Product Comparison Woocommerce ', 'product-comparison-woocommerce'), 'edit_theme_options', 'product_comparison_woocommerce_guide', 'product_comparison_woocommerce_mostrar_guide');
}

// Add a Custom CSS file to WP Admin Area
function product_comparison_woocommerce_admin_theme_style() {
	wp_enqueue_style('product-comparison-woocommerce-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/getstart/getstart.css');
	wp_enqueue_script('product-comparison-woocommerce-tabs', esc_url(get_template_directory_uri()) . '/inc/getstart/js/tab.js');
}
add_action('admin_enqueue_scripts', 'product_comparison_woocommerce_admin_theme_style');

//guidline for about theme
function product_comparison_woocommerce_mostrar_guide() { 
	//custom function about theme customizer
	$product_comparison_woocommerce_return = add_query_arg( array()) ;
	$product_comparison_woocommerce_theme = wp_get_theme( 'product-comparison-woocommerce' );
?>

<div class="wrapper-info">
    <div class="col-left">
    	<h2><?php esc_html_e( 'Welcome to Product Comparison Woocommerce ', 'product-comparison-woocommerce' ); ?> <span class="version"><?php esc_html_e( 'Version', 'product-comparison-woocommerce' ); ?>: <?php echo esc_html($product_comparison_woocommerce_theme['Version']);?></span></h2>
    	<p><?php esc_html_e('All our WordPress themes are modern, minimalist, 100% responsive, seo-friendly,feature-rich, and multipurpose that best suit designers, bloggers and other professionals who are working in the creative fields.','product-comparison-woocommerce'); ?></p>
    </div>

    <div class="tab-sec">
    	<div class="tab">
			<button class="tablinks" onclick="product_comparison_woocommerce_open_tab(event, 'lite_theme')"><?php esc_html_e( 'Setup With Customizer', 'product-comparison-woocommerce' ); ?></button>
			<button class="tablinks" onclick="product_comparison_woocommerce_open_tab(event, 'gutenberg_editor')"><?php esc_html_e( 'Setup With Gutunberg Block', 'product-comparison-woocommerce' ); ?></button>
		</div>

		<?php
			$product_comparison_woocommerce_plugin_custom_css = '';
			if(class_exists('Ibtana_Visual_Editor_Menu_Class')){
				$product_comparison_woocommerce_plugin_custom_css ='display: block';
			}
		?>
		<div id="lite_theme" class="tabcontent open">
			<?php if(!class_exists('Ibtana_Visual_Editor_Menu_Class')){ 
				$plugin_ins = Product_Comparison_Woocommerce_Plugin_Activation_Settings::get_instance();
				$product_comparison_woocommerce_actions = $plugin_ins->recommended_actions;
				?>
				<div class="product-comparison-woocommerce-recommended-plugins">
				    <div class="product-comparison-woocommerce-action-list">
				        <?php if ($product_comparison_woocommerce_actions): foreach ($product_comparison_woocommerce_actions as $key => $product_comparison_woocommerce_actionValue): ?>
				                <div class="product-comparison-woocommerce-action" id="<?php echo esc_attr($product_comparison_woocommerce_actionValue['id']);?>">
			                        <div class="action-inner">
			                            <h3 class="action-title"><?php echo esc_html($product_comparison_woocommerce_actionValue['title']); ?></h3>
			                            <div class="action-desc"><?php echo esc_html($product_comparison_woocommerce_actionValue['desc']); ?></div>
			                            <?php echo wp_kses_post($product_comparison_woocommerce_actionValue['link']); ?>
			                            <a class="ibtana-skip-btn" get-start-tab-id="lite-theme-tab" href="javascript:void(0);"><?php esc_html_e('Skip','product-comparison-woocommerce'); ?></a>
			                        </div>
				                </div>
				            <?php endforeach;
				        endif; ?>
				    </div>
				</div>
			<?php } ?>
			<div class="lite-theme-tab" style="<?php echo esc_attr($product_comparison_woocommerce_plugin_custom_css); ?>">
				<h3><?php esc_html_e( 'Lite Theme Information', 'product-comparison-woocommerce' ); ?></h3>
				<hr class="h3hr">
				<p><?php esc_html_e('Product Comparison Woocommerce is a versatile and user-friendly website template designed for websites that want to offer product comparison functionality. Its a purpose-built theme for e-commerce businesses, bloggers, and affiliate marketers looking to enhance their customers shopping experience. This theme is specifically crafted to streamline the process of comparing different products on an online store. It provides a visually appealing and organized layout that makes it easy for visitors to compare features, prices, and other essential details of various products side by side. This theme can be used by anyone running a WooCommerce-powered website, regardless of their technical expertise. Its user-friendly interface allows even beginners to set up and manage product comparison tables effortlessly. It offers customization options, allowing site owners to match their brands look and feel. Visually, the Product Comparison Woocommerce theme is clean, responsive, and optimized for mobile devices. It ensures a seamless experience for users on various screen sizes. The themes design focuses on clarity, making it simple for customers to evaluate and make informed purchasing decisions. The Product Comparison Woocommerce WordPress theme is a valuable tool for e-commerce businesses and bloggers aiming to offer product comparison features on their websites. Its user-friendly, visually appealing, and designed to enhance the shopping experience for all types of users, making it a valuable asset for anyone looking to boost their online sales and customer satisfaction.','product-comparison-woocommerce'); ?></p>
			  	<div class="col-left-inner">
			  		<h4><?php esc_html_e( 'Theme Documentation', 'product-comparison-woocommerce' ); ?></h4>
					<p><?php esc_html_e( 'If you need any assistance regarding setting up and configuring the Theme, our documentation is there.', 'product-comparison-woocommerce' ); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( WOOCOMMERCR_PRODUCT_COMPARISON_FREE_THEME_DOC ); ?>" target="_blank"> <?php esc_html_e( 'Documentation', 'product-comparison-woocommerce' ); ?></a>
					</div>
					<hr>
					<h4><?php esc_html_e('Theme Customizer', 'product-comparison-woocommerce'); ?></h4>
					<p> <?php esc_html_e('To begin customizing your website, start by clicking "Customize".', 'product-comparison-woocommerce'); ?></p>
					<div class="info-link">
						<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Customizing', 'product-comparison-woocommerce'); ?></a>
					</div>
					<hr>
					<h4><?php esc_html_e('Having Trouble, Need Support?', 'product-comparison-woocommerce'); ?></h4>
					<p> <?php esc_html_e('Our dedicated team is well prepared to help you out in case of queries and doubts regarding our theme.', 'product-comparison-woocommerce'); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( WOOCOMMERCR_PRODUCT_COMPARISON_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support Forum', 'product-comparison-woocommerce'); ?></a>
					</div>
					<hr>
					<h4><?php esc_html_e('Reviews & Testimonials', 'product-comparison-woocommerce'); ?></h4>
					<p> <?php esc_html_e('All the features and aspects of this WordPress Theme are phenomenal. I\'d recommend this theme to all.', 'product-comparison-woocommerce'); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( WOOCOMMERCR_PRODUCT_COMPARISON_REVIEW ); ?>" target="_blank"><?php esc_html_e('Reviews', 'product-comparison-woocommerce'); ?></a>
					</div>

					<div class="link-customizer">
						<h3><?php esc_html_e( 'Link to customizer', 'product-comparison-woocommerce' ); ?></h3>
						<hr class="h3hr">
						<div class="first-row">
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','product-comparison-woocommerce'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=product_comparison_woocommerce_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','product-comparison-woocommerce'); ?></a>
								</div>
							</div>

							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-slides"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=product_comparison_woocommerce_banner') ); ?>" target="_blank"><?php esc_html_e('Banner Settings','product-comparison-woocommerce'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-category"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=product_comparison_woocommerce_best_product_section') ); ?>" target="_blank"><?php esc_html_e('Best Product Section','product-comparison-woocommerce'); ?></a>
								</div>
							</div>
						
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','product-comparison-woocommerce'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','product-comparison-woocommerce'); ?></a>
								</div>
							</div>
							
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=product_comparison_woocommerce_left_right') ); ?>" target="_blank"><?php esc_html_e('General Settings','product-comparison-woocommerce'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=product_comparison_woocommerce_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','product-comparison-woocommerce'); ?></a>
								</div>
							</div>
						</div>
					</div>
			  	</div>
				<div class="col-right-inner">
					<h3 class="page-template"><?php esc_html_e('How to set up Home Page Template','product-comparison-woocommerce'); ?></h3>
				  	<hr class="h3hr">
					<p><?php esc_html_e('Follow these instructions to setup Home page.','product-comparison-woocommerce'); ?></p>
                  	<p><span class="strong"><?php esc_html_e('1. Create a new page :','product-comparison-woocommerce'); ?></span><?php esc_html_e(' Go to ','product-comparison-woocommerce'); ?>
					  	<b><?php esc_html_e(' Dashboard >> Pages >> Add New Page','product-comparison-woocommerce'); ?></b></p>
                  	<p><?php esc_html_e('Name it as "Home" then select the template "Custom Home Page".','product-comparison-woocommerce'); ?></p>
                  	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/home-page-template.png" alt="" />
                  	<p><span class="strong"><?php esc_html_e('2. Set the front page:','product-comparison-woocommerce'); ?></span><?php esc_html_e(' Go to ','product-comparison-woocommerce'); ?>
					  	<b><?php esc_html_e(' Settings >> Reading ','product-comparison-woocommerce'); ?></b></p>
				  	<p><?php esc_html_e('Select the option of Static Page, now select the page you created to be the homepage, while another page to be your default page.','product-comparison-woocommerce'); ?></p>
                  	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/set-front-page.png" alt="" />
                  	<p><?php esc_html_e(' Once you are done with setup, then follow the','product-comparison-woocommerce'); ?> <a class="doc-links" href="<?php echo esc_url( WOOCOMMERCR_PRODUCT_COMPARISON_FREE_THEME_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation','product-comparison-woocommerce'); ?></a></p>
			  	</div>
			</div>
		</div>
		
		<div id="gutenberg_editor" class="tabcontent">
			<?php if(!class_exists('Ibtana_Visual_Editor_Menu_Class')){ 
			$plugin_ins = Product_Comparison_Woocommerce_Plugin_Activation_Settings::get_instance();
			$product_comparison_woocommerce_actions = $plugin_ins->recommended_actions;
			?>
				<div class="product-comparison-woocommerce-recommended-plugins">
				    <div class="product-comparison-woocommerce-action-list">
				        <?php if ($product_comparison_woocommerce_actions): foreach ($product_comparison_woocommerce_actions as $key => $product_comparison_woocommerce_actionValue): ?>
				                <div class="product-comparison-woocommerce-action" id="<?php echo esc_attr($product_comparison_woocommerce_actionValue['id']);?>">
			                        <div class="action-inner plugin-activation-redirect">
			                            <h3 class="action-title"><?php echo esc_html($product_comparison_woocommerce_actionValue['title']); ?></h3>
			                            <div class="action-desc"><?php echo esc_html($product_comparison_woocommerce_actionValue['desc']); ?></div>
			                            <?php echo wp_kses_post($product_comparison_woocommerce_actionValue['link']); ?>
			                        </div>
				                </div>
				            <?php endforeach;
				        endif; ?>
				    </div>
				</div>
			<?php }else{ ?>
				<h3><?php esc_html_e( 'Gutunberg Blocks', 'product-comparison-woocommerce' ); ?></h3>
				<hr class="h3hr">
				<div class="product-comparison-woocommerce-pattern-page">
			    	<a href="<?php echo esc_url( admin_url( 'admin.php?page=ibtana-visual-editor-templates' ) ); ?>" class="vw-pattern-page-btn ibtana-dashboard-page-btn button-primary button"><?php esc_html_e('Ibtana Settings','product-comparison-woocommerce'); ?></a>
			    </div>

			    <div class="link-customizer-with-guternberg-ibtana">
	              	<div class="link-customizer-with-block-pattern">
						<h3><?php esc_html_e( 'Link to customizer', 'product-comparison-woocommerce' ); ?></h3>
						<hr class="h3hr">
						<div class="first-row">
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','product-comparison-woocommerce'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=product_comparison_woocommerce_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','product-comparison-woocommerce'); ?></a>
								</div>
							</div>
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','product-comparison-woocommerce'); ?></a>
								</div>
								
								<div class="row-box2">
									<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=product_comparison_woocommerce_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','product-comparison-woocommerce'); ?></a>
								</div>
							</div>
							
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=product_comparison_woocommerce_left_right') ); ?>" target="_blank"><?php esc_html_e('General Settings','product-comparison-woocommerce'); ?></a>
								</div>
								 <div class="row-box2">
									<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','product-comparison-woocommerce'); ?></a>
								</div> 
							</div>
						</div>
					</div>	
				</div>
			<?php } ?>
		</div>
	</div>
</div>

<?php } ?>