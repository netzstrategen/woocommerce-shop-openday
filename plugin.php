<?php

/*
  Plugin Name: Shop OpenDays
  Version: 2.0.0
  Text Domain: shop-opendays
  Description: Show shop opening hours and inform about next open day.
  Author: netzstrategen
  Author URI: https://netzstrategen.com
  License: GPL-2.0+
  License URI: http://www.gnu.org/licenses/gpl-2.0
*/

namespace Netzstrategen\ShopOpenDays;

if (!defined('ABSPATH')) {
  header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
  exit;
}

/**
 * Loads PSR-4-style plugin classes.
 */
function classloader($class) {
  static $ns_offset;
  if (strpos($class, __NAMESPACE__ . '\\') === 0) {
    if ($ns_offset === NULL) {
      $ns_offset = strlen(__NAMESPACE__) + 1;
    }
    include __DIR__ . '/src/' . strtr(substr($class, $ns_offset), '\\', '/') . '.php';
  }
}

spl_autoload_register(__NAMESPACE__ . '\classloader');

register_activation_hook(__FILE__, __NAMESPACE__ . '\Schema::activate');
register_deactivation_hook(__FILE__, __NAMESPACE__ . '\Schema::deactivate');
register_uninstall_hook(__FILE__, __NAMESPACE__ . '\Schema::uninstall');

// add_action('plugins_loaded', __NAMESPACE__ . '\Plugin::loadTextdomain');
add_action('admin_init', __NAMESPACE__ . '\Admin::init');
add_action('admin_menu', __NAMESPACE__ . '\Admin::admin_menu');
add_action('init', __NAMESPACE__ . '\Plugin::init', 20);

// defined("OC_VERSION")        or define('OC_VERSION', "1.0.4");
// defined("OC_PLUGIN_PATH")    or define('OC_PLUGIN_PATH', plugin_dir_path(__FILE__));
// defined("OC_PLUGIN_URL")     or define('OC_PLUGIN_URL', plugin_dir_url(__FILE__));
// defined("OC_PLUGIN_ESI_URL") or define('OC_PLUGIN_ESI_URL', str_replace('https', 'http', OC_PLUGIN_URL). 'views/esi/');

// $plugin_key = 'openclosed';

// $default_image['neutral'] = OC_PLUGIN_URL . 'views/assets/icon-times.png';
// $default_image['open']    = OC_PLUGIN_URL . 'views/assets/icon-times-open.png';
// $default_image['closed']   = OC_PLUGIN_URL . 'views/assets/icon-times-closed.png';
