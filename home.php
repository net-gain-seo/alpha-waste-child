<?php
    // BLOG HOME
    get_header();
?>

<div class="mast page-mast">
    <div class="opacitybanner"></div>
    <img src="<?php echo home_url(); ?>/wp-content/uploads/2018/05/ForrestBanner.jpg" alt="News Banner">
    <div class="container mast-overlay">
        <h1>News</h1>
        <h2>WE ARE DEDICATED TO HELPING COMPANIES<br/>ACHIEVE A CLEANER ENVIRONMENT</h2>
    </div>
</div>
<div class="container">
    <div class="row blog-content">
        <div class="col col-12 col-lg-8">

            <div class="blog-listing">
            <?php while ( have_posts() ) : the_post(); ?>
                <article>

                    <h2 class="post-title">
                        <a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>

                    <?php the_excerpt(); ?>

                </article>
            <?php endwhile; // End of the loop. ?>
            </div>

            <div class="next-prev">
                <div class="prev"><?php next_posts_link( '<i class="fa fa-angle-double-left"></i> Older posts' ); ?></div>
                <div class="next"><?php previous_posts_link( 'Newer posts <i class="fa fa-angle-double-right"></i>' ); ?></div>
            </div>

        </div>

        <div class="col col-12 col-lg-4 greysidebar">

            <div class="blog-sidebar">
                <?php dynamic_sidebar( 'page_sidebar_1' ); ?>
            </div>

        </div>
    </div>
</div>
    <?php echo do_shortcode( '
[container fluid="true" background_image="/wp-content/uploads/2018/05/TrashBinBanner.jpg" class="productlinebanner"]

[element6 class="opacitypagebanner"]

<h1>Recycling and Waste Solutions</h1>

<h3>WIDE ARRAY OF PREMIUM WASTE & RECYCLING BINS</h3>

<a href="/~alphawaste/shop/" class="button">VIEW OUR PRODUCT LINE</a>

[/element6]

[/container]' ); ?>

<?php
    get_footer();
