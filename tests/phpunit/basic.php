<?php
namespace tests\wp_report_panel;

class Basic_TestCase extends \WP_UnitTestCase {
  function test_plugin_function() {
    $this->assertTrue( function_exists( 'wp_report_panel' ) );
  }
}
