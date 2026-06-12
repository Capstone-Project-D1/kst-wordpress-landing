<?php get_header(); ?>

<?php
$hero_title = function_exists('get_field') ? get_field('hero_title') : '';
$hero_subtitle = function_exists('get_field') ? get_field('hero_subtitle') : '';
$hero_cta_link = function_exists('get_field') ? get_field('hero_cta_link') : '';
$hero_background = function_exists('get_field') ? get_field('hero_background') : '';

$hero_title = $hero_title ? $hero_title : 'Pusat Inovasi dan Teknologi Universitas Brawijaya';
$hero_subtitle = $hero_subtitle ? $hero_subtitle : 'Jelajahi ekosistem sains dan teknologi Universitas Brawijaya';
$hero_background = $hero_background ? $hero_background : 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=1600&auto=format&fit=crop';
?>

<main>
    <!-- HERO -->
    <section class="hero"
        style="background: linear-gradient(rgba(70, 70, 70, 0.72), rgba(70, 70, 70, 0.72)), url('<?php echo esc_url($hero_background); ?>') center/cover;">
        <div class="hero-content">
            <h1><?php echo esc_html($hero_title); ?></h1>
            <p><?php echo esc_html($hero_subtitle); ?></p>
            <?php if (!empty($hero_cta_link)) : ?>
            <div class="btn-center">
                <a href="<?php echo esc_url($hero_cta_link); ?>" class="btn-more">Lihat Selengkapnya</a>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- PROFIL KST -->
    <section class="kst-wrapper" id="profil">
        <div class="container">
            <?php
      $kst_query = new WP_Query(
        array(
          'post_type' => 'kst',
          'post_status' => 'publish',
          'posts_per_page' => 6,
        )
      );
    ?>

            <?php if ($kst_query->have_posts()) : ?>
            <?php $kst_index = 0; ?>
            <?php while ($kst_query->have_posts()) : $kst_query->the_post(); ?>
            <?php
          $kst_lokasi = function_exists('get_field') ? get_field('kst_lokasi') : '';
          $kst_tema_unggulan = function_exists('get_field') ? get_field('kst_tema_unggulan') : '';
          $kst_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
          $kst_image = $kst_image ? $kst_image : 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=900&auto=format&fit=crop';
          global $post, $more;
          if ( has_excerpt() ) {
              $kst_desc = get_the_excerpt();
          } elseif ( strpos( $post->post_content, '<!--more-->' ) !== false ) {
              $old_more = $more;
              $more = 0;
              $kst_desc = apply_filters('the_content', get_the_content(''));
              $more = $old_more;
          } else {
              $kst_desc = wp_trim_words(wp_strip_all_tags(get_the_content()), 40);
          }
          $kst_item_class = (1 === $kst_index % 2) ? 'kst-item reverse' : 'kst-item';
        ?>
            <div class="<?php echo esc_attr($kst_item_class); ?>">
                <div class="kst-text">
                    <h2><?php the_title(); ?></h2>
                    <div class="kst-desc">
                        <?php 
                        if ( strip_tags( $kst_desc ) === $kst_desc ) {
                            echo '<p>' . wp_kses_post( $kst_desc ) . '</p>';
                        } else {
                            echo wp_kses_post( $kst_desc );
                        }
                        ?>
                    </div>

                    <!-- <div class="kst-list">
                        <span><?php echo esc_html($kst_lokasi ? $kst_lokasi : 'Lokasi belum diisi'); ?></span>
                        <span><?php echo esc_html($kst_tema_unggulan ? $kst_tema_unggulan : 'Tema unggulan belum diisi'); ?></span>
                    </div> -->

                    <?php
                    $landing_page_url = function_exists('get_field') ? get_field('kst_landing_page_url') : '';
                    $dashboard_url = function_exists('get_field') ? get_field('kst_dashboard_url') : '';

                    // Fallbacks
                    $landing_page_url = $landing_page_url ? $landing_page_url : '#';
                    $dashboard_url = $dashboard_url ? $dashboard_url : '#';

                    $kst_btn_color = function_exists('get_field') ? get_field('kst_button_color') : '';
                    $btn_style = $kst_btn_color ? 'style="background-color: ' . esc_attr($kst_btn_color) . '; border-color: ' . esc_attr($kst_btn_color) . ';"' : '';
                    ?>
                    <div class="kst-website-action">
                        <div class="kst-website-actions-group">
                            <a href="<?php the_permalink(); ?>" class="btn-kst-detail">
                                <span>Detail Kawasan</span>
                            </a>
                            <button class="btn-kst-trigger" onclick="openKstModal(<?php the_ID(); ?>)">
                                <span>Kunjungi Website</span>
                                <svg class="arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </button>
                        </div>

                        <!-- Modal Overlay -->
                        <div class="kst-modal-overlay" id="kst-modal-<?php the_ID(); ?>">
                            <div class="kst-modal-container">
                                <div class="kst-modal-header">
                                    <h3>Kunjungi Website <?php the_title(); ?></h3>
                                    <button class="btn-kst-modal-close" onclick="closeKstModal(<?php the_ID(); ?>)" aria-label="Tutup">&times;</button>
                                </div>
                                <div class="kst-modal-body">
                                    <div class="kst-website-info">
                                        <div class="info-icon">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                                            </svg>
                                        </div>
                                        <p class="info-text">
                                            <strong>Pemberitahuan:</strong> Publik hanya dapat mengakses halaman <strong>Landing Page</strong>. Halaman <strong>Dashboard</strong> hanya dapat diakses oleh pengguna yang memiliki akun resmi.
                                        </p>
                                    </div>

                                    <div class="kst-website-buttons">
                                        <a href="<?php echo esc_url($landing_page_url); ?>" class="btn-kst-action btn-landing" target="_blank">
                                            <span>Landing Page</span>
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                                <polyline points="15 3 21 3 21 9"></polyline>
                                                <line x1="10" y1="14" x2="21" y2="3"></line>
                                            </svg>
                                        </a>
                                        <a href="<?php echo esc_url($dashboard_url); ?>" class="btn-kst-action btn-dashboard" target="_blank">
                                            <span>Dashboard</span>
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="kst-image">
                    <img src="<?php echo esc_url($kst_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                </div>
            </div>
            <?php $kst_index++; ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
            <?php else : ?>
            <div class="kst-item">
                <div class="kst-text">
                    <h2>Data Kawasan KST Belum Tersedia</h2>
                    <p>Silakan tambahkan data melalui menu Kawasan KST di admin.</p>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- MITRA STRATEGIS -->
    <section class="partner-strip" id="mitra">
        <h2>MITRA STRATEGIS</h2>

                <?php
            $partners = function_exists('kst_get_partner_items') ? kst_get_partner_items() : array();

            if (empty($partners)) {
                $partners = array(
                    array('name' => 'WooLom', 'logo_id' => 0),
                    array('name' => 'Relume', 'logo_id' => 0),
                    array('name' => 'Webflow', 'logo_id' => 0),
                    array('name' => 'Universitas Brawijaya', 'logo_id' => 0),
                    array('name' => 'Agro Techno Park', 'logo_id' => 0),
                    array('name' => 'Green Science Park', 'logo_id' => 0),
                    array('name' => 'KST Ngijo', 'logo_id' => 0),
                    array('name' => 'KST Cangar', 'logo_id' => 0),
                    array('name' => 'KST Jatikerto', 'logo_id' => 0),
                );
            }
        ?>

        <div class="partner-marquee">
            <div class="partner-track">
                                <?php foreach ($partners as $partner): ?>
                                <div class="partner-item">
                                        <span class="partner-logo" aria-hidden="true">
                                                <?php if (!empty($partner['logo_id'])) : ?>
                                                <?php echo wp_get_attachment_image((int) $partner['logo_id'], 'thumbnail', false, array('class' => 'partner-logo-image', 'alt' => esc_attr($partner['name']))); ?>
                                                <?php else : ?>
                                                <span class="partner-logo-fallback"><?php echo esc_html(mb_substr($partner['name'], 0, 1)); ?></span>
                                                <?php endif; ?>
                                        </span>
                                        <span class="partner-name"><?php echo esc_html($partner['name']); ?></span>
                                </div>
                                <?php endforeach; ?>

                <?php foreach ($partners as $partner): ?>
                                <div class="partner-item">
                                        <span class="partner-logo" aria-hidden="true">
                                                <?php if (!empty($partner['logo_id'])) : ?>
                                                <?php echo wp_get_attachment_image((int) $partner['logo_id'], 'thumbnail', false, array('class' => 'partner-logo-image', 'alt' => esc_attr($partner['name']))); ?>
                                                <?php else : ?>
                                                <span class="partner-logo-fallback"><?php echo esc_html(mb_substr($partner['name'], 0, 1)); ?></span>
                                                <?php endif; ?>
                                        </span>
                                        <span class="partner-name"><?php echo esc_html($partner['name']); ?></span>
                                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- PRODUK UNGGULAN -->
    <section class="section" id="produk">
        <div class="container">
            <h2 class="section-title">PRODUK UNGGULAN</h2>

            <div class="product-grid">
                <?php
      $product_query = new WP_Query(
        array(
          'post_type' => 'produk',
          'post_status' => 'publish',
          'posts_per_page' => 12,
        )
      );
    ?>

                <?php if ($product_query->have_posts()) : ?>
                <?php while ($product_query->have_posts()) : $product_query->the_post(); ?>
                <?php
          $product_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
          $product_image = $product_image ? $product_image : 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=600&auto=format&fit=crop';
          $product_text = has_excerpt() ? get_the_excerpt() : wp_trim_words(wp_strip_all_tags(get_the_content()), 14);
        ?>
                <a href="<?php echo esc_url(kst_get_product_url(get_post_field('post_name', get_the_ID()))); ?>"
                    class="product-card">
                    <div class="product-image">
                        <div class="product-tags">
                            <span class="tag tag-type">PRODUK</span>
                            <?php 
                            $kst_id = function_exists('get_field') ? get_field('relasi_kst', get_the_ID()) : null;
                            if ($kst_id) : 
                                $kst_title = get_the_title($kst_id);
                                $kst_color = function_exists('get_field') ? get_field('kst_button_color', $kst_id) : '';
                                $kst_bg_color = $kst_color ? $kst_color : 'var(--green)';
                            ?>
                                <span class="tag tag-kst" style="background-color: <?php echo esc_attr($kst_bg_color); ?>;"><?php echo esc_html($kst_title); ?></span>
                            <?php endif; ?>
                        </div>
                        <img src="<?php echo esc_url($product_image); ?>"
                            alt="<?php echo esc_attr(get_the_title()); ?>">
                    </div>

                    <div class="product-content">
                        <h3><?php the_title(); ?></h3>
                        <p><?php echo esc_html($product_text); ?></p>
                    </div>
                </a>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
                <?php else : ?>
                <article class="product-card">
                    <div class="product-content">
                        <h3>Produk belum tersedia</h3>
                        <p>Silakan tambahkan konten melalui menu Produk KST di admin.</p>
                    </div>
                </article>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- BERITA & AGENDA -->
    <section class="news-section" id="berita">
        <div class="container">
            <h2 class="section-title">BERITA & AGENDA</h2>

            <div class="news-grid">
                <?php
        $news_query = new WP_Query(
          array(
            'post_type' => 'berita',
            'post_status' => 'publish',
            'posts_per_page' => 3,
          )
        );
      ?>

                <?php if ($news_query->have_posts()) : ?>
                <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
                <?php
          $news_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
          $news_image = $news_image ? $news_image : 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?w=700&auto=format&fit=crop';
          $news_excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words(wp_strip_all_tags(get_the_content()), 18);
        ?>
                <article class="news-card">
                    <a class="news-card-link" href="<?php echo esc_url(add_query_arg('from', 'home', kst_get_berita_url(get_the_ID()))); ?>">
                        <div class="news-image">
                            <img src="<?php echo esc_url($news_image); ?>"
                                alt="<?php echo esc_attr(get_the_title()); ?>">
                        </div>

                        <div class="news-content">
                            <div class="category">
                                <span>Berita</span>
                                <?php 
                                $kst_id = function_exists('get_field') ? get_field('relasi_kst', get_the_ID()) : null;
                                if ($kst_id) : 
                                    $kst_title = get_the_title($kst_id);
                                    $kst_color = function_exists('get_field') ? get_field('kst_button_color', $kst_id) : '';
                                    $kst_bg_color = $kst_color ? $kst_color : 'var(--green)';
                                ?>
                                    <span class="news-kst-badge" style="background-color: <?php echo esc_attr($kst_bg_color); ?>;"><?php echo esc_html($kst_title); ?></span>
                                <?php endif; ?>
                            </div>
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo esc_html($news_excerpt); ?></p>

                            <div class="author">
                                <span class="avatar">UB</span>
                                <div>
                                    <strong><?php echo esc_html(get_the_author()); ?></strong><br>
                                    <span><?php echo esc_html(get_the_date('d F Y')); ?> • 5 menit membaca</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </article>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
                <?php else : ?>
                <article class="news-card">
                    <div class="news-content">
                        <h3>Berita belum tersedia</h3>
                        <p>Silakan tambahkan konten melalui menu Berita KST di admin.</p>
                    </div>
                </article>
                <?php endif; ?>
            </div>

            <div class="btn-center">
                <a href="<?php echo esc_url(kst_get_berita_url()); ?>" class="btn-more">Lihat Semua</a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>