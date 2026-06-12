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

// Get ACF Detail Images
$images = array();
if ($current_product_id) {
    $img1 = function_exists('get_field') ? get_field('gambar_detail_1', $current_product_id) : '';
    $img2 = function_exists('get_field') ? get_field('gambar_detail_2', $current_product_id) : '';
    $img3 = function_exists('get_field') ? get_field('gambar_detail_3', $current_product_id) : '';

    if ($img1) $images[] = $img1;
    if ($img2) $images[] = $img2;
    if ($img3) $images[] = $img3;
}

// Fallback to Featured Image
if (empty($images) && $current_product_id) {
    $featured_image = get_the_post_thumbnail_url($current_product_id, 'large');
    if ($featured_image) {
        $images[] = $featured_image;
    }
}

// Global fallback if absolutely no images are available
if (empty($images)) {
    $images[] = 'https://images.unsplash.com/photo-1571575173700-afb9492e6a50?w=900&auto=format&fit=crop';
}

// Main image displayed initially is the first image in our list
$product_main_image = $images[0];
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
    grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
    gap: 16px;
    margin-top: 24px;
}

.detail-small-image-btn {
    height: 120px;
    background: #f3f4f6;
    border: 2px solid transparent;
    border-radius: 8px;
    overflow: hidden;
    cursor: pointer;
    padding: 0;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: block;
    width: 100%;
    position: relative;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
}

.detail-small-image-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
}

.detail-small-image-btn.active {
    border-color: var(--green);
    box-shadow: 0 0 0 4px rgba(47, 163, 107, 0.25);
}

.detail-small-image-btn img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.detail-small-image-btn:hover img {
    transform: scale(1.06);
}

.detail-main-image {
    width: 100%;
    height: 460px;
    background: #f3f4f6;
    border-radius: 12px;
    overflow: hidden;
    position: relative;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

.detail-main-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: opacity 0.2s ease;
}

.zoom-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0.45);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: white;
    opacity: 0;
    transition: opacity 0.3s ease;
    backdrop-filter: blur(4px);
    pointer-events: none;
}

.detail-main-image:hover .zoom-overlay {
    opacity: 1;
}

