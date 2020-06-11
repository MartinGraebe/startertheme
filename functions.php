<?php

require_once (get_template_directory().'/includes/widgets.php');

// register styles and scripts
add_action('wp_enqueue_scripts', 'starter_theme_enqueue');

function starter_theme_enqueue(){
    wp_enqueue_style('starter_theme_styles', get_template_directory_uri().'/style.css');
    wp_enqueue_script('starter_theme_scripts', get_template_directory_uri().'/dist/js/main.min.js', array(), '1.0.0', true);
  // wp_localize_script('starter_theme_scripts', 'ajax_object', array('ajaxUrl' => admin_url('admin-ajax.php'))); optional localize e.g. for ajax
}

//add theme support
add_action('after_setup_theme', 'starter_theme_add_theme_support');
function starter_theme_add_theme_support(){

    add_theme_support( 'title-tag' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'editor-styles');
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery' ) );

    // add theme colours to gutenberg
    add_theme_support('editor-color-palette', array(
        array(
            'name' => __('Name of colour', 'starter_theme_text_domain'),
            'slug' => 'colourslug', // add to css: .has-colourslug-color and .has-colourslug-background-color
            'color' => 'blue'
        )
    ));
    // disable default colour picker in gutenberg
    add_theme_support( 'disable-custom-colors' );
}

// menus

add_action('init', 'starter_theme_register_nav_menus');

function starter_theme_register_nav_menus(){
    register_nav_menus(
        array(
            'main_navigation' => __('Hauptmenü'),
        )
    );
}

    // add css class to main menu li
    add_filter('nav_menu_css_class', 'starter_theme_menu_classes', 10 , 4);
    function starter_theme_menu_classes($classes, $item, $args, $depth){
        if($args->theme_location == 'main_navigation'){
            $classes[]= 'main-nav__list-item';
        }
        return $classes;
    }

    // add css class to main menu anchor element
    add_filter('nav_menu_link_attributes', 'starter_theme_menu_classes_anchor', 10, 4);
    function starter_theme_menu_classes_anchor($atts, $item, $args, $depth){
        if($args->theme_location == 'main_navigation'){
            $atts['class'] = 'main-nav__link';
        }
        return $atts;
    }


// widgets
add_action('widgets_init', 'starter_theme_widgets_init');
function starter_theme_widgets_init(){
     register_sidebar(array(
         'name'             =>      'Generic Widget Location',
         'id'               =>      'generic_widget_location',
         'before_widget'    =>      '',
         'after_widget'     =>      '',
         'before_title'     =>      '',
         'after_title'      =>      '',
     ));
}
