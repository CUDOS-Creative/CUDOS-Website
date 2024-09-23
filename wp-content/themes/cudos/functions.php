<?php

/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @link https://github.com/timber/starter-theme
 */

use Timber\Timber;

// Load Composer dependencies.
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/includes/theme.php';
require_once __DIR__ . '/includes/post_types.php';

Timber::init();

new StarterSite();

add_filter( 'show_admin_bar', '__return_false' );

function change_admin_favicon() {
  echo '<link rel="icon" type="image/png" href="' . get_template_directory_uri() . '/includes/admin-favicon.png">';
}
add_action('admin_head', 'change_admin_favicon');