# RaultMovie_12v1

RaultMovie_12v1 adalah proyek website informasi film yang dibuat dengan Laravel 12 dan Tailwind CSS 4. Proyek ini dikembangkan sebagai tugas akhir PKL dan terinspirasi dari tutorial YouTube @develobe_id.

## Fitur
- Menampilkan daftar film dan detailnya
- Pencarian film (akan ditambahkan)
- Wishlist untuk menyimpan film favorit (akan ditambahkan)
- UI responsif dengan Tailwind CSS 4

## Instalasi
1. Clone repository ini:
   ```sh
   git clone https://github.com/ryglearn/RaultMovie_12v1.git
   cd RaultMovie_12v1
   ```

2. Install dependensi PHP dan Node.js:
   ```sh
   composer install
   npm install
   ```

3. Copy file `.env` dan atur konfigurasi database:
   ```sh
   cp .env.example .env
   php artisan key:generate
   ```

4. Jalankan migrasi database:
   ```sh
   php artisan migrate
   ```

5. Jalankan aplikasi:
   ```sh
   php artisan serve
   npm run dev
   ```
   Atau bisa menggunakan perintah alternatif:
   ```sh
   composer run dev
   ```

## Kontribusi
Jika ingin berkontribusi, silakan fork repository ini dan buat pull request.

## Lisensi
Proyek ini menggunakan lisensi [MIT](LICENSE).

