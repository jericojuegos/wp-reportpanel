<?php
/**
 * Plugin Name: Report Panel
 * Description: 
 * Version: 0.1.1
 * Author: Jerico Juegos
 * License: GPLv2 or later
 */
use tangible\framework;
use tangible\updater;

define( 'WP_REPORT_PANEL_VERSION', '0.1.1' );

require __DIR__ . '/vendor/tangible/framework/index.php';
require __DIR__ . '/vendor/tangible/updater/index.php';

/**
 * Get plugin instance
 */
function wp_report_panel($instance = false) {
  static $plugin;
  return $plugin ? $plugin : ($plugin = $instance);
}

add_action('plugins_loaded', function() {

  // See https://github.com/TangibleInc/framework/#note-on-plugin-activation
  if (defined('WP_SANDBOX_SCRAPING')) return;

  $plugin    = framework\register_plugin([
    'name'           => 'wp-report-panel',
    'title'          => 'Report Panel',
    'setting_prefix' => 'wp_report_panel',
    'version'        => WP_REPORT_PANEL_VERSION,
    'file_path' => __FILE__,
    'base_path' => plugin_basename( __FILE__ ),
    'dir_path' => plugin_dir_path( __FILE__ ),
    'url' => plugins_url( '/', __FILE__ ),
    'assets_url' => plugins_url( '/assets', __FILE__ ),
  ]);

  updater\register_plugin([
    'name' => $plugin->name,
    'file' => __FILE__,    
  ]);

  wp_report_panel( $plugin );

  require_once __DIR__.'/includes/index.php';

}, 10);
