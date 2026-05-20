<?php
/**
 * Template for Melon Premium Detail Page
 */
?>

<?php get_header(); ?>

<style>
  /* CSS KHUSUS HALAMAN MELON PREMIUM */
  .product-detail-section {
    padding: 88px 0 120px;
    background: #fbfffd;
  }

  .product-detail-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 76px;
    align-items: start;
  }

  .back-link {
    display: inline-flex;
    align-items: center;
    width: fit-content;
    margin-bottom: 28px;
    color: #111827;
    font-size: 13px;
    font-weight: 700;
    transition: 0.2s ease;
  }

  .back-link:hover {
    color: var(--green);
  }

  .product-detail-left h1 {
    font-size: 44px;
    line-height: 1.1;
    font-weight: 900;
    color: #111827;
    margin-bottom: 28px;
    letter-spacing: -0.8px;
  }

  .product-detail-left p {
    max-width: 640px;
    font-size: 17px;
    line-height: 1.7;
    color: #111827;
    text-align: justify;
    margin-bottom: 58px;
  }

  .product-gallery-small {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 22px;
  }

  .detail-small-image {
    height: 240px;
    background: #d9d9d9;
    overflow: hidden;
  }

  .detail-small-image img,
  .detail-main-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .detail-main-image {
    width: 100%;
    height: 460px;
    background: #d9d9d9;
    overflow: hidden;
  }

  .related-product-section {
    padding: 70px 0 130px;
    background: #fbfffd;
  }

  .related-product-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 26px;
  }

  .related-product-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: 12px;
    overflow: hidden;
    transition: 0.2s ease;
    padding: 20px;
  }

  .related-product-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 18px 30px rgba(0, 0, 0, 0.08);
  }

  .related-product-image {
    height: 320px;
    background: #d9d9d9;
    border-radius: 6px;
    overflow: hidden;
    position: relative;
    margin-bottom: 20px;
  }

  .related-product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .related-product-content h3 {
    font-size: 24px;
    line-height: 1.2;
    font-weight: 900;
    color: #111827;
    margin-bottom: 10px;
  }

  .related-product-content p {
    font-size: 15px;
    color: #111827;
    line-height: 1.5;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  @media (max-width: 900px) {
    .product-detail-container {
      grid-template-columns: 1fr;
      gap: 40px;
    }

    .detail-main-image {
      height: 360px;
    }

    .related-product-grid {
      grid-template-columns: 1fr 1fr;
    }

    .related-product-image {
      height: 260px;
    }
  }

  @media (max-width: 640px) {
    .product-detail-section {
      padding: 56px 0 80px;
    }

    .product-detail-left h1 {
      font-size: 34px;
    }

    .product-detail-left p {
      font-size: 15px;
      margin-bottom: 36px;
    }

    .product-gallery-small {
      grid-template-columns: 1fr;
    }

    .detail-small-image,
    .detail-main-image {
      height: 260px;
    }

    .related-product-grid {
      grid-template-columns: 1fr;
    }

    .related-product-image {
      height: 250px;
    }

    .related-product-content h3 {
      font-size: 22px;
    }
  }
</style>

<main>
  <section class="product-detail-section">
    <div class="container product-detail-container">

      <div class="product-detail-left">
        <!-- BAGIAN YANG DIGANTI:
             Breadcrumb Home > Produk Unggulan > Melon Premium
             diganti jadi tombol Back saja.
        -->
        <a href="<?php echo esc_url(home_url('/#index')); ?>" class="back-link">
          ← Back
        </a>

        <h1>Melon Premium</h1>

        <p>
          Melon premium berkualitas tinggi yang dibudidayakan dengan teknik pertanian
          modern, dipantau secara ketat untuk menghasilkan buah yang manis, segar,
          dan konsisten setiap panennya.
        </p>

        <div class="product-gallery-small">
          <div class="detail-small-image">
            <img
              src="https://images.unsplash.com/photo-1571575173700-afb9492e6a50?w=600&auto=format&fit=crop"
              alt="Melon Premium"
            >
          </div>

          <div class="detail-small-image">
            <img
              src="https://images.unsplash.com/photo-1571575173700-afb9492e6a50?w=601&auto=format&fit=crop"
              alt="Melon Premium"
            >
          </div>
        </div>
      </div>

      <div class="product-detail-right">
        <div class="detail-main-image">
          <img
            src="https://images.unsplash.com/photo-1571575173700-afb9492e6a50?w=900&auto=format&fit=crop"
            alt="Melon Premium"
          >
        </div>
      </div>

    </div>
  </section>

  <section class="related-product-section">
    <div class="container">
      <h2 class="section-title">Produk Unggulan Lainnya</h2>

      <div class="related-product-grid">
        <?php
          $relatedProducts = [
            ["Produk Jamu", "Pengembangan produk herbal berbasis bahan alami.", "KST Ngijo"],
            ["Produk Atsiri (Minyak Atsiri)", "Produk hasil ekstraksi tanaman aromatik atau rempah.", "KST Ngijo"],
            ["Perikanan Air Tawar", "Pengembangan budidaya dan inovasi di bidang perikanan.", "KST Ngijo"],
            ["Pusat Riset", "Fokus utama pada budidaya kentang dan varietas unggulan.", "KST Cangar"],
            ["Energi Mikrohidro", "Pemanfaatan energi terbarukan berbasis aliran air.", "KST Ngijo"],
            ["Energi Mikrohidro", "Pemanfaatan energi terbarukan berbasis aliran air.", "KST Ngijo"],
          ];

          foreach ($relatedProducts as $index => $product):
        ?>
          <article class="related-product-card">
            <div class="related-product-image">
              <span class="tag"><?php echo esc_html($product[2]); ?></span>
              <img
                src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=700&auto=format&fit=crop&sig=<?php echo esc_attr($index + 20); ?>"
                alt="<?php echo esc_attr($product[0]); ?>"
              >
            </div>

            <div class="related-product-content">
              <h3><?php echo esc_html($product[0]); ?></h3>
              <p><?php echo esc_html($product[1]); ?></p>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>