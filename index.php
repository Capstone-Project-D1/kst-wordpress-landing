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
          $kst_desc = has_excerpt() ? get_the_excerpt() : apply_filters('the_content', get_the_content());
          $kst_item_class = (1 === $kst_index % 2) ? 'kst-item reverse' : 'kst-item';
        ?>
            <div class="<?php echo esc_attr($kst_item_class); ?>">
                <div class="kst-text">
                    <h2><?php the_title(); ?></h2>
                    <p><?php echo wp_kses_post( $kst_desc ); ?></p>

                    <!-- <div class="kst-list">
                        <span><?php echo esc_html($kst_lokasi ? $kst_lokasi : 'Lokasi belum diisi'); ?></span>
                        <span><?php echo esc_html($kst_tema_unggulan ? $kst_tema_unggulan : 'Tema unggulan belum diisi'); ?></span>
                    </div> -->
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
      $partners = [
        "WooLom",
        "Relume",
        "Webflow",
        "Universitas Brawijaya",
        "Agro Techno Park",
        "Green Science Park",
        "KST Ngijo",
        "KST Cangar",
        "KST Jatikerto",
      ];
    ?>

        <div class="partner-marquee">
            <div class="partner-track">
                <?php foreach ($partners as $partner): ?>
                <div class="partner-item"><?php echo esc_html($partner); ?></div>
                <?php endforeach; ?>

                <?php foreach ($partners as $partner): ?>
                <div class="partner-item"><?php echo esc_html($partner); ?></div>
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
                        <span class="tag">PRODUK KST</span>
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
                    <a class="news-card-link" href="<?php echo esc_url(kst_get_berita_url(get_the_ID())); ?>">
                        <div class="news-image">
                            <img src="<?php echo esc_url($news_image); ?>"
                                alt="<?php echo esc_attr(get_the_title()); ?>">
                        </div>

                        <div class="news-content">
                            <div class="category">Berita KST</div>
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