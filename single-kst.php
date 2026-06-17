<?php get_header(); ?>

<?php
$kst_lokasi = function_exists('get_field') ? get_field('kst_lokasi') : '';
$kst_tema_unggulan = function_exists('get_field') ? get_field('kst_tema_unggulan') : '';
$landing_page_url = function_exists('get_field') ? get_field('kst_landing_page_url') : '';
$dashboard_url = function_exists('get_field') ? get_field('kst_dashboard_url') : '';

// Kontak details
$kontak_email = function_exists('get_field') ? get_field('kst_kontak_email') : '';
$kontak_telepon = function_exists('get_field') ? get_field('kst_kontak_telepon') : '';
$alamat_lengkap = function_exists('get_field') ? get_field('kst_alamat_lengkap') : '';
$map_embed = function_exists('get_field') ? get_field('kst_map_embed') : '';

// Fallbacks
$landing_page_url = $landing_page_url ? $landing_page_url : '#';
$dashboard_url = $dashboard_url ? $dashboard_url : '#';
$kst_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
$kst_image = $kst_image ? $kst_image : 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=1600&auto=format&fit=crop';

$kst_btn_color = function_exists('get_field') ? get_field('kst_button_color') : '';
$btn_style = $kst_btn_color ? 'style="background-color: ' . esc_attr($kst_btn_color) . '; border-color: ' . esc_attr($kst_btn_color) . ';"' : '';
?>

<main class="kst-detail-page">
    <!-- HERO HEADER -->
    <section class="kst-detail-hero"
        style="background: linear-gradient(rgba(17, 24, 39, 0.75), rgba(17, 24, 39, 0.75)), url('<?php echo esc_url($kst_image); ?>') center/cover;">
        <div class="container">
            <a href="<?php echo esc_url(home_url('/#profil')); ?>" class="kst-back-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Kembali ke Beranda
            </a>
            <h1 class="kst-detail-title"><?php the_title(); ?></h1>
            <div class="kst-detail-badges">
                <?php if ($kst_lokasi) : ?>
                <span class="badge badge-lokasi">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2a8 8 0 0 0-8 8c0 5.25 8 12 8 12s8-6.75 8-12a8 8 0 0 0-8-8z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                    <?php echo esc_html($kst_lokasi); ?>
                </span>
                <?php endif; ?>
                <?php if ($kst_tema_unggulan) : ?>
                <span class="badge badge-tema">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                        <polyline points="2 17 12 22 22 17"></polyline>
                        <polyline points="2 12 12 17 22 12"></polyline>
                    </svg>
                    Tema: <?php echo esc_html($kst_tema_unggulan); ?>
                </span>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- CONTENT GRID -->
    <section class="section">
        <div class="container">
            <div class="kst-detail-grid">

                <!-- MAIN CONTENT -->
                <div class="kst-detail-main">
                    <div class="kst-detail-content-card">
                        <h2>Tentang Kawasan</h2>
                        <div class="kst-detail-body-text">
                            <?php 
                            if (have_posts()) : 
                                while (have_posts()) : the_post(); 
                                    the_content(); 
                                endwhile; 
                            endif; 
                            ?>
                        </div>
                    </div>

                    <?php if ($map_embed) : ?>
                    <div class="kst-detail-content-card map-card">
                        <h2>Lokasi Peta</h2>
                        <div class="kst-map-wrapper">
                            <?php echo $map_embed; // HTML iframe is allowed from admin ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- SIDEBAR -->
                <div class="kst-detail-sidebar">

                    <!-- AKSES LAYANAN CARD -->
                    <div class="kst-sidebar-card card-action">
                        <h3>Akses Layanan</h3>
                        <div class="sidebar-info-box">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="16" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12.01" y2="8"></line>
                            </svg>
                            <!-- <p>Publik hanya dapat mengakses Landing Page. Dashboard hanya untuk pengguna berakun.</p> -->
                            <p class="info-text">
                                <strong>Pemberitahuan:</strong> Publik hanya dapat mengakses halaman
                                <strong>Landing Page</strong>.
                            </p>
                        </div>
                        <div class="sidebar-action-buttons">
                            <a href="<?php echo esc_url($landing_page_url); ?>"
                                class="btn-kst-sidebar-action btn-landing" target="_blank">
                                <span>Landing Page</span>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                    <polyline points="15 3 21 3 21 9"></polyline>
                                    <line x1="10" y1="14" x2="21" y2="3"></line>
                                </svg>
                            </a>
                            <!-- <button onclick="openKstModal(<?php the_ID(); ?>)" class="btn-kst-sidebar-action btn-dashboard">
                                <span>Dashboard</span>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            </button> -->
                        </div>
                    </div>

                    <!-- INFORMASI KONTAK CARD -->
                    <?php if ($kontak_email || $kontak_telepon || $alamat_lengkap) : ?>
                    <div class="kst-sidebar-card card-contact">
                        <h3>Informasi Kontak</h3>
                        <ul class="contact-list">
                            <?php if ($alamat_lengkap) : ?>
                            <li>
                                <div class="contact-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                        <circle cx="12" cy="10" r="3"></circle>
                                    </svg>
                                </div>
                                <div class="contact-text">
                                    <strong>Alamat:</strong>
                                    <p><?php echo nl2br(esc_html($alamat_lengkap)); ?></p>
                                </div>
                            </li>
                            <?php endif; ?>
                            <?php if ($kontak_telepon) : ?>
                            <li>
                                <div class="contact-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="contact-text">
                                    <strong>Telepon/WhatsApp:</strong>
                                    <p><a
                                            href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $kontak_telepon)); ?>"><?php echo esc_html($kontak_telepon); ?></a>
                                    </p>
                                </div>
                            </li>
                            <?php endif; ?>
                            <?php if ($kontak_email) : ?>
                            <li>
                                <div class="contact-icon">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                        </path>
                                        <polyline points="22,6 12,13 2,6"></polyline>
                                    </svg>
                                </div>
                                <div class="contact-text">
                                    <strong>Email:</strong>
                                    <p><a
                                            href="mailto:<?php echo esc_attr($kontak_email); ?>"><?php echo esc_html($kontak_email); ?></a>
                                    </p>
                                </div>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>

    <!-- Modal Overlay (Reusable on single page) -->
    <div class="kst-modal-overlay" id="kst-modal-<?php the_ID(); ?>">
        <div class="kst-modal-container">
            <div class="kst-modal-header">
                <h3>Akses Dashboard <?php the_title(); ?></h3>
                <button class="btn-kst-modal-close" onclick="closeKstModal(<?php the_ID(); ?>)"
                    aria-label="Tutup">&times;</button>
            </div>
            <div class="kst-modal-body">
                <div class="kst-website-info">
                    <div class="info-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                    </div>
                    <p class="info-text">
                        <strong>Pemberitahuan:</strong> Halaman Dashboard hanya dapat diakses oleh pengguna yang
                        memiliki akun resmi. Jika Anda sudah memiliki akun, silakan lanjut ke dashboard.
                    </p>
                </div>

                <div class="kst-website-buttons">
                    <a href="<?php echo esc_url($dashboard_url); ?>" class="btn-kst-action btn-landing"
                        style="background-color: var(--green); border-color: var(--green);" target="_blank">
                        <span>Lanjutkan ke Dashboard</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                            <polyline points="15 3 21 3 21 9"></polyline>
                            <line x1="10" y1="14" x2="21" y2="3"></line>
                        </svg>
                    </a>
                    <button onclick="closeKstModal(<?php the_ID(); ?>)" class="btn-kst-action btn-dashboard">
                        <span>Batal</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>