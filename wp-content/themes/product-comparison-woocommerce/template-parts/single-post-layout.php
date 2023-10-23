<?php
/**
 * The template part for displaying single post content
 *
 * @package Product Comparison Woocommerce 
 * @subpackage product-comparison-woocommerce
 * @since product-comparison-woocommerce 1.0
 */
?>

<?php
    $product_comparison_woocommerce_archive_year  = get_the_time('Y');
    $product_comparison_woocommerce_archive_month = get_the_time('m');
    $product_comparison_woocommerce_archive_day   = get_the_time('d');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
    <h1><?php the_title(); ?></h1>
    <?php if( get_theme_mod( 'product_comparison_woocommerce_toggle_postdate',true) == 1 || get_theme_mod( 'product_comparison_woocommerce_toggle_author',true) == 1 || get_theme_mod( 'product_comparison_woocommerce_toggle_comments',true) == 1 || get_theme_mod( 'product_comparison_woocommerce_toggle_time',true) == 1) { ?>
        <div class="post-info p-2 mb-3">
            <?php if(get_theme_mod('product_comparison_woocommerce_toggle_postdate',true)==1){ ?>
                <i class="fas fa-calendar-alt me-2"></i><span class="entry-date"><a href="<?php echo esc_url( get_day_link( $product_comparison_woocommerce_archive_year, $product_comparison_woocommerce_archive_month, $product_comparison_woocommerce_archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span>
            <?php } ?>

            <?php if(get_theme_mod('product_comparison_woocommerce_toggle_author',true)==1){ ?>
                <span><?php echo esc_html(get_theme_mod('product_comparison_woocommerce_meta_field_separator', '|'));?></span> <i class="fas fa-user me-2"></i><span class="entry-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span>
            <?php } ?>

            <?php if(get_theme_mod('product_comparison_woocommerce_toggle_comments',true)==1){ ?>
                <span><?php echo esc_html(get_theme_mod('product_comparison_woocommerce_meta_field_separator', '|'));?></span> <i class="fa fa-comments me-2" aria-hidden="true"></i><span class="entry-comments"><?php comments_number( __('0 Comment', 'product-comparison-woocommerce'), __('0 Comments', 'product-comparison-woocommerce'), __('% Comments', 'product-comparison-woocommerce') ); ?></span>
            <?php } ?>

            <?php if(get_theme_mod('product_comparison_woocommerce_toggle_time',true)==1){ ?>
              <span><?php echo esc_html(get_theme_mod('product_comparison_woocommerce_meta_field_separator', '|'));?></span> <i class="fas fa-clock me-2"></i> <span class="entry-time"><?php echo esc_html( get_the_time() ); ?></span>
            <?php } ?>
        </div>
    <?php } ?>
    <?php if(has_post_thumbnail()) { ?>
        <div class="feature-box">
            <img class="page-image" src="<?php esc_url(the_post_thumbnail_url('full')); ?>" alt="<?php the_title(); ?> post thumbnail image">
            <hr>
        </div>
    <?php } ?>
    <div class="entry-content">
        <?php the_content(); ?>
    </div>
    <?php if(get_theme_mod('product_comparison_woocommerce_toggle_tags',false)==1){ ?>
        <div class="tags-bg p-2 mt-3 mb-3">
            <?php the_tags(); ?>
        </div>
    <?php } ?>
        <?php
        // If comments are open or we have at least one comment, load up the comment template
        if ( comments_open() || '0' != get_comments_number() )
        comments_template();

        if ( is_singular( 'attachment' ) ) {
            // Parent post navigation.
            the_post_navigation( array(
                'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'product-comparison-woocommerce' ),
            ) );
        } elseif ( is_singular( 'post' ) ) {
            // Previous/next post navigation.
            the_post_navigation( array(
                'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'product-comparison-woocommerce' ) . '</span> ' .
                    '<span class="screen-reader-text">' . __( 'Next post:', 'product-comparison-woocommerce' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
                'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'product-comparison-woocommerce' ) . '</span> ' .
                    '<span class="screen-reader-text">' . __( 'Previous post:', 'product-comparison-woocommerce' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
            ) );
        }
    ?>
    <?php get_template_part('template-parts/related-posts'); ?>
</article>