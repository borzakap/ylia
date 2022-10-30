<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package _s
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function ylia_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'ylia_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function ylia_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'ylia_pingback_header' );

/**
 * Add cutom paget type for cases
 */
function ylia_slider_post_type() {
 
    // Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Sliders', 'Sliders', 'ylia' ),
        'singular_name'       => _x( 'Slider', 'Slider', 'ylia' ),
        'menu_name'           => __( 'Slider', 'ylia' ),
        'parent_item_colon'   => __( 'Parent slider', 'ylia' ),
        'all_items'           => __( 'All sliders', 'ylia' ),
        'view_item'           => __( 'View slider', 'ylia' ),
        'add_new_item'        => __( 'Add New slider', 'ylia' ),
        'add_new'             => __( 'Add New slider', 'ylia' ),
        'edit_item'           => __( 'Edit slider', 'ylia' ),
        'update_item'         => __( 'Update slider', 'ylia' ),
        'search_items'        => __( 'Search slider', 'ylia' ),
        'not_found'           => __( 'Not Found', 'ylia' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'ylia' ),
    );
     
    // Set other options for Custom Post Type
    $args = array(
        'label'               => __( 'slider', 'ylia' ),
        'description'         => __( 'Slider', 'ylia' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'excerpt', 'thumbnail', 'editor'),
        'taxonomies'          => array( 'slider' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'sliders'),
        'menu_icon' => 'dashicons-format-gallery',
    );
     
    register_post_type( 'slider', $args );
 
}

add_action( 'init', 'ylia_slider_post_type', 0 );

/**
 * Add cutom paget type for loyers
 */
function ylia_information_post_type() {
 
    // Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Informations', 'Informations', 'ylia' ),
        'singular_name'       => _x( 'Information', 'Information', 'ylia' ),
        'menu_name'           => __( 'Informations', 'ylia' ),
        'parent_item_colon'   => __( 'Parent information', 'ylia' ),
        'all_items'           => __( 'All informations', 'ylia' ),
        'view_item'           => __( 'View information', 'ylia' ),
        'add_new_item'        => __( 'Add New information', 'ylia' ),
        'add_new'             => __( 'Add New', 'ylia' ),
        'edit_item'           => __( 'Edit information', 'ylia' ),
        'update_item'         => __( 'Update information', 'ylia' ),
        'search_items'        => __( 'Search information', 'ylia' ),
        'not_found'           => __( 'Not Found', 'ylia' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'ylia' ),
    );
     
    // Set other options for Custom Post Type
    $args = array(
        'label'               => __( 'information', 'ylia' ),
        'description'         => __( 'Informations', 'ylia' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'excerpt', 'thumbnail', 'revisions', 'custom-fields', 'editor'),
        'taxonomies'          => array( 'informations' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
        'rewrite' => array('slug' => 'informations'),
        'menu_icon' => 'dashicons-businessman',
 
    );
     
    register_post_type( 'information', $args );
 
}

add_action( 'init', 'ylia_information_post_type', 0 );


/**
 * make the request to send phone callback
 */
function ylia_make_callback(){
    
    $nonce = false;
    $name = 'Client';
    $phone = false;

    // get the data from request
    if(isset($_REQUEST['data']) && is_array($_REQUEST['data'])){
        foreach($_REQUEST['data'] as $data){
            if($data['name'] == 'ylia_callback_nonce'){
                $nonce = $data['value'];
            }
            if($data['name'] == 'name'){
                $name = sanitize_text_field($data['value']);
            }
            if($data['name'] == 'phone'){
                $phone = sanitize_text_field($data['value']);
            }
            if($data['name'] == 'message'){
                $message = sanitize_text_field($data['value']);
            }
        }
        // nonce check for an extra layer of security, the function will exit if it fails
        if (!wp_verify_nonce($nonce, "ylia_callback_nonce")) {
            exit(__('Not verified callbak','ylia'));
        }
        if(!$phone){
            exit(__('No phone data', 'ylia'));
        }
        
        $subject = __('Call the cleint','ylia');
        $body = wp_sprintf(__('Call to the cleint. Name: %s, Phone: %s, Message: %s, Order time: %s','ylia'), $name, $phone, $message, date('Y-m-d H:i:s'));
        $to = get_option( 'admin_email', 'borzakap@gmail.com' );
        $headers = array('Content-Type: text/html; charset=UTF-8');
        wp_mail( $to, $subject, $body, $headers );

    }else{
        exit(__('No valid data', 'ylia'));
    }
    
    // Check if action was fired via Ajax call. If yes, JS code will be triggered, else the user is redirected to the post page
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        echo(json_encode(array('status' => 'ok', 'message' => __('We Call You in Minutes','ylia'))));
    }
    wp_die();
}

add_action('wp_ajax_ylia_make_callback', 'ylia_make_callback');
add_action('wp_ajax_nopriv_ylia_make_callback', 'ylia_make_callback'); 

