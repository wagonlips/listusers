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
add_action('admin_menu', 'list_users_menu');

function my_plugin_menu() {

  add_options_page('My Plugin Options', 'My Plugin', 'manage_options', 'my-unique-identifier', 'my_plugin_options');

}

function my_plugin_options() {

  if (!current_user_can('manage_options'))  {
    wp_die( __('You do not have sufficient permissions to access this page.') );
  }

  echo '<div class="wrap">';
  echo '<p>Here is where the form would go if I actually had options.</p>';
  echo '</div>';

}

?>
