<?php get_header(); ?>

<main>
  <!-- HERO -->
  <section class="hero">
    <div class="hero-content">
      <h1>Pusat Inovasi dan Teknologi Universitas Brawijaya</h1>
      <p>Jelajahi ekosistem sains dan teknologi Universitas Brawijaya</p>
    </div>
  </section>

  <!-- PROFIL KST -->
  <section class="kst-wrapper" id="profil">
    <div class="container">

      <div class="kst-item">
        <div class="kst-text">
          <h2>KST NGIJO</h2>
          <p>
            KST Ngijo Green Science Park merupakan kawasan sains dan teknologi yang
            berperan dalam riset, inovasi, hilirisasi, diseminasi, dan pengembangan
            teknologi berbasis lingkungan.
          </p>
          <p>
            KST Ngijo berfokus pada beberapa sektor utama, terutama pengembangan produk
            inovatif, edukasi, pertanian, dan konservasi lingkungan. Kawasan ini menjadi
            ruang kolaborasi antara akademisi, masyarakat, dan mitra strategis.
          </p>

          <div class="kst-list">
            <span>Inovasi hijau</span>
            <span>Produk riset</span>
            <span>Teknologi ramah lingkungan</span>
          </div>
        </div>

        <div class="kst-image">
          <img
            src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=900&auto=format&fit=crop"
            alt="KST Ngijo"
          >
        </div>
      </div>

      <div class="kst-item reverse">
        <div class="kst-text">
          <h2>KST CANGAR</h2>
          <p>
            KST Cangar merupakan kawasan sains dan teknologi di daerah dataran tinggi
            yang berfokus pada pengembangan pertanian, wisata edukasi, konservasi alam,
            dan pengelolaan sumber daya kawasan.
          </p>
          <p>
            KST Cangar menjadi pusat pembelajaran terpadu yang menghubungkan inovasi
            akademik dengan kebutuhan masyarakat dan lingkungan sekitar.
          </p>

          <div class="kst-list">
            <span>Pariwisata</span>
            <span>Wisata Edukasi</span>
            <span>Laboratorium alam</span>
          </div>
        </div>

        <div class="kst-image">
          <img
            src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=900&auto=format&fit=crop"
            alt="KST Cangar"
          >
        </div>
      </div>

      <div class="kst-item">
        <div class="kst-text">
          <h2>KST JATIKERTO</h2>
          <p>
            Agro Techno Park Jatikerto merupakan kawasan riset, edukasi, konservasi,
            dan pengembangan teknologi pertanian Universitas Brawijaya. KST ini menjadi
            pusat pembelajaran dan pengembangan komoditas unggulan.
          </p>
          <p>
            KST Jatikerto mendukung kegiatan akademik, penelitian, peternakan,
            konservasi, dan kemitraan dengan berbagai pihak untuk mendukung ekosistem
            inovasi berkelanjutan.
          </p>

          <div class="kst-list">
            <span>Pelayanan Akademik</span>
            <span>Peternakan</span>
            <span>Konservasi</span>
          </div>
        </div>

        <div class="kst-image">
          <img
            src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=900&auto=format&fit=crop"
            alt="KST Jatikerto"
          >
        </div>
      </div>

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
    $products = [
      ["Melon Premium", "Hasil pertanian unggulan berbasis teknologi.", "KST JATIKERTO"],
      ["Produk Jerami", "Pengembangan produk berbasis limbah pertanian.", "KST NGIJO"],
      ["Produk Atsiri (Minyak Atsiri)", "Produk hasil ekstraksi tanaman aromatik.", "KST NGIJO"],
      ["Perikanan Air Tawar", "Pengembangan budidaya air tawar terpadu.", "KST CANGAR"],
      ["Fasilitas Eduwisata", "Kawasan edukasi berbasis wisata dan riset.", "KST CANGAR"],
      ["Cafe Eduwisata", "Unit layanan wisata yang terintegrasi edukasi.", "KST CANGAR"],
      ["Pusat Riset", "Fasilitas riset pengembangan teknologi dan inovasi.", "KST NGIJO"],
      ["Energi Mikrohidro", "Pemanfaatan energi terbarukan skala kecil.", "KST NGIJO"],
      ["Pengolahan Sampah Terpadu", "Pengolahan limbah kawasan secara berkelanjutan.", "KST NGIJO"],
      ["Hewan Kurban", "Unit layanan peternakan dan pengelolaan ternak.", "KST JATIKERTO"],
      ["Konservasi", "Program konservasi satwa dan tumbuhan kawasan.", "KST JATIKERTO"],
      ["Pelayanan Penelitian", "Fasilitas penelitian mahasiswa dan dosen.", "KST JATIKERTO"],
    ];
  ?>

  <?php foreach ($products as $index => $product): ?>

    <?php if ($product[0] === "Melon Premium"): ?>

      <!-- CARD MELON PREMIUM SAJA YANG BISA DIKLIK -->
      <a href="<?php echo esc_url(home_url('/page-melon-premium')); ?>" class="product-card">
        <div class="product-image">
          <span class="tag"><?php echo esc_html($product[2]); ?></span>
          <img
            src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=600&auto=format&fit=crop&sig=<?php echo esc_attr($index); ?>"
            alt="<?php echo esc_attr($product[0]); ?>"
          >
        </div>

        <div class="product-content">
          <h3><?php echo esc_html($product[0]); ?></h3>
          <p><?php echo esc_html($product[1]); ?></p>
        </div>
      </a>

    <?php else: ?>

      <!-- CARD PRODUK LAIN TIDAK BISA DIKLIK -->
      <article class="product-card">
        <div class="product-image">
          <span class="tag"><?php echo esc_html($product[2]); ?></span>
          <img
            src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=600&auto=format&fit=crop&sig=<?php echo esc_attr($index); ?>"
            alt="<?php echo esc_attr($product[0]); ?>"
          >
        </div>

        <div class="product-content">
          <h3><?php echo esc_html($product[0]); ?></h3>
          <p><?php echo esc_html($product[1]); ?></p>
        </div>
      </article>

    <?php endif; ?>

  <?php endforeach; ?>
</div>
    </div>
  </section>

  <!-- BERITA & AGENDA -->
  <section class="news-section" id="berita">
    <div class="container">
      <h2 class="section-title">BERITA & AGENDA</h2>

      <div class="news-grid">
        <?php for ($i = 1; $i <= 3; $i++): ?>
          <article class="news-card">
            <div class="news-image">
              <img
                src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?w=700&auto=format&fit=crop&sig=<?php echo esc_attr($i); ?>"
                alt="Berita dan Agenda"
              >
            </div>

            <div class="news-content">
              <div class="category">Kategori</div>
              <h3>Judul Berita dan Agenda</h3>
              <p>
                Deskripsi berita dan agenda KST UB untuk memberikan informasi
                terbaru kepada masyarakat umum.
              </p>

              <div class="author">
                <span class="avatar">UB</span>
                <div>
                  <strong>Admin Pusat</strong><br>
                  <span>12 Januari 2026 • 5 menit membaca</span>
                </div>
              </div>
            </div>
          </article>
        <?php endfor; ?>
      </div>

      <div class="btn-center">
        <a href="#" class="btn-more">Lihat Semua</a>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>