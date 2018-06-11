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
    	    } elseif(is_category('local-authority')) {
    	        echo '<img src="'. home_url() . '/wp-content/uploads/2018/06/Local-Authority-banner.jpg" />';
          }
          elseif(is_category('paper-sacks')) {
    	        echo '<img src="'. home_url() . '/wp-content/uploads/2018/06/Paper-Sacks-banner.jpg" />';
          }
          else {
    	        echo '<img src="'. home_url() . '/wp-content/uploads/2018/05/BlackPotBanner-1.jpg" />';
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
