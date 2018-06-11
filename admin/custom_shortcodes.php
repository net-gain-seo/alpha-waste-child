<?php

/**
 * SHORTCODES
 *
 */

// Remove empty paragraphs from beginning and end of [shortcode][/shortcode]
function noParagraphs($content){
    if ( '</p>' == substr( $content, 0, 4 ) && '<p>' == substr( $content, strlen( $content ) - 3 ) ){
        $content = substr( $content, 4, strlen( $content ) - 7 );
    }
    return $content;
}

function stripAllParagraphs($content) {
    return str_ireplace( array('<p>', '</p>'), '', $content );
}

/**
 *
 * Products Page Cards - IMG on the left
 *
 */
function pcard($atts,$content){
    extract( shortcode_atts( array(
        'class' => '',
        'id' => ''
    ), $atts ) );

        $content = do_shortcode( shortcode_unautop( $content ) );
        $content = stripParagraphs($content);

    $return = '';

    $return .= '<div class="pcard ' . (( $class != '') ? $class : "" ) . '" id="'  . $id . '">';
        $return .= force_balance_tags($content);
    $return .= '</div>';

    return $return;
}
add_shortcode('pcard','pcard');

// Card img
function pcard_img($atts){
    extract( shortcode_atts( array(
                'url'    => '',
                'link'   => '',
                'target' => '_self',
                'alt'    => ''
    ), $atts ) );

        // $content = do_shortcode( shortcode_unautop( $content ) );
        // $content = stripParagraphs($content);

        $return = '<img src="' . $url . '" alt="' . $alt . '">';
        if( !empty($link) ) {
            $return = '<a class="pcard-img" href="' . $link . '" target="' . $target . '">' . $return . '</a>';
        } else {
            $return = '<div class="pcard-img">' . $return . '</div>';
        }

    return $return;
}
add_shortcode('pcard_img','pcard_img');

// Card block
function pcard_block($atts,$content) {
    extract( shortcode_atts( array(
        'class' => ''
      ), $atts ) );

    $content = do_shortcode( shortcode_unautop( $content ) );
    $content = stripParagraphs($content);

    $return = '';

    $return .= '<div class="pcard-block ' . (( $class != '') ? $class : "" ) . '">';
        $return .= force_balance_tags($content);
    $return .= '</div>';

    return $return;
}
add_shortcode('pcard_block','pcard_block');


// Card title
function pcard_title($atts,$content) {
    extract( shortcode_atts( array(
        'class' => ''
      ), $atts ) );

    $content = do_shortcode( shortcode_unautop( $content ) );
    $content = stripParagraphs($content);

    $return = '';

    $return .= '<h4 class="pcard-title ' . (( $class != '') ? $class : "" ) . '">';
        $return .= stripAllParagraphs($content);
    $return .= '</h4>';

    return $return;
}
add_shortcode('pcard_title','pcard_title');

// Card text
function pcard_text($atts,$content) {
    extract( shortcode_atts( array(
        'class' => ''
      ), $atts ) );

    $content = do_shortcode( shortcode_unautop( $content ) );
    $content = stripParagraphs($content);

    $return = '';

    $return .= '<div class="pcard-text ' . (( $class != '') ? $class : "" ) . '">';
        $return .= force_balance_tags($content);
    $return .= '</div>';

    return $return;
}
add_shortcode('pcard_text','pcard_text');


// Card footer - good for inserting links/buttons that will line up vertically
function pcard_footer($atts,$content) {
    extract( shortcode_atts( array(
        'class' => ''
      ), $atts ) );

    $content = do_shortcode( shortcode_unautop( $content ) );
    $content = stripParagraphs($content);

    $return = '';

    $return .= '<div class="pcard-footer ' . (( $class != '') ? $class : "" ) . '">';
        $return .= stripAllParagraphs($content);
    $return .= '</div>';

    return $return;
}
add_shortcode('pcard_footer','pcard_footer');

/**
 * Testimonial slider
 *
 */
function testimonial_slider_code($atts) {
    extract( shortcode_atts( array(
        'class' => ''
      ), $atts ) );

    // WP_Query arguments
    $args = array(
        'post_type'   => array( 'testimonials' ),
        'post_status' => array( 'published' ),
    );

    // The Query
    $query = new WP_Query( $args );

    $content = do_shortcode( shortcode_unautop( $content ) );
    $content = stripParagraphs($content);

    $return = '';

    $return .= '<div id="testimonials" class="testimonials-slider">';
    foreach( $query->posts as $post ) {
        $excerpt = str_replace('"', '', $post->post_content);
        //$excerpt = preg_replace( '/\s+?(\S+)?$/', '', substr( $excerpt, 0, 188 ) ) . '...&quot; <a href="https://www.bins4shredding.com/testimonials/">Read more &raquo;</a>';
        $return .= '<div class="testimonial"><p>' . $excerpt . '</p><p class="author">' . $post->post_title . '</p></div>';
    }

    $return .= '</div><button type="button" class="btn btn-main slick-testimonial-prev">&lt;</button><button type="button" class="btn btn-main slick-testimonial-next">&gt;</button>';

    return $return;
}
add_shortcode('testimonials','testimonial_slider_code');






function aw_latestpost($atts,$content) {
  extract( shortcode_atts( array(
      'content' => '',
      'title' => '',
      'image' => '',
      'class' => ''
    ), $atts ) );
  $args = array(

      'posts_per_page' => 3
  );
  // The Query
  $query = new WP_Query( $args );

    $lp = '';

    $lp .= '<div class="container-fluid recentnewsection"><div class="container">';
    $lp .= '<div class="row padding0 justify-content-between">';
    if($query->have_posts()) {
        while($query->have_posts()):$query->the_post();
        $lp .= '<div class="col col-lg-4 col-md-6 col-sm-12 col-xsm-12">';
        $lp .= '<article class="newsposts">';
        $lp .= '<h3 class="posttitle"><a title="'.get_the_title().'"  href="'.get_permalink().'">'.get_the_title().'</a></h3>';
        $lp .= '<p class="postcontent">'.get_the_excerpt().'</p>';
        $lp .= '</article>';
        $lp .= '</div>';
        endwhile;
    }
    $lp .= '</div>';
    $lp .= '</div></div>';
    return $lp;
}
add_shortcode('latest_post','aw_latestpost');






function aw_productbar( $args = array()) {
	$term = get_queried_object();
	$pb = '';
	$pb .= '<div class="mast product-mast small greenbar">';
		$pb .= '<div class="container mast-overlay">';
			$category_name = $term->name;
			$pb .= '<h1 class="categorytitle">'. $category_name .'</h1>';
			$category_thumbnail = get_woocommerce_term_meta($term->term_id, "thumbnail_id", true);
			$image = wp_get_attachment_url($category_thumbnail);
			$pb .= '<img class="absolute category-image" src="'.$image.'">';
		$pb .= '</div>';
	$pb .= '</div>';
	return $pb;
}
add_shortcode('product_bar','aw_productbar');
