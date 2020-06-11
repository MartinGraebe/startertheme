<?php

class STARTER_THEME_GENERIC_WIDGET extends WP_Widget{
    public function __construct()
    {
        parent::__construct(
            'starter_theme_generic_widget',
            __('Starter Theme Generic Widget', 'starter_theme_generic_widget_domain'),
             array(
                 'description' => __('Description of what widget does', 'starter_theme_generic_widget_domain')
             )
        );
    }

    public function widget($args, $instance)
    {
        // outputs the content of the widget
        extract($args);
        $html_open = '<ul class="contact-bar__list">';
        $html_close ='</ul>';
        $starter_text = apply_filters( 'widget_text', $instance['starter_text'] );
        $starter_link = apply_filters( 'widget_text', $instance['starter_link'] );



        echo $before_widget;
        echo $html_open;
        if ( ! empty( $starter_link ) &&  ! empty( $starter_text ) ) {
            echo '<li class="contact-bar__item"><a href="'.$starter_link.'" class="contact-bar__link"><div class="contact-bar__icons"></div><p>'.$starter_text.'</p></a></li>';
        }


        echo $html_close;
        echo $after_widget;
    }

    public function form($instance)
    {
        // outputs the options form in the admin
        if ( isset( $instance[ 'starter_text' ] ) ) {
            $starter_text = $instance[ 'starter_text' ];
        }
        else {
            $starter_text = __( 'Generic Text', 'starter_theme_generic_widget_domain' );
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_name( 'starter_text' ); ?>"><?php _e( 'Starter info:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'starter_text' ); ?>" name="<?php echo $this->get_field_name( 'starter_text' ); ?>" type="text" value="<?php echo esc_attr( $starter_text ); ?>" />
        </p>
        <?php
        if ( isset( $instance[ 'starter_link' ] ) ) {
            $starter_link = $instance[ 'starter_link' ];
        }
        else {
            $starter_link = __( 'generic text', 'starter_theme_generic_widget_domain' );
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_name( 'starter_link' ); ?>"><?php _e( 'Starter Link:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'starter_link' ); ?>" name="<?php echo $this->get_field_name( 'starter_link' ); ?>" type="text" value="<?php echo esc_attr( $starter_link ); ?>" />
        </p>
        <?php
    }
    public function update($new_instance, $old_instance)
    {
        // processes widget options to be saved
        $instance = array();
        $instance['starter_text'] = ( !empty( $new_instance['starter_text'] ) ) ? strip_tags( $new_instance['starter_text'] ) : '';
        $instance['starter_link'] = ( !empty( $new_instance['starter_link'] ) ) ? strip_tags( $new_instance['starter_link'] ) : '';

        return $instance;
    }
}
add_action('widgets_init', 'register_starter_theme_widgets');
function register_starter_theme_widgets(){
    register_widget('STARTER_THEME_GENERIC_WIDGET');
}