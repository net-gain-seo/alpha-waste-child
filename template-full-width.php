<?php
/*
  * Template Name: Full Width
  */
?>
<?php get_header(); ?>


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

<div id="fullWidth">
<?php
while ( have_posts() ) : the_post();
    the_content();
endwhile;
?>
</div>
<?php get_footer(); ?>
