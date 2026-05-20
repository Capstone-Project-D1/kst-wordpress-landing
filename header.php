<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php bloginfo('name'); ?></title>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header class="navbar">
  <div class="navbar-inner">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="logo">Logo</a>

    <nav class="nav-menu">
      <a href="#profil">Profil</a>
      <a href="#mitra">Mitra</a>
      <a href="#produk">Produk</a>
      <a href="#berita">Berita</a>
    </nav>
  </div>
</header>