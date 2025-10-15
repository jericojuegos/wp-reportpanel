<?php
/**
 * Plugin Name: Report Panel
 * Description: 
 * Version: 0.1.1
 * Author: Jerico Juegos
 * License: GPLv2 or later
 */

namespace Jay\WpReportPanel;

if ( ! defined( 'ABSPATH' ) ) exit; // Prevent direct access

use tangible\framework;
use tangible\updater;

require __DIR__ . '/vendor/tangible/framework/index.php';
require __DIR__ . '/vendor/tangible/updater/index.php';

class Plugin {
    public static $plugin;
    public $settings;

    public function __construct() {
        add_action( 'plugins_loaded', [ $this, 'init_framework' ] );
        add_action( 'plugins_loaded', [ $this, 'init_updater' ], 11 );
        add_action( 'plugins_loaded', [ $this, 'load_includes' ], 12 );
    }
 
    public function init_framework() {
        if ( defined( 'WP_SANDBOX_SCRAPING' ) ) return;

        self::$plugin = framework\register_plugin([
            'name'           => 'wp-report-panel',
            'title'          => 'Report Panel',
            'setting_prefix' => 'wp_report_panel',
            'version'        => '0.1.1',
            'file_path'      => __FILE__,
            'base_path'      => plugin_basename( __FILE__ ),
            'dir_path'       => plugin_dir_path( __FILE__ ),
            'url'            => plugins_url( '/', __FILE__ ),
            'assets_url'     => plugins_url( '/assets', __FILE__ ),
        ]);
    }

    public function init_updater() {
        updater\register_plugin([
            'name' => self::$plugin->name ?? 'wp-report-panel',
            'file' => __FILE__,
        ]);
    }

    public function load_includes() {
        require_once __DIR__ . '/includes/admin/Settings.php';

        // You can instantiate other classes here as needed
        $this->settings = new \Jay\WpReportPanel\Admin\Settings( self::$plugin );
    }
}

// Initialize the plugin
new Plugin();