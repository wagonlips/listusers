<?php
/*
Plugin Name: List Users
Plugin URI: https://github.com/wagonlips/listusers
Description: A plugin to list specific users in WordPress and show the posts they've written.
             Using a widget, specific names selected by an admin will be displayed in a sidebar, 
             which when clicked, the category of authored pages will be displayed.
Version: 0.1
Author: Sean Camden
Author URI: http://computerdemon.com
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
add_action('init', widget_list_users_register);
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
    $name = $instance['name'];

    /* Before widget (defined by themes). */
    echo $before_widget;

    /* Display the widget title if one was input (before and after defined by themes). */
    if ( $title )
      echo $before_title . $title . $after_title;

    /* Display name from widget settings if one was input. */
    if ( $name )
      printf( '<p>' . __('These are the names %1$s.', 'example') . '</p>', $name );

    /* After widget (defined by themes). */
    echo $after_widget;
  }
}
?>
