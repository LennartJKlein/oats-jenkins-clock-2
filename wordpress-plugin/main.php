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
            __('CLOCK 2', 'clock_two_border'), 
            // Widget description
            array(
                'description' => __('CLOCK 2', 'clock_two_border')
            )
        );
    }
    
    // Widget front-end
    public function widget($args, $instance) {
        wp_enqueue_style('clock-two', plugin_dir_url(__FILE__) . 'clock-two.css');
        echo $args['before_widget'];
        ?>
        <div class="clock-two <?php echo $instance['border'] ? 'has-border' : ''; ?>">
            <iframe class="clock-two__iframe" src="https://clock-two.netlify.app/" title="CLOCK 2"></iframe>
        </div>
        <?php
        echo $args['after_widget'];
    }
    
    // Widget back-end
    public function form($instance) {
        $border = isset($instance['border']) ? $instance['border'] : false;
        ?>
        <p>
            <input
                class="checkbox"
                id="<?php echo $this->get_field_id('border');?>"
                name="<?php echo $this->get_field_name('border');?>"
                type="checkbox"
                <?php echo $border ? 'checked="checked"' : '';?>
            />
            <label for="<?php echo $this->get_field_id('border');?>">
                <?php _e('Show border?'); ?>
            </label>
        </p>
        <?php
    }
    
    // Updating widget replacing old instances with new
    function update($new_instance, $old_instance) {
        $new_instance = array_map('strip_tags', $new_instance);
        $instance = wp_parse_args($new_instance, $old_instance);
        return $instance;
    }
}

/**
 * Register and load the widget
 */
add_action('widgets_init', function() {
    register_widget('clock_two');
});
