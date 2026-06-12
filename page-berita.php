<?php
/*
Template Name: Halaman Berita
*/

get_header();

$berita_base_url = kst_get_berita_url();

$detail_id = isset($_GET['detail']) ? absint(wp_unslash($_GET['detail'])) : 0;
$detail_post = $detail_id ? get_post($detail_id) : null;
$is_detail = $detail_post instanceof WP_Post && 'berita' === $detail_post->post_type;

$from_home = isset($_GET['from']) && 'home' === sanitize_text_field(wp_unslash($_GET['from']));
if ($from_home) {
    $back_url = home_url('/#berita');
    $back_text = '← Kembali ke Beranda';
} else {
    $back_url = $berita_base_url;
    $back_text = '← Kembali ke daftar berita';
}
?>

<main>
    <?php if ($is_detail) : ?>
    <?php
      $detail_title = get_the_title($detail_post);
      $detail_excerpt = has_excerpt($detail_post) ? get_the_excerpt($detail_post) : wp_trim_words(wp_strip_all_tags($detail_post->post_content), 30);
      $detail_image = get_the_post_thumbnail_url($detail_post, 'large');
      $detail_image = $detail_image ? $detail_image : 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?w=900&auto=format&fit=crop';
    ?>
    <section class="berita-page berita-detail-page" id="berita">
        <div class="container berita-detail-wrap">
            <a class="berita-back-link" href="<?php echo esc_url($back_url); ?>"><?php echo esc_html($back_text); ?></a>

            <header class="berita-detail-header">
                <div class="berita-detail-kicker-wrap">
                    <span class="berita-kicker">Berita KST</span>
                    <?php 
                    $kst_id = function_exists('get_field') ? get_field('relasi_kst', $detail_post->ID) : null;
                    if ($kst_id) : 
                        $kst_title = get_the_title($kst_id);
                        $kst_color = function_exists('get_field') ? get_field('kst_button_color', $kst_id) : '';
                        $kst_bg_color = $kst_color ? $kst_color : 'var(--green)';
                    ?>
                        <a href="<?php echo esc_url(get_permalink($kst_id)); ?>" class="berita-detail-kst-link" style="background-color: <?php echo esc_attr($kst_bg_color); ?>;">
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2a8 8 0 0 0-8 8c0 5.25 8 12 8 12s8-6.75 8-12a8 8 0 0 0-8-8z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <?php echo esc_html($kst_title); ?>
                        </a>
                    <?php endif; ?>
                </div>
                <h1 class="berita-title"><?php echo esc_html($detail_title); ?></h1>
                <p class="berita-subtitle">
                    Ditulis oleh <?php echo esc_html(get_the_author_meta('display_name', (int) $detail_post->post_author)); ?> • <?php echo esc_html(get_the_date('d F Y', $detail_post)); ?> • 5 menit membaca
                </p>
            </header>

            <div class="berita-detail-hero-image">
                <img src="<?php echo esc_url($detail_image); ?>" alt="<?php echo esc_attr($detail_title); ?>">
            </div>

            <div class="berita-detail-content">
                <h2>Ringkasan Berita</h2>
                <p><?php echo esc_html($detail_excerpt); ?></p>
                <?php echo wp_kses_post(wpautop($detail_post->post_content)); ?>
            </div>

            <div class="berita-related">
                <h3>Berita Lainnya</h3>
                <div class="berita-grid">
                    <?php
            $related_query = new WP_Query(
              array(
                'post_type' => 'berita',
                'post_status' => 'publish',
                'posts_per_page' => 3,
                'post__not_in' => array((int) $detail_post->ID),
              )
            );
          ?>

                    <?php if ($related_query->have_posts()) : ?>
                    <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                    <?php
                $related_excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words(wp_strip_all_tags(get_the_content()), 20);
                $related_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
                $related_image = $related_image ? $related_image : 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?w=900&auto=format&fit=crop';
              ?>
                        <?php
                        $related_link = kst_get_berita_url(get_the_ID());
                        if ($from_home) {
                            $related_link = add_query_arg('from', 'home', $related_link);
                        }
                        ?>
                        <a class="berita-card-link" href="<?php echo esc_url($related_link); ?>">
                            <div class="berita-card-image">
                                <img src="<?php echo esc_url($related_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                            </div>

                            <div class="berita-card-content">
                                <div class="berita-meta">
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
                                    <span><?php echo esc_html(get_the_date('d F Y')); ?></span>
                                </div>

                                <h3><?php the_title(); ?></h3>
                                <p><?php echo esc_html($related_excerpt); ?></p>

                                <span class="berita-readmore">Baca selengkapnya</span>
                            </div>
                        </a>
                    </article>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
    <?php else : ?>
    <section class="berita-page" id="berita">
        <div class="container">
            <header class="berita-header">
                <span class="berita-kicker">BERITA KST</span>
                <h1 class="berita-title">Kabar Terbaru Seputar Inovasi, Mitra, dan Produk</h1>
                <p class="berita-subtitle">
                    Halaman ini menampilkan data dinamis dari CMS WordPress.
                    Konten dapat dikelola melalui menu Berita KST di dashboard admin.
                </p>
            </header>

            <div class="berita-grid">
                <?php
          $news_query = new WP_Query(
            array(
              'post_type' => 'berita',
              'post_status' => 'publish',
              'posts_per_page' => 9,
            )
          );
        ?>

                <?php if ($news_query->have_posts()) : ?>
                <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
                <?php
              $news_excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words(wp_strip_all_tags(get_the_content()), 20);
              $news_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
              $news_image = $news_image ? $news_image : 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?w=900&auto=format&fit=crop';
            ?>
                <article class="berita-card">
                    <a class="berita-card-link" href="<?php echo esc_url(kst_get_berita_url(get_the_ID())); ?>">
                        <div class="berita-card-image">
                            <img src="<?php echo esc_url($news_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                        </div>

                        <div class="berita-card-content">
                            <div class="berita-meta">
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
                                <span><?php echo esc_html(get_the_date('d F Y')); ?></span>
                            </div>

                            <h3><?php the_title(); ?></h3>
                            <p><?php echo esc_html($news_excerpt); ?></p>

                            <span class="berita-readmore">Baca selengkapnya</span>
                        </div>
                    </a>
                </article>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
                <?php else : ?>
                <article class="berita-card">
                    <div class="berita-card-content">
                        <h3>Belum ada berita</h3>
                        <p>Silakan tambahkan konten berita melalui dashboard admin.</p>
                    </div>
                </article>
                <?php endif; ?>
            </div>

            <div class="berita-pagination" aria-label="Pagination dummy">
                <span class="is-active">1</span>
                <span>2</span>
                <span>3</span>
            </div>
        </div>
    </section>
    <?php endif; ?>
</main>

<?php get_footer();