<?php 
add_action('customize_register', 'wdl_customizer_register');

function wdl_customizer_register($wp_customize) {
    // Add a new section if needed
    $wp_customize->add_section('my_custom_section', array(
        'title' => __('Weddinglist Settings', 'text-domain'), // Replace 'text-domain' with your theme's text domain
        'priority' => 30,
    ));

    // Add the custom setting control
    $wp_customize->add_setting('my_custom_string_setting', array(
        'default' => 'Default String Value', // Set a default value
        'sanitize_callback' => 'sanitize_text_field', // Sanitize the input
        'transport' => 'postMessage', // Choose the transport method (postMessage for live preview without page refresh)
    ));

    $wp_customize->add_control('my_custom_string_setting', array(
        'label' => __('My Custom String Setting', 'text-domain'), // Replace 'text-domain' with your theme's text domain
        'section' => 'my_custom_section',
        'type' => 'text',
    ));
}