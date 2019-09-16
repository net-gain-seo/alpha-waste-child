<?php

/**
 * Template Name: Single Product
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 1.6.4
 */
 ?>
<?php
    get_header();

?>

<?php while ( have_posts() ) : the_post();
$terms = get_the_terms( $post->ID, 'product_cat' );
?>
<div class="mast product-mast greenbar">
  <div class="container mast-overlay">
    <h1><?php the_title(); ?></h1>
    <span class="category-list"><?php echo wc_get_product_category_list($product->get_id()) ?></span>
    <?php foreach ( $terms as $term ){
          $category_name = $term->name;
          $category_thumbnail = get_woocommerce_term_meta($term->term_id, 'thumbnail_id', true);
          $image = wp_get_attachment_url($category_thumbnail);
          echo '<img class="absolute category-image" src="'.$image.'">';
        }?>
  </div>
</div>
<div class="container ">
  <div>
      <div class="row padding0">
        <div class="col col-lg-12 col-md-12 col-sm-12 col-xsm-12">
          <img src="<?php echo get_post_meta( $post->ID, '_banner_image', true ); ?>" width="100%" class="productbannerimage"/>
          <p class="producttagline"><?php echo get_post_meta( $post->ID, '_tag_line', true ); ?></p>
          <p>Price includes delivery and VAT*</p>
          <p>Product ID: <?php echo get_post_meta( $post->ID, '_sku', true ); ?></p>
          <p>Are you looking for a larger quantity?</p>
          <p><a href="javascript:void(0);" class="button" data-toggle="modal" data-target="#bulkForm">GET A QUOTE</a></p>
            <?php the_content(); ?>
        </div>
    </div>
  </div>
</div>

<?php endwhile; // End of the loop. ?>

<?php
    get_footer();
