<?php
/*
Plugin Name:  CLOCK 2 widget
Plugin URI:   https://github.com/LennartJKlein/oats-jenkins-clock-2
Description:  A widget that shows the current time of the visitor on CLOCK 2 (concept by Oats Jenkins)
Version:      1.0.0
Author:       Lennart Klein
Author URI:   info@lennartklein.nl
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

class clock_two extends WP_Widget {
    // Widget configuration
    function __construct() {
        parent::__construct(
            // Base ID of the widget
            'clock_two', 
            // Name of widget in the UI
            __('CLOCK 2', 'clock_two'), 
            // Widget description
            array(
                'description' => __('CLOCK 2', 'clock_two')
            )
        );

        wp_enqueue_style('clock-two', plugin_dir_url(__FILE__) . 'clock-two.css');
    }
    
    // Widget front-end
    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);
        extract($args);
        echo $before_widget;
        if ($title) echo $before_title . $title . $after_title;
        ?>
        <div class="clock-two <?php echo $instance['border'] == 'on' ? 'has-border' : ''; ?>">
            <iframe
                class="clock-two__iframe"
                src="https://clock-two.netlify.app/"
                title="CLOCK 2"
                allowtransparency="true"
            ></iframe>
        </div>
        <?php
        echo $after_widget;
    }
    
    // Widget back-end
    public function form($instance) {
        $defaults = array(
            'title' => __('', 'clock_two'), 
            'border' => __('', 'off')
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                Title (optional):
            </label>
            <input
                class="widefat"
                id="<?php echo $this->get_field_id('title'); ?>"
                name="<?php echo $this->get_field_name('title'); ?>"
                type="text"
                value="<?php echo esc_attr($instance['title']); ?>"
            />
        </p>
        <p>
            <input
                id="<?php echo $this->get_field_id('border');?>"
                name="<?php echo $this->get_field_name('border');?>"
                type="checkbox"
                <?php echo checked($instance['border'], 'on'); ?>
            />
            <label for="<?php echo $this->get_field_id('border');?>">
                Show border?
            </label>
        </p>
        <?php
    }
    
    // Updating widget replacing old instances with new
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['border'] = $new_instance['border'];
        return $instance;
    }
}

/**
 * Register and load the widget
 */
add_action('widgets_init', function() {
    register_widget('clock_two');
});
