<?php

/**
 * ylia lawerys widget
 *
 * @author alexey
 * @package ylia
 */
class Contact_Form_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'contact_form_widget',
                __('Contact Form', 'ylia'),
                array(
                    'description' => __('Show the form', 'ylia'),
                )
        );
    }

    public function widget($args, $instance) {
        $title = $instance['title'];
        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
        
        echo '<div class="flex flex-wrap">' .  get_template_part('template-parts/form') . '</div>';

        echo $args['after_widget'];

        return true;
    }

    public function form($instance) {
        isset($instance['title']) || $instance['title'] = __('New Title', 'csv_to_table_domain');
        $title = $instance['title'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

//put your code here
}

function load_Contact_Form_Widget() {
    register_widget('Contact_Form_Widget');
}

add_action('widgets_init', 'load_Contact_Form_Widget');
