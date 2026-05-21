# KST WordPress Landing — Theme README

Ringkasan singkat dan langkah untuk deploy / sinkronisasi tema ini.

## Apa yang harus di-push ke GitHub

- Hanya commit kode sumber tema ini: `wp-content/themes/kst-wordpress-landing`.
- Jika Anda membuat plugin kustom untuk fitur tambahan, commit juga di `wp-content/plugins/<plugin-name>`.
- Jangan commit core WordPress (`wp-admin`, `wp-includes`, root files) atau file konfigurasi yang sensitif (`wp-config.php`).
- Jangan commit `wp-content/uploads/` (media) — transfer media secara terpisah.

## Advanced Custom Fields (ACF)

- Field groups untuk Hero dan Detail KST diregistrasi secara lokal di `functions.php` (ACF local field groups). Itu berarti: jika ACF aktif di instalasi target, metabox akan terpasang otomatis.
- **Namun**: plugin ACF sendiri TIDAK disertakan di repo ini. Anda harus menginstal/aktifkan ACF di target.

### Menginstal ACF (gratis) via WP-CLI

```bash
wp plugin install advanced-custom-fields --activate
```

Jika Anda menggunakan ACF Pro (berbayar), jangan upload kode Pro ke repo publik. Instal manual pada server target atau gunakan private storage.

## Migrasi konten (posts, ACF values, media)

- Kode tema (post types dan field group registration) cukup dipindahkan bersama tema.
- Data posting dan nilai ACF (postmeta) perlu diekspor/import dari database target. Pilihan:
  - WordPress Admin: Tools → Export → pilih `kst`, `produk`, `berita` → di target gunakan Tools → Import → WordPress.
  - WP-CLI export/import:
    ```bash
    wp export --post_type=kst --dir=wp-content/exports
    wp export --post_type=produk --dir=wp-content/exports
    wp export --post_type=berita --dir=wp-content/exports
    # Di target: wp import file.xml --authors=create
    ```
- Media (uploads) bisa dipindahkan dengan rsync/FTP atau plugin migrasi. Contoh rsync:

```bash
rsync -avz --progress /path/to/source/wp-content/uploads/ user@target:/path/to/target/wp-content/uploads/
```

## .gitignore rekomendasi (jika Anda commit dari repo root)

Tambahkan minimal ini ke `.gitignore`:

```
/wp-admin/
/wp-includes/
/wp-config.php
/wp-content/uploads/
/node_modules/
/vendor/
.env
.DS_Store
```

Jika Anda hanya ingin repo tema, inisialisasi git di dalam `wp-content/themes/kst-wordpress-landing` sehingga `.gitignore` global di root tidak dibutuhkan.

## Langkah cepat untuk deploy theme ke instalasi target

1. Push theme ke GitHub dari folder tema.
2. Di target server: clone repo ke `wp-content/themes/`.
3. Aktifkan theme di Appearance → Themes.
4. Install & aktifkan ACF (lihat perintah WP-CLI di atas).
5. Import konten (Tools → Import) atau gunakan WP-CLI exports.

## Catatan penting

- Field group ada di `functions.php` jadi tidak perlu export ACF groups, tetapi nilai yang sudah disimpan pada post (postmeta) harus dimigrasi.
- Jika homepage tidak menampilkan perubahan ACF, cek: Settings → Reading (static page), cache plugin, atau apakah tema lain/front-page.php mengoverride.

---

Jika mau, saya bisa: membuat `.gitignore` di root atau inisialisasi git di folder tema dan menyiapkan commit awal. Mau saya lanjutkan?

## Bekerja Bersama Tim (LocalWP + Clone Repo)

Panduan ini membantu rekan tim menyiapkan lingkungan lokal menggunakan LocalWP (Local by Flywheel) dan clone repo:

1. Install LocalWP

- Download dari https://localwp.com/ dan instal sesuai OS.

2. Buat site baru di LocalWP

- Buka Local → "Create a new site" → beri nama (mis. `kst-local`) → pilih environment (Preferred biasanya cukup) → selesai.
- Setelah site dibuat, klik "Open Site Folder" untuk menemukan path ke `app/public` (tempat WordPress berada).

3. Pasang theme dari repo

- Buka folder site: `.../Local Sites/<site>/app/public/wp-content/themes/`.
- Clone repo ke dalam folder `themes`:

```bash
cd "<path-to-site>/app/public/wp-content/themes/"
git clone https://github.com/Capstone-Project-D1/kst-wordpress-landing.git kst-wordpress-landing
```

- Atau clone di mesin Anda lalu salin folder `kst-wordpress-landing` ke folder `themes` site Local.

4. Aktifkan theme

- Masuk ke WordPress Admin (`http://<site>.local/wp-admin`), Appearance → Themes → aktifkan `kst-wordpress-landing`.

5. Pasang Advanced Custom Fields (ACF)

- Di WordPress Admin → Plugins → Add New → cari "Advanced Custom Fields" lalu Install & Activate.
- Atau gunakan WP-CLI (jika tersedia):

```bash
wp plugin install advanced-custom-fields --activate
```

6. Import konten (opsional)

- Jika Anda perlu data posting yang dibuat oleh tim, gunakan Tools → Import / Export atau WP-CLI export/import seperti dijelaskan di atas.

7. Sinkronisasi media

- Untuk media, salin `wp-content/uploads/` dari sumber atau gunakan plugin migrasi/rsync.

8. Tips kolaborasi & Git

- Kerjakan perubahan tema di dalam folder `wp-content/themes/kst-wordpress-landing`.
- Commit & push perubahan ke `https://github.com/Capstone-Project-D1/kst-wordpress-landing.git`.
- Rekan tim cukup clone repo ke folder `themes` pada site Local masing-masing.
- Jangan commit `wp-content/uploads/`, `wp-config.php`, atau core WordPress.

9. Troubleshooting cepat

- Jika ACF field tidak muncul: pastikan plugin ACF aktif dan theme sudah di-reload/aktifkan ulang.
- Jika Homepage tidak menampilkan perubahan: Settings → Reading (pastikan static page yang benar), clear cache plugin, dan flush permalinks (Settings → Permalinks → Save Changes).

10. Perhatian lisensi

- Jika menggunakan ACF Pro, jangan taruh file Pro di repo publik. Rekan harus memasang ACF Pro sendiri (upload zip atau melalui license mechanism).

Jika mau, saya bisa juga membuat `.gitignore` rekomendasi di root repo atau menyiapkan instruksi singkat untuk workflow git (branching convention) untuk tim. Mau saya tambahkan juga?
