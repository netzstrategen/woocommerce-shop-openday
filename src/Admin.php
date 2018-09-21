<?php

/**
 * @file
 * Contains \Netzstrategen\ShopOpenDays\Admin.
 */

namespace Netzstrategen\ShopOpenDays;

/**
 * Administrative back-end functionality.
 */
class Admin {

  /**
   * @implements admin_init
   */
  public static function init() {
    add_action('admin_enqueue_scripts', __CLASS__ . '::admin_enqueue_scripts');
  }

  /**
   * Adds top-level menu page.
   *
   * @implements admin_menu
   */
  public static function admin_menu() {
    add_menu_page(__('Shop Opendays', Plugin::L10N), __('Shop Opendays', Plugin::L10N), 'manage_options', Plugin::PREFIX, __NAMESPACE__ . '\Settings::createMenuPage', 'dashicons-clock');
  }

  /**
   * Enqueues admin styles and scripts.
   *
   * @implements admin_enqueue_scripts
   */
  public static function admin_enqueue_scripts() {
    $git_version = Plugin::getGitVersion();
    // wp_enqueue_style('woocommerce-moeve/admin', Plugin::getBaseUrl() . '/dist/styles/admin.css', FALSE, TRUE);
  }

// function oc_enqueue_date_picker(){
//     if (isset($_GET['page']) && $_GET['page'] == 'oc-toplevel') {
//         wp_enqueue_media();

//         wp_enqueue_script(
//             'oc-scripts-js',
//             plugin_dir_url( __FILE__ ) . 'views/assets/oc_scripts.js',
//             array('jquery', 'jquery-ui-core', 'jquery-ui-datepicker'),
//             OC_VERSION,
//             true
//         );

//         wp_enqueue_style( 'jquery-ui-datepicker' );
//         wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
//         wp_enqueue_style(
//             'oc-styles-css',
//             plugin_dir_url( __FILE__ ) . 'views/assets/oc_styles.css',
//             null,
//             OC_VERSION
//         );
//     }
// }
// add_action( 'admin_enqueue_scripts', 'oc_enqueue_date_picker' );

}
