<?php

add_action('init', 'starter_theme_example_post_type');
function starter_theme_example_post_type(){
    register_post_type( 'example_post_type', array(
        'labels' => array(
            'name' => 'examples',
            'singular_name' => 'example',
        ),
        'taxonomies' => array('category'),
        'public'    => true,
        'menu_position' => 20,
        'has_archive' => true,
        'supports' => array ('title', 'editor', 'thumbnail')
    ) );
}