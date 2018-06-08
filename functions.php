<?php

if ( ! function_exists( 'aw_setup' ) ) :
    function aw_setup() {
        /**
         * Enable theme support features
         *
         * @link https://developer.wordpress.org/reference/functions/add_theme_support/
         */
        add_theme_support( 'title-tag' );
        // add_theme_support( 'custom-header' );
        add_theme_support( 'post-thumbnails' );
        // add_theme_support( 'custom-background' );
        // add_theme_support( 'post-formats', array(
        //  'aside', 'image', 'video', 'quote', 'link', 'gallery',
        // ) );
        /**
         * Register navigation menus
         *
         * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
         */
        register_nav_menus( array( 'main-menu' => 'Main Menu' ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

    } // end setup function
endif;
add_action( 'after_setup_theme', 'aw_setup' );
/**
 * Enqueue scripts and styles.
 */
function aw_scripts() {
    wp_enqueue_script( 'ngacustom', get_bloginfo('template_url') . '/js/custom.js', 'jquery', '2.9', true );
    wp_enqueue_style( 'parent_main', get_template_directory_uri() . '/main.css', array('bootstrap'), false );
    wp_enqueue_style( 'Oswald', 'https://fonts.googleapis.com/css?family=Oswald:400,700' );
    wp_enqueue_style( 'Lato', 'https://fonts.googleapis.com/css?family=Lato:400,700,300,300i' );
    wp_enqueue_style( 'font_main', get_template_directory_uri() . '/css/font-awesome.min.css', array('bootstrap'), false );
}
add_action( 'wp_enqueue_scripts', 'aw_scripts' );

function ld_new_excerpt_more($more) {
    global $post;
    return '...<br/><h3><a class="more-link" href="'. get_permalink($post->ID) . '">Read More</a></h3>';
}
add_filter('excerpt_more', 'ld_new_excerpt_more');

function mc_widget_init() {

    register_sidebar( array(
        'name'          => 'Page Sidebar',
        'id'            => 'page_sidebar_1',
        'before_widget' => '<div class="sb-widget-area">',
        'after_widget'  => '</div>'
    ) );

}
add_action( 'widgets_init', 'mc_widget_init' );
/// ADD CUSTOM FIELDS FOR PAGES (HEADER MAST)
function page_add_meta_box() {
    add_meta_box( 'page_meta_box_mast_title',
        'Page Mast Title (leave blank to use page title)',
        'display_page_meta_box_mast_title',
        'page'
    );
    add_meta_box( 'page_meta_box_mast_description',
        'Page Mast Description',
        'display_page_meta_box_mast_description',
        'page'
    );
}

add_action( 'admin_init', 'page_add_meta_box' );

function display_page_meta_box_mast_title() {
    global $post;

    $mast_title =  get_post_meta( $post->ID, 'mast_title', true );
    wp_editor( $mast_title,'mast_title', array('textarea_rows'=>2) );


    echo '<input type="hidden" name="mast_flag" value="true" />';
}

function display_page_meta_box_mast_description() {
    global $post;

    $mast_description =  get_post_meta( $post->ID, 'mast_description', true );
    wp_editor( $mast_description,'mast_description', array('textarea_rows'=>5,'wpautop'=>true) );


    echo '<input type="hidden" name="mast_flag" value="true" />';
}

function update_page_meta_box( $post_id, $post ) {
    if ( $post->post_type == 'page' ) {
        if ( isset($_POST['mast_flag']) ) {

            if ( isset( $_POST['mast_title'] ) && $_POST['mast_title'] != '' ) {
                update_post_meta( $post_id, 'mast_title', $_POST['mast_title'] );
            } else {
                update_post_meta( $post_id, 'mast_title', '' );
            }

            if ( isset( $_POST['mast_description'] ) && $_POST['mast_description'] != '' ) {
                update_post_meta( $post_id, 'mast_description', $_POST['mast_description'] );
            } else {
                update_post_meta( $post_id, 'mast_description', '');
            }

        }
    }
}

add_action( 'save_post', 'update_page_meta_box', 10, 2 );






//////////////WOOOOO Custom Functions/////////////////////
// Display Fields using WooCommerce Action Hook
add_action( 'woocommerce_product_options_general_product_data', 'woocom_general_product_data_custom_field' );
function woocom_general_product_data_custom_field() {
  // Create a custom text field
  woocommerce_wp_text_input(
    array(
      'id' => '_tag_line',
      'label' => __( 'Product Tag Line:', 'woocommerce' ),
      'placeholder' => 'Product Tag Line',
      'desc_tip' => 'true',
      'description' => __( 'Enter the custom product tag line url here.', 'woocommerce' )
    )
  );
  // Text Field
  woocommerce_wp_text_input(
    array(
      'id' => '_banner_image',
      'label' => __( 'Banner Image URL:', 'woocommerce' ),
      'placeholder' => 'Banner Image URL',
      'desc_tip' => 'true',
      'description' => __( 'Enter the custom banner url value here.', 'woocommerce' )
    )
  );

  woocommerce_wp_text_input(
    array(
      'id' => '_spec_sheet',
      'label' => __( 'Spec Sheet URL:', 'woocommerce' ),
      'placeholder' => 'Spec Sheet URL',
      'desc_tip' => 'true',
      'description' => __( 'Enter the custom spec sheet url here.', 'woocommerce' )
    )
  );

  woocommerce_wp_textarea_input(
    array(
      'id' => '_spec_field',
      'label' => __( 'Specifications:', 'woocommerce' ),
      'placeholder' => 'Specifications',
      'desc_tip' => 'true',
      'description' => __( 'Enter the Specifications here.', 'woocommerce' )
    )
  );


}
// Hook to save the data value from the custom fields
add_action( 'woocommerce_process_product_meta', 'woocom_save_general_proddata_custom_field' );

//Add New Meta Fields
/** Hook callback function to save custom fields information */
function woocom_save_general_proddata_custom_field( $post_id ) {
  // Save Text Field

  $text_field_tl = $_POST['_tag_line'];
  if( ! empty( $text_field_tl ) ) {
     update_post_meta( $post_id, '_tag_line', esc_attr( $text_field_tl ) );
  }

  $text_field_bn = $_POST['_banner_image'];
  if( ! empty( $text_field_bn ) ) {
     update_post_meta( $post_id, '_banner_image', esc_attr( $text_field_bn ) );
  }
  $text_field_ss = $_POST['_spec_sheet'];
  if( ! empty( $text_field_ss ) ) {
     update_post_meta( $post_id, '_spec_sheet', esc_attr( $text_field_ss ) );
  }
  $text_field_sf = $_POST['_spec_field'];
  if( ! empty( $text_field_sf ) ) {
     update_post_meta( $post_id, '_spec_field', esc_attr( $text_field_sf ) );
  }
  // Save Hidden field
  $hidden = $_POST['_hidden_field'];
  if( ! empty( $hidden ) ) {
     update_post_meta( $post_id, '_hidden_field', esc_attr( $hidden ) );
  }
}

//Remove Default Single Products Tabs
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['description'] );      	// Remove the description tab
    unset( $tabs['reviews'] ); 			// Remove the reviews tab
    unset( $tabs['additional_information'] );  	// Remove the additional information tab

    return $tabs;
}

