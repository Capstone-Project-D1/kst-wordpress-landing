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

function kst_get_product_url($slug) {
  return add_query_arg(
    array(
      'kst_product' => sanitize_key($slug),
    ),
    home_url('/')
  );
}

function kst_get_berita_url($detail = null) {
  $url = add_query_arg('kst_berita', '1', home_url('/'));

  if (null !== $detail) {
    $url = add_query_arg('detail', (string) absint($detail), $url);
  }

  return $url;
}

function kst_landing_render_berita_template($template) {
  $is_kst_berita = isset($_GET['kst_berita']) && '1' === sanitize_text_field(wp_unslash($_GET['kst_berita']));

  if (!$is_kst_berita) {
    return $template;
  }

  $berita_template = get_template_directory() . '/page-berita.php';

  if (file_exists($berita_template)) {
    return $berita_template;
  }

  return $template;
}

add_filter('template_include', 'kst_landing_render_berita_template', 99);

function kst_landing_render_product_template($template) {
  $product = isset($_GET['kst_product']) ? sanitize_key(wp_unslash($_GET['kst_product'])) : '';

  if ('melon-premium' !== $product) {
    return $template;
  }

  $product_template = get_template_directory() . '/page-melon-premium.php';

  if (file_exists($product_template)) {
    return $product_template;
  }

  return $template;
}

add_filter('template_include', 'kst_landing_render_product_template', 100);