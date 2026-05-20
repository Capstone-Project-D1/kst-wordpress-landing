<?php

function kst_landing_enqueue_assets() {
  wp_enqueue_style(
    'kst-theme-style',
    get_stylesheet_uri(),
    array(),
    '1.0'
  );

  wp_enqueue_style(
    'kst-landing-style',
    get_template_directory_uri() . '/assets/css/landing.css',
    array(),
    '1.0'
  );
}

add_action('wp_enqueue_scripts', 'kst_landing_enqueue_assets');