// Adds the new tab
add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {
// Adds the new tab
    $tabs['spec_tab'] = array(
        'title'     => __( 'Download Spec Sheet', 'woocommerce' ),
        'priority'  => 50,
        'callback'  => 'woo_new_product_tab_content_spec'
    );
    $tabs['shipping_tab'] = array(
        'title'     => __( 'Shipping', 'woocommerce' ),
        'priority'  => 49,
        'callback'  => 'woo_new_product_tab_content_shipping'
    );
    $tabs['specifications_tab'] = array(
        'title'     => __( 'Specifications', 'woocommerce' ),
        'priority'  => 48,
        'callback'  => 'woo_new_product_tab_content_specifications'
    );
    $tabs['features_tab'] = array(
        'title'     => __( 'Features', 'woocommerce' ),
        'priority'  => 47,
        'callback'  => 'woo_new_product_tab_content_features'
    );
    return $tabs;
}
function woo_new_product_tab_content_spec()  {
    // The new tab content
    $post = get_the_ID();
    echo '<h3>Download The Spec Sheet Below:</h3>';
    echo '<a href="'.get_post_meta( $post, '_spec_sheet', true ).'" target="_blank"/><p><img src="'.get_bloginfo('template_url').'/img/pdficon.png" class="pdficon" width="30"/>Download the '.get_the_title().' Spec Sheet</p>';
}
function woo_new_product_tab_content_shipping()  {
    // The new tab content
    $post = get_the_ID();
    global $product;
    $dimensions = $product->get_dimensions();
    echo '<div class="dimensions"><h3>Shipping Dimensions:</h3><p><strong>(</strong><strong>Height:</strong> ' . $product->get_height() . get_option( 'woocommerce_dimension_unit' );
    echo ' <strong>|</strong> <strong>Width:</strong> ' . $product->get_width() . get_option( 'woocommerce_dimension_unit' );
    echo ' <strong>|</strong> <strong>Length:</strong> ' . $product->get_length() . get_option( 'woocommerce_dimension_unit' );
    echo '<strong>)</strong><p><strong>Weight:</strong> ' . $product->get_weight() . get_option( 'woocommerce_weight_unit' );
    echo '</div>';
    echo '<p>'.get_post_meta( $post, 'shipping_product_data', true ).'</p>';
}
function woo_new_product_tab_content_specifications()  {
    // The new tab content
    $post = get_the_ID();
    echo '<h3>Specifications:</h3>';
    echo '<p>'.get_post_meta( $post, '_spec_field', true ).'</p>';
}
function woo_new_product_tab_content_features()  {
    // The new tab content
    $post = get_the_ID();
    echo '<h3>Features:</h3>';
    echo '<p>'.get_post_meta( $post, 'wo_features_field', true ).'</p>';
}

