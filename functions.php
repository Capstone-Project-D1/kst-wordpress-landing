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

function kst_ub_theme_setup() {
  add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'kst_ub_theme_setup');

function kst_ub_register_post_types() {
  register_post_type(
    'kst',
    array(
      'labels' => array(
        'name' => __('Kawasan KST', 'kst-wordpress-landing'),
        'singular_name' => __('Kawasan KST', 'kst-wordpress-landing'),
        'menu_name' => __('Kawasan KST', 'kst-wordpress-landing'),
        'add_new_item' => __('Tambah Kawasan KST', 'kst-wordpress-landing'),
        'edit_item' => __('Edit Kawasan KST', 'kst-wordpress-landing'),
      ),
      'public' => true,
      'show_in_rest' => true,
      'menu_position' => 20,
      'menu_icon' => 'dashicons-location',
      'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
      'has_archive' => true,
      'rewrite' => array('slug' => 'kawasan-kst'),
    )
  );

  register_post_type(
    'produk',
    array(
      'labels' => array(
        'name' => __('Produk KST', 'kst-wordpress-landing'),
        'singular_name' => __('Produk KST', 'kst-wordpress-landing'),
        'menu_name' => __('Produk KST', 'kst-wordpress-landing'),
        'add_new_item' => __('Tambah Produk KST', 'kst-wordpress-landing'),
        'edit_item' => __('Edit Produk KST', 'kst-wordpress-landing'),
      ),
      'public' => true,
      'show_in_rest' => true,
      'menu_position' => 21,
      'menu_icon' => 'dashicons-products',
      'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
      'has_archive' => true,
      'rewrite' => array('slug' => 'produk-kst'),
    )
  );

  register_post_type(
    'berita',
    array(
      'labels' => array(
        'name' => __('Berita KST', 'kst-wordpress-landing'),
        'singular_name' => __('Berita KST', 'kst-wordpress-landing'),
        'menu_name' => __('Berita KST', 'kst-wordpress-landing'),
        'add_new_item' => __('Tambah Berita KST', 'kst-wordpress-landing'),
        'edit_item' => __('Edit Berita KST', 'kst-wordpress-landing'),
      ),
      'public' => true,
      'show_in_rest' => true,
      'menu_position' => 22,
      'menu_icon' => 'dashicons-megaphone',
      'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
      'has_archive' => true,
      'rewrite' => array('slug' => 'berita-kst'),
    )
  );

  register_post_type(
    'mitra',
    array(
      'labels' => array(
        'name' => __('Mitra Strategis', 'kst-wordpress-landing'),
        'singular_name' => __('Mitra Strategis', 'kst-wordpress-landing'),
        'menu_name' => __('Mitra Strategis', 'kst-wordpress-landing'),
        'add_new_item' => __('Tambah Mitra', 'kst-wordpress-landing'),
        'edit_item' => __('Edit Mitra', 'kst-wordpress-landing'),
      ),
      'public' => true,
      'show_in_rest' => true,
      'menu_position' => 23,
      'menu_icon' => 'dashicons-groups',
      'supports' => array('title', 'thumbnail', 'page-attributes'),
      'has_archive' => false,
      'rewrite' => array('slug' => 'mitra-strategis'),
    )
  );
}

add_action('init', 'kst_ub_register_post_types');

function kst_ub_register_acf_field_groups() {
  if (!function_exists('acf_add_local_field_group')) {
    return;
  }

  acf_add_local_field_group(
    array(
      'key' => 'group_kst_ub_home_hero',
      'title' => 'Hero Section Home',
      'fields' => array(
        array(
          'key' => 'field_kst_ub_hero_title',
          'label' => 'Hero Title',
          'name' => 'hero_title',
          'type' => 'text',
        ),
        array(
          'key' => 'field_kst_ub_hero_subtitle',
          'label' => 'Hero Subtitle',
          'name' => 'hero_subtitle',
          'type' => 'textarea',
          'rows' => 2,
        ),
        array(
          'key' => 'field_kst_ub_hero_cta_link',
          'label' => 'Hero CTA Link',
          'name' => 'hero_cta_link',
          'type' => 'url',
        ),
        array(
          'key' => 'field_kst_ub_hero_background',
          'label' => 'Hero Background',
          'name' => 'hero_background',
          'type' => 'image',
          'return_format' => 'url',
          'preview_size' => 'large',
          'library' => 'all',
        ),
      ),
      'location' => array(
        array(
          array(
            'param' => 'page_type',
            'operator' => '==',
            'value' => 'front_page',
          ),
        ),
      ),
      'position' => 'normal',
      'style' => 'default',
      'active' => true,
    )
  );

  acf_add_local_field_group(
    array(
      'key' => 'group_kst_ub_kawasan_detail',
      'title' => 'Detail Kawasan KST',
      'fields' => array(
        array(
          'key' => 'field_kst_ub_kst_lokasi',
          'label' => 'Lokasi',
          'name' => 'kst_lokasi',
          'type' => 'text',
        ),
        array(
          'key' => 'field_kst_ub_kst_tema_unggulan',
          'label' => 'Tema Unggulan',
          'name' => 'kst_tema_unggulan',
          'type' => 'text',
        ),
        array(
          'key' => 'field_kst_ub_kst_button_color',
          'label' => 'Button Color',
          'name' => 'kst_button_color',
          'type' => 'color_picker',
        ),
      ),
      'location' => array(
        array(
          array(
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'kst',
          ),
        ),
      ),
      'position' => 'normal',
      'style' => 'default',
      'active' => true,
    )
  );
}

add_action('acf/init', 'kst_ub_register_acf_field_groups');

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

  if ('' === $product) {
    return $template;
  }

  $product_post = get_page_by_path($product, OBJECT, 'produk');

  if (!$product_post instanceof WP_Post) {
    return $template;
  }

  $product_template = get_template_directory() . '/page-produk.php';

  if (file_exists($product_template)) {
    return $product_template;
  }

  return $template;
}

add_filter('template_include', 'kst_landing_render_product_template', 100);

function kst_get_partner_items() {
  $partner_query = new WP_Query(
    array(
      'post_type' => 'mitra',
      'post_status' => 'publish',
      'posts_per_page' => -1,
      'orderby' => array(
        'menu_order' => 'ASC',
        'title' => 'ASC',
      ),
    )
  );

  $partner_items = array();

  if ($partner_query->have_posts()) {
    while ($partner_query->have_posts()) {
      $partner_query->the_post();

      $partner_items[] = array(
        'name' => get_the_title(),
        'logo_id' => get_post_thumbnail_id(),
      );
    }

    wp_reset_postdata();
  }

  return $partner_items;
}