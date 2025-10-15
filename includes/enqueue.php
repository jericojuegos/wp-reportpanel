<?php

// Enqueue frontend styles and scripts

add_action('wp_enqueue_scripts', function() use ($plugin) {

  $url = $plugin->url;
  $version = $plugin->version;

  wp_enqueue_style(
    'wp-report-panel',
    $url . 'assets/build/wp-report-panel.min.css',
    [],
    $version
  );

  wp_enqueue_script(
    'wp-report-panel',
    $url . 'assets/build/wp-report-panel.min.js',
    ['jquery'],
    $version
  );

});
