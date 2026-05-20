<footer class="footer">
  <div class="container">
    <div class="footer-top">
      <div class="footer-logo">Logo</div>

      <nav class="footer-menu">
        <a href="<?php echo esc_url(home_url('/#profil')); ?>">Profil</a>
        <a href="<?php echo esc_url(home_url('/#mitra')); ?>">Mitra</a>
        <a href="<?php echo esc_url(home_url('/#produk')); ?>">Produk</a>
        <a href="<?php echo esc_url(kst_get_berita_url()); ?>">Berita</a>
      </nav>

      <div class="socials">
        <span>○</span>
        <span>◎</span>
        <span>𝕏</span>
        <span>in</span>
        <span>▶</span>
      </div>
    </div>

    <div class="footer-bottom">
      <p>© <?php echo date('Y'); ?> Universitas Brawijaya. All rights reserved.</p>

      <div class="footer-links">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">Cookie Settings</a>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>