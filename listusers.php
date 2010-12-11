<?php
/*
Plugin Name: List Users
Plugin URI: https://github.com/wagonlips/listusers
Description: A plugin to list specific users in WordPress and show the posts they've written.
             Using a widget, specific names selected by an admin will be displayed in a sidebar, 
             which when clicked, the category of authored pages will be displayed.
             !!! Only works with pretty permalinks turned on. !!!
Version: 0.1
Author: Sean Camden renamed a few variables and added a few lines to Justin Tadlock's widget tutorial.
Author URI: http://computerdemon.com but you can see the source at the following URL:
            http://justintadlock.com/archives/2009/05/26/the-complete-guide-to-creating-widgets-in-wordpress-28
License: GPL2
    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/
add_action('widgets_init', widget_list_users_register);
function widget_list_users_register() {
  register_widget('List_Users');
}
class List_Users extends WP_Widget {
  function List_Users() {
    /* Widget settings. */
    $widget_ops = array( 'classname' => 'listusers', 'description' => __('A widget to display selected users.', 'listusers') );

    /* Widget control settings. */
    $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'list-users-widget' );

    /* Create the widget. */
    $this->WP_Widget( 'list-users-widget', __('List Users', 'listusers'), $widget_ops, $control_ops );
  }
  /* Display the widget. */
  function widget( $args, $instance ) {
    extract( $args );

    /* Our variables from the widget settings. */
    $title = apply_filters('widget_title', $instance['title'] );
    $names = $instance['name'];

    /* Before widget (defined by themes). */
    echo $before_widget;

    /* Display the widget title if one was input (before and after defined by themes). */
    if ( $title )
      echo $before_title . $title . $after_title;

    /* Display names from widget settings if any were input. */
    if ( $names ) {
      echo "<ul>";
      // Strip the spaces from the string.
      $names = (str_replace(" ","",$names));
      // Break the string into an array separated by commas.
      $names_list = (explode(",",$names));
      foreach ($names_list as $name) {
        printf( '<li>' . __('<a href="/author/%1$s">%1$s</a>', 'listusers') . '</li>', $name );
      }
      echo "</ul>";
    }

    /* After widget (defined by themes). */
    echo $after_widget;
  }
  /* Update the widget settings. */
  function update( $new_instance, $old_instance ) {
    $instance = $old_instance;

    /* Strip tags for title and name to remove HTML. */
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['name'] = strip_tags( $new_instance['name'] );

    return $instance;
  }
  /* Display the widget settings controls on the widget panel. */
  function form( $instance ) {

    /* Set up some default widget settings. */
    $defaults = array( 'title' => __('List Users', 'listusers'), 'name' => __('John Doe', 'listusers') );
    $instance = wp_parse_args( (array) $instance, $defaults ); ?>

      <!-- Widget Title: Text Input -->
      <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
      <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
      </p>

      <!-- The names: Text Input -->
      <p>
      <label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e('The Usernames (separated by commas):', 'listusers'); ?></label>
      <textarea id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" rows="5" cols="33"><?php echo $instance['name']; ?></textarea>
      </p>

      <?php
  }
}
?>
