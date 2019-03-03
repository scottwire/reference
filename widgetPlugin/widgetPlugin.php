<?php
/*
Plugin Name: My Widget Plugin
Plugin URI: scottmele.com
Description: Building a Custom Wordpress Widget.
Author: Scott Mele
Version: 1
Author URI: scottmele.com
*/

// Register and load the widget
function wpb_load_widget()
{
    register_widget('widgetPlugin');
}
add_action('widgets_init', 'wpb_load_widget');
 
// Creating the widget
class widgetPlugin extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
 
// Base ID of your widget
'widgetPlugin',
 
// Widget name will appear in UI
__('WPBeginner Widget', 'widgetPlugin_domain'),
 
// Widget description
array( 'description' => __('Sample widget based on WPBeginner Tutorial', 'widgetPlugin_domain'), )
);
    }
 
    // Creating widget front-end
 
    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);
        $content = apply_filters('widget_content', $instance['content']);
 
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if (! empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }
 
        // This is where you run the code and display the output
        echo __($content, 'widgetPlugin_domain');
        echo $args['after_widget'];
    }
         
    // Widget Backend
    public function form($instance)
    {
        if (isset($instance[ 'title' ])) {
            $title = $instance[ 'title' ];
        } else {
            $title = __('New title', 'widgetPlugin_domain');
        }
     
        // Widget admin form ?>
<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
<label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Content:'); ?></label> 
<textarea class="widefat" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>"  ><?php echo esc_attr($content); ?></textarea>
</p>
<?php
    }
     
    // Updating widget replacing old instances with new
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (! empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['content'] = (! empty($new_instance['content'])) ? strip_tags($new_instance['content']) : '';
        return $instance;
    }
} // Class widgetPlugin ends here
