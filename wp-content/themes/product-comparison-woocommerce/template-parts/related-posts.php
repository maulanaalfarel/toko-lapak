<?php
/**
 * Related posts based on categories and tags.
 * 
 */

$product_comparison_woocommerce_related_posts_taxonomy = get_theme_mod( 'product_comparison_woocommerce_related_posts_taxonomy', 'category' );

$product_comparison_woocommerce_post_args = array(
    'posts_per_page'    => absint( get_theme_mod( 'product_comparison_woocommerce_related_posts_count', '3' ) ),
    'orderby'           => 'rand',
    'post__not_in'      => array( get_the_ID() ),
);

$product_comparison_woocommerce_tax_terms = wp_get_post_terms( get_the_ID(), 'category' );
$product_comparison_woocommerce_terms_ids = array();
foreach( $product_comparison_woocommerce_tax_terms as $tax_term ) {
	$product_comparison_woocommerce_terms_ids[] = $tax_term->term_id;
}

$product_comparison_woocommerce_post_args['category__in'] = $product_comparison_woocommerce_terms_ids; 

if(get_theme_mod('product_comparison_woocommerce_related_post',true)==1){

$product_comparison_woocommerce_related_posts = new WP_Query( $product_comparison_woocommerce_post_args );

if ( $product_comparison_woocommerce_related_posts->have_posts() ) : ?>
    <div class="related-post">
        <h3 class="py-3"><?php echo esc_html(get_theme_mod('product_comparison_woocommerce_related_post_title','Related Post'));?></h3>
        <div class="row">
            <?php while ( $product_comparison_woocommerce_related_posts->have_posts() ) : $product_comparison_woocommerce_related_posts->the_post(); ?>
                <?php get_template_part('template-parts/grid-layout'); ?>
            <?php endwhile; ?>
        </div>
    </div>
<?php endif;
wp_reset_postdata();

}