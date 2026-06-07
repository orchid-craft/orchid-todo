# OrchidTodo

<p align="center">
  <img src="public/favicon.svg" width="96" height="96" alt="OrchidTodo icon">
</p>

OrchidTodo adalah aplikasi todo list berbasis Laravel untuk mengelola task harian dengan dashboard reaktif, kategori, status, pencarian, dan trash management.

## Fitur Utama

- Autentikasi pengguna menggunakan Laravel Breeze, Livewire, dan Volt.
- Dashboard task reaktif tanpa full-page reload.
- Tambah task dengan kategori `personal`, `work`, `shopping`, dan `health`.
- Filter task berdasarkan status: semua, pending, dan completed.
- Filter task berdasarkan kategori.
- Pencarian task real-time dengan debounce.
- Statistik total task, pending task, dan completed task.
- Soft delete, trash bin, restore task, dan hapus permanen.
- Pagination untuk daftar task.

## Tech Stack

- PHP 8.2+
- Laravel 11
- Livewire 3
- Livewire Volt
- Laravel Breeze
- Tailwind CSS
- Vite
- SQLite secara default dari `.env.example`

## Struktur Penting

- `app/Livewire/TodoList.php` berisi state, validasi, filter, trash mode, dan query todo.
- `resources/views/livewire/todo-list.blade.php` berisi tampilan dashboard todo.
- `resources/views/welcome.blade.php` berisi landing page OrchidTodo.
- `resources/views/components/application-logo.blade.php` berisi logo aplikasi.
- `public/favicon.svg` berisi icon browser untuk OrchidTodo.
- `database/migrations/*todos*` berisi struktur tabel todo, kategori, dan soft delete.

## Instalasi

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

Jalankan aplikasi dan Vite:

```bash
composer run dev
```

Alternatif jika ingin menjalankan proses secara terpisah:

```bash
php artisan serve
npm run dev
```

## Konfigurasi

Nama aplikasi sudah diarahkan ke `OrchidTodo` pada `.env.example`. Jika `.env` lokal masih memakai nama lama, ubah nilai berikut:

```env
APP_NAME=OrchidTodo
```

Default database di `.env.example` adalah SQLite. Untuk PostgreSQL atau MySQL, ubah `DB_CONNECTION` dan kredensial database di `.env`, lalu jalankan ulang migrasi.

## Perintah Berguna

```bash
php artisan migrate
npm run build
php artisan test
```

## Lisensi

Project ini menggunakan lisensi MIT.
