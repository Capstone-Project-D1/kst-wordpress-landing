<?php
/*
Template Name: Halaman Produk
*/
?>

<?php get_header(); ?>

<?php
$product_slug = isset($_GET['kst_product']) ? sanitize_key(wp_unslash($_GET['kst_product'])) : '';
$current_product = $product_slug ? get_page_by_path($product_slug, OBJECT, 'produk') : null;

if (!$current_product instanceof WP_Post) {
    $fallback_query = new WP_Query(
        array(
            'post_type' => 'produk',
            'post_status' => 'publish',
            'posts_per_page' => 1,
        )
    );

    if ($fallback_query->have_posts()) {
        $fallback_query->the_post();
        $current_product = get_post(get_the_ID());
    }

    wp_reset_postdata();
}

$current_product_id = $current_product instanceof WP_Post ? (int) $current_product->ID : 0;
$product_title = $current_product_id ? get_the_title($current_product_id) : 'Produk belum tersedia';
$product_content = $current_product_id ? wp_strip_all_tags(get_post_field('post_content', $current_product_id)) : 'Silakan tambahkan data produk melalui dashboard admin.';
$product_content = $product_content ? $product_content : 'Silakan tambahkan deskripsi produk pada editor konten.';
$product_main_image = $current_product_id ? get_the_post_thumbnail_url($current_product_id, 'large') : '';
$product_main_image = $product_main_image ? $product_main_image : 'https://images.unsplash.com/photo-1571575173700-afb9492e6a50?w=900&auto=format&fit=crop';
?>

<style>
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

@media (max-width: 420px) {
    .product-detail-section {
        padding: 44px 0 62px;
    }

    .back-link {
        font-size: 12px;
        margin-bottom: 18px;
    }

    .product-detail-left h1 {
        font-size: 30px;
        margin-bottom: 16px;
    }

    .product-detail-left p {
        font-size: 14px;
        line-height: 1.75;
        margin-bottom: 24px;
    }

    .product-gallery-small {
        gap: 14px;
    }

    .detail-small-image,
    .detail-main-image,
    .related-product-image {
        height: 210px;
    }

    .related-product-card {
        padding: 14px;
    }

    .related-product-content h3 {
        font-size: 20px;
    }

    .related-product-content p {
        font-size: 14px;
    }
}
</style>

<main>
    <section class="product-detail-section">
        <div class="container product-detail-container">

            <div class="product-detail-left">
                <a href="<?php echo esc_url(home_url('/#produk')); ?>" class="back-link">
                    ← Back
                </a>

                <h1><?php echo esc_html($product_title); ?></h1>

                <p><?php echo esc_html(wp_trim_words($product_content, 46)); ?></p>

                <div class="product-gallery-small">
                    <div class="detail-small-image">
                        <img src="<?php echo esc_url($product_main_image); ?>" alt="<?php echo esc_attr($product_title); ?>">
                    </div>

                    <div class="detail-small-image">
                        <img src="<?php echo esc_url($product_main_image); ?>" alt="<?php echo esc_attr($product_title); ?>">
                    </div>
                </div>
            </div>

            <div class="product-detail-right">
                <div class="detail-main-image">
                    <img src="<?php echo esc_url($product_main_image); ?>" alt="<?php echo esc_attr($product_title); ?>">
                </div>
            </div>

        </div>
    </section>

    <section class="related-product-section">
        <div class="container">
            <h2 class="section-title">Produk Unggulan Lainnya</h2>

            <div class="related-product-grid">
                <?php
                    $related_products = new WP_Query(
                        array(
                            'post_type' => 'produk',
                            'post_status' => 'publish',
                            'posts_per_page' => 6,
                            'post__not_in' => $current_product_id ? array($current_product_id) : array(),
                        )
                    );

                    if ($related_products->have_posts()) :
                        while ($related_products->have_posts()) :
                            $related_products->the_post();
                            $related_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
                            $related_image = $related_image ? $related_image : 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=700&auto=format&fit=crop';
                            $related_excerpt = has_excerpt() ? get_the_excerpt() : wp_trim_words(wp_strip_all_tags(get_the_content()), 12);
        ?>
                                <a href="<?php echo esc_url(kst_get_product_url(get_post_field('post_name', get_the_ID()))); ?>" class="related-product-card">
                    <div class="related-product-image">
                                                <span class="tag">PRODUK KST</span>
                                                <img src="<?php echo esc_url($related_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                    </div>

                    <div class="related-product-content">
                                                <h3><?php the_title(); ?></h3>
                                                <p><?php echo esc_html($related_excerpt); ?></p>
                    </div>
                                </a>
                                <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>
                                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
