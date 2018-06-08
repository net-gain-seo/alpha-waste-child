<?php
/**
 * Template Name: View All Products
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

 if ( ! defined( 'ABSPATH' ) ) {
 	exit; // Exit if accessed directly
 }

 get_header( 'shop' ); ?>
 <div class="mast page-mast">
	 <div class="opacitybanner"></div>
		 <?php
				 if( has_post_thumbnail() ) {
						 the_post_thumbnail();
				 } else {
						 echo '<img src="'. home_url() . '/wp-content/uploads/2018/05/LeafBanner.jpg" />';
				 }

					 $mast_title       = get_post_meta( get_the_ID(), 'mast_title', true );
					 $mast_description = get_post_meta( get_the_ID(), 'mast_description', true );

					 if( empty($mast_title) ) {
							 $mast_title =  the_title('<h1>', '</h1>', false);
					 }
		 ?>
			 <div class="container mast-overlay">
					 <?php
							 echo $mast_title;

							 if( !empty($mast_description) ) {
									 echo wpautop( $mast_description );
							 }
					 ?>
			 </div>
 </div>
<div class="page-content">
 <div class="container">
 	<div class="row padding0">
 		<div class="col col-lg-12 col-md-12 col-sm-12 col-xsm-12 ">
 	<?php
 		/**
 		 * woocommerce_before_main_content hook.
 		 *
 		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 		 * @hooked woocommerce_breadcrumb - 20
 		 * @hooked WC_Structured_Data::generate_website_data() - 30
 		 */
 		//do_action( 'woocommerce_before_main_content' );
 	?>
 		<?php if ( have_posts() ) : ?>

 			<?php
 				/**
 				 * woocommerce_before_shop_loop hook.
 				 *
 				 * @hooked wc_print_notices - 10
 				 * @hooked woocommerce_result_count - 20
 				 * @hooked woocommerce_catalog_ordering - 30
 				 */
 				do_action( 'woocommerce_before_shop_loop' );
 			?>

 			<?php woocommerce_product_loop_start(); ?>

 				<?php woocommerce_product_subcategories(); ?>

 				<?php while ( have_posts() ) : the_post(); ?>

					 <?php echo do_shortcode( '[products ids="all"]' ); ?>

 					<?php
 						/**
 						 * woocommerce_shop_loop hook.
 						 *
 						 * @hooked WC_Structured_Data::generate_product_data() - 10
 						 */
 						do_action( 'woocommerce_shop_loop' );
 					?>

 					<?php wc_get_template_part( 'content', 'product' ); ?>

 				<?php endwhile; // end of the loop. ?>

 			<?php woocommerce_product_loop_end(); ?>

 			<?php
 				/**
 				 * woocommerce_after_shop_loop hook.
 				 *
 				 * @hooked woocommerce_pagination - 10
 				 */
 				do_action( 'woocommerce_after_shop_loop' );
 			?>

 		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

 			<?php
 				/**
 				 * woocommerce_no_products_found hook.
 				 *
 				 * @hooked wc_no_products_found - 10
 				 */
 				do_action( 'woocommerce_no_products_found' );
 			?>

 		<?php endif; ?>

 	<?php
 		/**
 		 * woocommerce_after_main_content hook.
 		 *
 		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 		 */
 		do_action( 'woocommerce_after_main_content' );
 	?>
 </div>
 </div>
 </div>
</div>
 <?php get_footer( 'shop' ); ?>
