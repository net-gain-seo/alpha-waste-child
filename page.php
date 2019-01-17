<?php
    get_header();
    // $postId = get_the_post_id();
?>

<?php while ( have_posts() ) : the_post(); ?>

	<div class="mast page-mast">
        <div class="opacitybanner"></div>
	    <?php
    	    if( has_post_thumbnail() ) {
    	        the_post_thumbnail();
    	    } elseif( is_product_category( 'paper-sacks' ) ) {
    	        echo '<img src="'. home_url() . '/wp-content/uploads/2018/06/Paper-Sacks-banner.jpg" />';
          } elseif( is_product_category( 'plastic-bins' ) ) {
              echo '<img src="'. home_url() . '/wp-content/uploads/2018/06/Plastic-Bins.jpg" />';
          }  elseif( is_product_category( 'metal-bins' ) ) {
    	        echo '<img src="'. home_url() . '/wp-content/uploads/2018/09/metal-banner.jpg" />';
          }  elseif( is_product_category( 'security-weee' ) ) {
    	        echo '<img src="'. home_url() . '/wp-content/uploads/2018/06/Security-BIns-WEEE-Banner.jpg" />';
          }  elseif( is_product_category( 'wheeled-bins' ) ) {
    	        echo '<img src="'. home_url() . '/wp-content/uploads/2018/06/Wheeled-Bins-Banner.jpg" />';
          }  elseif( is_product_category( 'kidzone-for-schools' ) ) {
    	        echo '<img src="'. home_url() . '/wp-content/uploads/2018/05/BlackPotBanner-1.jpg" />';
          } elseif( is_product_category( 'specialty-bins' ) ) {
    	        echo '<img src="'. home_url() . '/wp-content/uploads/2018/06/Specialty-Bins-Banner.jpg" />';
          } elseif( is_product_category( 'local-authority' ) ) {
    	        echo '<img src="'. home_url() . '/wp-content/uploads/2018/09/local-authority-banner.jpg" />';
          } elseif( is_product_category( '' ) ) {
    	        echo '<img src="'. home_url() . '/wp-content/uploads/2018/07/sub-page-header.jpg" />';
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
        <?php the_content(); ?>
    </div>

<?php endwhile; // End of the loop. ?>

<?php
    get_footer();