//Add New Woocommerce Meta Fields
function wo_features_field($post) {
  echo "<div id='postexcerpt' class='postbox'>";
  echo "<h2 class='hndle ui-sortable-handle'><span>Features:</span></h2>";
  $content = get_post_meta($post->ID, 'wo_features_field' , true ) ;
  wp_editor( $content, 'wo_features_field', array("media_buttons" => false) );
  echo "</div>";
}
add_action('edit_form_advanced', 'wo_features_field');


function wo_features_field_save_postdata($post_id) {

  if (!empty($_POST['wo_features_field'])) {
    $data=($_POST['wo_features_field']);
    update_post_meta($post_id, 'wo_features_field', $data );
  }
}

add_action('save_post', 'wo_features_field_save_postdata');



remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

// Category page Add Dropdown and tags
add_action( 'woocommerce_before_shop_loop', 'add_product_category_dropdown' );
function add_product_category_dropdown(){
  echo '<div class="container "><div class="">
        <div class="row ">
        <div class="col col-12 col-lg-12 col-md-12 col-sm-12 ">
        <h3>Alpha Waste Solutions is one of the UK’s leading suppliers of waste and recycling bins.</h3>
        <p>Alpha Waste Solutions Ltd offers an extensive array of premium waste and recycling supplies. Every product in this ever-expanding range is designed to provide customers with a cost-effective way to collect and segregate their waste.<br>
        </p></div>
        </div>
        </div></div>';
  echo '<div class="greydropdownbanner"><span class="woocommerce-ordering-title">CHOOSE YOUR CATEGORY:</span>';
	echo '<span class="woocommerce-ordering">'; // So it takes the same position as the default dropdown
	the_widget( 'WC_Widget_Product_Categories', 'dropdown=1' );
	echo '</span></div>';
  echo '<div class="whitebar">';
  echo '<div class="outdooricon"><img src="'.get_bloginfo('template_url').'/img/outdoor-icon.png" width="42px" height="42px" alt="Outdoor"/><p>Outdoor</p></div>';
  echo '<div class="indooricon"><img src="'.get_bloginfo('template_url').'/img/indoor-icon.png" width="42px" height="42px" alt="Indoor"/><p>Indoor</p></div>';
  echo '</div>';
  echo do_shortcode( '[product_bar]' );
}


// Category page Add Clean Enviroment banner to footer
add_action( 'woocommerce_after_shop_loop', 'add_clean_enviroment' );
function add_clean_enviroment(){
  echo '<div class="cleanenviromentbar">';
  echo '<div class="greenbackground"></div>';
  echo '<div class="cleanicon"><img src="'.get_bloginfo('template_url').'/img/CleanEnviromentIcon.png" width="180px"  alt="Clean Enviroment Icon"/></div>';
  echo '<h3 class="cleantitle">Helping companies achieve a cleaner environment</h3>';
  echo '</div>';

}
//On Woocommerce Single Page limit suggested products to 3
function woo_related_products_limit() {
  global $product;

	$args['posts_per_page'] = 3;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args' );
  function jk_related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 4 related products
	$args['columns'] = 3; // arranged in 2 columns
	return $args;
}

//On Woocommerce Single Page change title
add_action( 'woocommerce_single_product_summary', 'add_woocommerce_template_single_title', 5 );
function add_woocommerce_template_single_title(){
  echo '<h2 class="cart-title">Buy Online</h2>';
}


/* Add Show All Products to Woocommerce Shortcode */
function woocommerce_shortcode_display_all_products($args)
{
 if(strtolower(@$args['post__in'][0])=='all')
 {
  global $wpdb;
  $args['post__in'] = array();
  $products = $wpdb->get_results("SELECT ID FROM ".$wpdb->posts." WHERE 'post_type'='product'",ARRAY_A);
  foreach($products as $k => $v) { $args['post__in'][] = $products[$k]['ID']; }
 }
 return $args;
}
add_filter('woocommerce_shortcode_products_query', 'woocommerce_shortcode_display_all_products');


add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );    // 2.1 +
function woo_custom_cart_button_text() {
return __( 'ADD TO BASKET', 'woocommerce' );
}

add_filter( 'wc_empty_cart_message', 'custom_wc_empty_cart_message' );

function custom_wc_empty_cart_message() {
  return 'Your basket is currently empty.';
}


function custom_excerpt_length( $length ) {
	return 35;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

include(TEMPLATEPATH.'/admin/custom_shortcodes.php');
