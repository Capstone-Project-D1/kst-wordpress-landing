<footer class="footer">
    <div class="container footer-shell">
        <div class="footer-brand-block">
            <a class="footer-brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Beranda">
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/logo.png"
                    alt="Logo Universitas Brawijaya">
            </a>

            <div class="footer-address-wrap">
                <h2>Alamat</h2>
                <address>
                    Gedung Layanan Bersama, Lt. 2,<br>
                    Ketawanggede, Kec. Lowokwaru,<br>
                    Kota Malang, Jawa Timur 65145
                </address>
            </div>
        </div>

        <nav class="footer-menu" aria-label="Navigasi footer">
            <a href="<?php echo esc_url(home_url('/#profil')); ?>">Kawasan KST</a>
            <a href="<?php echo esc_url(home_url('/#mitra')); ?>">Mitra</a>
            <a href="<?php echo esc_url(home_url('/#produk')); ?>">Produk</a>
            <a href="<?php echo esc_url(home_url('/#berita')); ?>">Berita</a>
        </nav>
    </div>

    <div class="footer-bar">
        <div class="container footer-bar-inner">
            <p>Copyright © <?php echo date('Y'); ?> Universitas Brawijaya.</p>
        </div>
    </div>
</footer>
<script>
function openKstModal(id) {
    const modal = document.getElementById('kst-modal-' + id);
    if (modal) {
        modal.classList.add('is-visible');
        document.body.classList.add('kst-modal-open');
    }
}

function closeKstModal(id) {
    const modal = document.getElementById('kst-modal-' + id);
    if (modal) {
        modal.classList.remove('is-visible');
        const visibleModals = document.querySelectorAll('.kst-modal-overlay.is-visible');
        if (visibleModals.length === 0) {
            document.body.classList.remove('kst-modal-open');
        }
    }
}

// Close modal when clicking outside on overlay backdrop
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('kst-modal-overlay')) {
        const id = event.target.id.replace('kst-modal-', '');
        closeKstModal(id);
    }
});

// Close modal on Escape key press
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const visibleModals = document.querySelectorAll('.kst-modal-overlay.is-visible');
        visibleModals.forEach(modal => {
            const id = modal.id.replace('kst-modal-', '');
            closeKstModal(id);
        });
    }
});
</script>

<?php wp_footer(); ?>
</body>

</html>