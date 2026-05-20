<?php
/*
Template Name: Halaman Berita
*/

get_header();

$berita_base_url = kst_get_berita_url();

$dummy_news = [
  [
    'title' => 'Inovasi Pangan Lokal Mulai Diuji Komunitas',
    'category' => 'Pangan',
    'date' => '20 Mei 2026',
    'excerpt' => 'Tim inkubator KST mulai melakukan uji pasar produk turunan pangan lokal bersama komunitas UMKM di Malang Raya.',
    'image' => 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?w=900&auto=format&fit=crop',
  ],
  [
    'title' => 'Program Mitra Industri Batch 3 Resmi Dibuka',
    'category' => 'Kemitraan',
    'date' => '18 Mei 2026',
    'excerpt' => 'Program ini mempertemukan startup binaan dengan pelaku industri untuk akselerasi produksi, validasi, dan distribusi.',
    'image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=900&auto=format&fit=crop',
  ],
  [
    'title' => 'Workshop Branding Produk Diikuti 120 Peserta',
    'category' => 'Pelatihan',
    'date' => '15 Mei 2026',
    'excerpt' => 'Peserta mendapatkan materi strategi identitas merek, kemasan, dan teknik storytelling agar produk lebih kompetitif.',
    'image' => 'https://images.unsplash.com/photo-1517048676732-d65bc937f952?w=900&auto=format&fit=crop',
  ],
  [
    'title' => 'KST Luncurkan Kelas Riset Terapan untuk Mahasiswa',
    'category' => 'Pendidikan',
    'date' => '12 Mei 2026',
    'excerpt' => 'Kelas ini berfokus pada riset yang siap dihilirisasi menjadi solusi praktis bagi kebutuhan masyarakat dan sektor industri.',
    'image' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=900&auto=format&fit=crop',
  ],
  [
    'title' => 'Produk Atsiri Binaan Tembus Pasar Regional',
    'category' => 'Produk',
    'date' => '10 Mei 2026',
    'excerpt' => 'Kolaborasi dengan mitra distribusi regional berhasil mendorong produk atsiri binaan masuk ke kanal ritel modern.',
    'image' => 'https://images.unsplash.com/photo-1463320726281-696a485928c7?w=900&auto=format&fit=crop',
  ],
  [
    'title' => 'Forum Investor Menghubungkan Startup dengan Pendanaan',
    'category' => 'Investasi',
    'date' => '8 Mei 2026',
    'excerpt' => 'Forum menghadirkan investor, mentor, dan pelaku startup untuk membahas kesiapan bisnis serta strategi pertumbuhan berkelanjutan.',
    'image' => 'https://images.unsplash.com/photo-1556761175-b413da4baf72?w=900&auto=format&fit=crop',
  ],
];

$detail_index = isset($_GET['detail']) ? absint(wp_unslash($_GET['detail'])) : null;
$is_detail = null !== $detail_index && isset($dummy_news[$detail_index]);
?>

<main>
  <?php if ($is_detail) : ?>
    <?php $item = $dummy_news[$detail_index]; ?>
    <section class="berita-page berita-detail-page" id="berita">
      <div class="container berita-detail-wrap">
        <a class="berita-back-link" href="<?php echo esc_url($berita_base_url); ?>">← Kembali ke daftar berita</a>

        <header class="berita-detail-header">
          <span class="berita-kicker"><?php echo esc_html($item['category']); ?></span>
          <h1 class="berita-title"><?php echo esc_html($item['title']); ?></h1>
          <p class="berita-subtitle">
            Ditulis oleh Admin Pusat • <?php echo esc_html($item['date']); ?> • 5 menit membaca
          </p>
        </header>

        <div class="berita-detail-hero-image">
          <img
            src="<?php echo esc_url($item['image']); ?>&sig=<?php echo esc_attr($detail_index + 200); ?>"
            alt="<?php echo esc_attr($item['title']); ?>"
          >
        </div>

        <div class="berita-detail-content">
          <h2>Ringkasan Berita</h2>
          <p><?php echo esc_html($item['excerpt']); ?></p>
          <p>
            Konten detail ini masih menggunakan data dummy untuk kebutuhan pengembangan.
            Pada tahap selanjutnya, bagian ini bisa langsung mengambil isi posting asli dari
            WordPress agar setiap berita memiliki konten yang berbeda.
          </p>
          <p>
            Struktur halaman sudah disiapkan agar mudah dikonversi ke data dinamis, termasuk
            metadata penulis, tanggal publikasi, gambar utama, dan daftar berita terkait.
          </p>
        </div>

        <div class="berita-related">
          <h3>Berita Lainnya</h3>
          <div class="berita-grid">
            <?php foreach ($dummy_news as $index => $related_item) : ?>
              <?php if ($index === $detail_index) : ?>
                <?php continue; ?>
              <?php endif; ?>
              <article class="berita-card">
                <a class="berita-card-link" href="<?php echo esc_url(kst_get_berita_url($index)); ?>">
                  <div class="berita-card-image">
                    <img
                      src="<?php echo esc_url($related_item['image']); ?>&sig=<?php echo esc_attr($index + 300); ?>"
                      alt="<?php echo esc_attr($related_item['title']); ?>"
                    >
                  </div>

                  <div class="berita-card-content">
                    <div class="berita-meta">
                      <span><?php echo esc_html($related_item['category']); ?></span>
                      <span><?php echo esc_html($related_item['date']); ?></span>
                    </div>

                    <h3><?php echo esc_html($related_item['title']); ?></h3>
                    <p><?php echo esc_html($related_item['excerpt']); ?></p>

                    <span class="berita-readmore">Baca selengkapnya</span>
                  </div>
                </a>
              </article>
            <?php endforeach; ?>
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
            Halaman ini menggunakan data dummy untuk kebutuhan pengembangan tampilan.
            Nanti datanya bisa diganti ke posting WordPress atau dari API sesuai kebutuhan.
          </p>
        </header>

        <div class="berita-grid">
          <?php foreach ($dummy_news as $index => $item) : ?>
            <article class="berita-card">
              <a class="berita-card-link" href="<?php echo esc_url(kst_get_berita_url($index)); ?>">
                <div class="berita-card-image">
                  <img
                    src="<?php echo esc_url($item['image']); ?>&sig=<?php echo esc_attr($index + 100); ?>"
                    alt="<?php echo esc_attr($item['title']); ?>"
                  >
                </div>

                <div class="berita-card-content">
                  <div class="berita-meta">
                    <span><?php echo esc_html($item['category']); ?></span>
                    <span><?php echo esc_html($item['date']); ?></span>
                  </div>

                  <h3><?php echo esc_html($item['title']); ?></h3>
                  <p><?php echo esc_html($item['excerpt']); ?></p>

                  <span class="berita-readmore">Baca selengkapnya</span>
                </div>
              </a>
            </article>
          <?php endforeach; ?>
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
