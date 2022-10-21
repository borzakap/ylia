<?php

/**
 * _ylia Theme Customizer
 *
 * @package _ylia
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ylia_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial(
                'blogname',
                array(
                    'selector' => '.site-title a',
                    'render_callback' => 'ylia_customize_partial_blogname',
                )
        );
        $wp_customize->selective_refresh->add_partial(
                'blogdescription',
                array(
                    'selector' => '.site-description',
                    'render_callback' => 'ylia_customize_partial_blogdescription',
                )
        );
    }
    
    /**
     * Contacts pannel options
     */
    $wp_customize->add_section(
            'pannel_contacts',
            array(
                'title' => __('Pannel contacts', 'ylia'),
                'priority' => 130,
            )
    );
    
    /**
     * Facebook page link
     */
    $wp_customize->add_setting(
            'contact_facebook',
            array(
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport' => 'postMessage',
            )
    );

    $wp_customize->add_control(
            'contact_facebook',
            array(
                'label' => __('Facebook link', 'ylia'),
                'section' => 'pannel_contacts',
                'type' => 'text',
                'description' => __('Insert your Facebook page link here', 'ylia'),
            )
    );

    /**
     * Instagram page link
     */
    $wp_customize->add_setting(
            'contact_instagram',
            array(
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport' => 'postMessage',
            )
    );

    $wp_customize->add_control(
            'contact_instagram',
            array(
                'label' => __('Instagram link', 'ylia'),
                'section' => 'pannel_contacts',
                'type' => 'text',
                'description' => __('Insert your Instagram page link here', 'ylia'),
            )
    );
    
    /**
     * Youtube page link
     */
    $wp_customize->add_setting(
            'contact_youtube',
            array(
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field',
                'transport' => 'postMessage',
            )
    );

    $wp_customize->add_control(
            'contact_youtube',
            array(
                'label' => __('Youtube link', 'ylia'),
                'section' => 'pannel_contacts',
                'type' => 'text',
                'description' => __('Insert your Youtube page link here', 'ylia'),
            )
    );
    
}

add_action('customize_register', 'ylia_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function ylia_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function ylia_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ylia_customize_preview_js() {
    wp_enqueue_script('_ylia-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), _YLIA_VERSION, true);
}

add_action('customize_preview_init', 'ylia_customize_preview_js');