.zoom-icon {
    width: 28px;
    height: 28px;
    margin-bottom: 6px;
    stroke: currentColor;
    stroke-width: 2.5;
    transform: scale(0.85);
    transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.detail-main-image:hover .zoom-icon {
    transform: scale(1);
}

.zoom-overlay span {
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

/* Lightbox Modal */
.lightbox-modal {
    display: none;
    position: fixed;
    z-index: 99999;
    left: 0;
    top: 0;
    width: 100vw;
    height: 100vh;
    overflow: hidden;
    background-color: rgba(17, 24, 39, 0.95);
    backdrop-filter: blur(12px);
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.lightbox-modal.show {
    display: flex;
    opacity: 1;
}

.lightbox-content {
    max-width: 85%;
    max-height: 80%;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    transform: scale(0.95);
    transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.lightbox-modal.show .lightbox-content {
    transform: scale(1);
}

.lightbox-content img {
    max-width: 100%;
    max-height: 80vh;
    object-fit: contain;
    border-radius: 8px;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6);
}

.lightbox-close {
    position: absolute;
    top: 24px;
    right: 32px;
    color: #f3f4f6;
    font-size: 40px;
    font-weight: 300;
    cursor: pointer;
    transition: color 0.2s, transform 0.2s;
    z-index: 100001;
    line-height: 1;
}

.lightbox-close:hover {
    color: var(--green);
    transform: scale(1.1);
}

.lightbox-prev,
.lightbox-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.08);
    border: none;
    color: white;
    font-size: 24px;
    font-weight: bold;
    cursor: pointer;
    border-radius: 50%;
    transition: background 0.3s, transform 0.2s, color 0.3s;
    z-index: 100001;
    user-select: none;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
}

.lightbox-prev {
    left: 32px;
}

.lightbox-next {
    right: 32px;
}

.lightbox-prev:hover,
.lightbox-next:hover {
    background: var(--green);
    color: white;
    transform: translateY(-50%) scale(1.05);
}

.lightbox-prev:active,
.lightbox-next:active {
    transform: translateY(-50%) scale(0.95);
}

.lightbox-caption {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    color: #e5e7eb;
    font-size: 15px;
    font-weight: 600;
    text-align: center;
    z-index: 100001;
    background: rgba(17, 24, 39, 0.6);
    padding: 8px 18px;
    border-radius: 999px;
    backdrop-filter: blur(4px);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

@media (max-width: 768px) {
    .lightbox-prev,
    .lightbox-next {
        width: 48px;
        height: 48px;
        font-size: 18px;
    }
    .lightbox-prev {
        left: 16px;
    }
    .lightbox-next {
        right: 16px;
    }
    .lightbox-close {
        top: 16px;
        right: 20px;
    }
    .lightbox-caption {
        bottom: 20px;
        font-size: 13px;
        width: 80%;
    }
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

                <?php 
                $kst_id = function_exists('get_field') ? get_field('relasi_kst', $current_product_id) : null;
                if ($kst_id) : 
                    $kst_title = get_the_title($kst_id);
                    $kst_color = function_exists('get_field') ? get_field('kst_button_color', $kst_id) : '';
                    $kst_bg_color = $kst_color ? $kst_color : 'var(--green)';
                ?>
                    <div class="product-kst-wrapper">
                        <span class="detail-label">Kawasan Asal:</span>
                        <a href="<?php echo esc_url(get_permalink($kst_id)); ?>" class="detail-kst-badge" style="background-color: <?php echo esc_attr($kst_bg_color); ?>;">
                            <svg class="badge-icon" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2a8 8 0 0 0-8 8c0 5.25 8 12 8 12s8-6.75 8-12a8 8 0 0 0-8-8z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <?php echo esc_html($kst_title); ?>
                        </a>
                    </div>
                <?php endif; ?>

                <p><?php echo esc_html(wp_trim_words($product_content, 46)); ?></p>

                <?php if (count($images) > 1) : ?>
                    <div class="product-gallery-small">
                        <?php foreach ($images as $index => $img_url) : ?>
                            <button type="button" class="detail-small-image-btn <?php echo $index === 0 ? 'active' : ''; ?>" data-image-index="<?php echo $index; ?>" data-image-url="<?php echo esc_url($img_url); ?>" aria-label="Lihat gambar <?php echo $index + 1; ?>">
                                <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($product_title); ?> - <?php echo $index + 1; ?>">
                            </button>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="product-detail-right">
                <div class="detail-main-image" id="main-image-container" style="cursor: pointer; position: relative;">
                    <img id="product-main-img-el" src="<?php echo esc_url($product_main_image); ?>" alt="<?php echo esc_attr($product_title); ?>">
                    <div class="zoom-overlay">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="zoom-icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.637 10.637z" />
                        </svg>
                        <span>Click to Zoom</span>
                    </div>
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

<!-- Lightbox Modal -->
<div id="image-lightbox-modal" class="lightbox-modal" aria-hidden="true" role="dialog">
    <span class="lightbox-close" id="lightbox-close-btn">&times;</span>
    <button class="lightbox-prev" id="lightbox-prev-btn" aria-label="Previous image">&#10094;</button>
    <div class="lightbox-content">
        <img id="lightbox-img" src="" alt="Detail Gambar">
    </div>
    <button class="lightbox-next" id="lightbox-next-btn" aria-label="Next image">&#10095;</button>
    <div class="lightbox-caption" id="lightbox-caption-el"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const thumbnails = document.querySelectorAll('.detail-small-image-btn');
    const mainImg = document.getElementById('product-main-img-el');
    const mainImgContainer = document.getElementById('main-image-container');
    
    const modal = document.getElementById('image-lightbox-modal');
    const modalImg = document.getElementById('lightbox-img');
    const modalCaption = document.getElementById('lightbox-caption-el');
    const closeBtn = document.getElementById('lightbox-close-btn');
    const prevBtn = document.getElementById('lightbox-prev-btn');
    const nextBtn = document.getElementById('lightbox-next-btn');
    
    const productTitle = <?php echo json_encode($product_title); ?>;
    const images = <?php echo json_encode($images); ?>;
    let currentIndex = 0;
    
    function updateMainImage(index) {
        currentIndex = index;
        const newUrl = images[currentIndex];
        
        if (mainImg) {
            mainImg.style.opacity = '0';
            setTimeout(() => {
                mainImg.src = newUrl;
                mainImg.style.opacity = '1';
            }, 150);
        }
        
        thumbnails.forEach((btn, idx) => {
            if (idx === currentIndex) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });
    }
    
    thumbnails.forEach((btn, index) => {
        btn.addEventListener('click', function() {
            updateMainImage(index);
        });
    });
    
    function openLightbox() {
        if (!modal || !modalImg) return;
        modalImg.src = images[currentIndex];
        if (modalCaption) {
            modalCaption.textContent = `${productTitle} - Gambar ${currentIndex + 1} dari ${images.length}`;
        }
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
        modal.setAttribute('aria-hidden', 'false');
        
        if (prevBtn && nextBtn) {
            if (images.length <= 1) {
                prevBtn.style.display = 'none';
                nextBtn.style.display = 'none';
            } else {
                prevBtn.style.display = 'flex';
                nextBtn.style.display = 'flex';
            }
        }
    }
    
    function closeLightbox() {
        if (!modal) return;
        modal.classList.remove('show');
        document.body.style.overflow = '';
        modal.setAttribute('aria-hidden', 'true');
    }
    
    function navigateLightbox(direction) {
        if (direction === 'next') {
            currentIndex = (currentIndex + 1) % images.length;
        } else if (direction === 'prev') {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
        }
        updateMainImage(currentIndex);
        if (modalImg) modalImg.src = images[currentIndex];
        if (modalCaption) {
            modalCaption.textContent = `${productTitle} - Gambar ${currentIndex + 1} dari ${images.length}`;
        }
    }
    
    if (mainImgContainer) {
        mainImgContainer.addEventListener('click', openLightbox);
    }
    
    if (closeBtn) {
        closeBtn.addEventListener('click', closeLightbox);
    }
    
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal || e.target.classList.contains('lightbox-content')) {
                closeLightbox();
            }
        });
    }
    
    if (prevBtn) {
        prevBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            navigateLightbox('prev');
        });
    }
    
    if (nextBtn) {
        nextBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            navigateLightbox('next');
        });
    }
    
    document.addEventListener('keydown', function(e) {
        if (!modal || !modal.classList.contains('show')) return;
        
        if (e.key === 'Escape') {
            closeLightbox();
        } else if (e.key === 'ArrowRight' && images.length > 1) {
            navigateLightbox('next');
        } else if (e.key === 'ArrowLeft' && images.length > 1) {
            navigateLightbox('prev');
        }
    });
});
</script>

<?php get_footer(); ?>
