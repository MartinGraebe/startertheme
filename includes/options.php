<?php
add_action('admin_menu', 'starter_theme_example_options_admin');
add_action('admin_init', 'starter_theme_example_options_init');
function starter_theme_example_options_admin(){
    add_options_page('Starter Settings', 'Settings', 'manage_options', 'starter_theme_settings', 'starter_theme_settings');

}

function starter_theme_example_options_init(){
    register_setting('starter_theme_options', 'starter_theme_option_example');
    add_settings_section('starter_theme_example_options_section',
                        'Example Option Section',
                        'starter_theme_example_settings_section_callback',
                        'starter_theme_options'
    );

    add_settings_field('starter_theme_example_option_id',
                        'Example Option',
                        'starter_theme_example_option_render',
                        'starter_theme_options',
                        'starter_theme_example_options_section'
    );
}

function starter_theme_example_option_render(){
    $options = get_option('starter_theme_option_example');
    ?>

        <input type='text' name='starter_theme_option_example[starter_theme_example_option_id]' value='<?php

        if(isset($options['starter_theme_example_option_id'])){
            echo $options['starter_theme_example_option_id']; }?>'>



    <?php
}


function starter_theme_example_settings_section_callback(){
    echo 'Example Option Description';

}

function starter_theme_settings(  ) {
    ?>
    <form action='options.php' method='post'>

        <h2>Starter Theme Example Settings</h2>

        <?php
        settings_fields( 'starter_theme_options' );
        do_settings_sections( 'starter_theme_options' );
        if(false !== get_transient( 'starter_theme_example_option_transient' )){
            delete_transient( 'starter_theme_example_option_transient' ); // Clear transient on change
        }


        submit_button();
        ?>

    </form>
    <?php
}

