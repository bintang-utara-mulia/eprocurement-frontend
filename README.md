# E-Procurement Backend

Backend Laravel yang sudah dipisahkan dari frontend. Aplikasi ini hanya menyediakan JSON API; Blade, CSS, JavaScript, dan gambar frontend berada di folder `../eprocurement-frontend`.

## Menjalankan backend

Prasyarat: PHP 8.3+, Composer, dan SQLite.

```bash
composer install
cp .env.example .env   # jika .env belum ada
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve
```

Backend berjalan di `http://127.0.0.1:8000`.

Tes cepat: `curl http://127.0.0.1:8000/api/health`.

## Endpoint utama

- `POST /api/login`, `GET /api/me`, `POST /api/logout`
- `GET /api/dashboard`
- `GET|POST /api/prs`; `GET /api/prs/approvals/{level}`; `POST /api/prs/{pr}/decision`
- `GET|POST /api/rfqs`
- `POST /api/quotations`; `POST /api/quotations/{quotation}/winner`
- `GET|POST /api/purchase-orders`; `POST /api/purchase-orders/{po}/decision`
- `POST /api/goods-receipts`
- `GET|POST /api/invoices`; `POST /api/invoices/{invoice}/verify`
- `GET /api/items`, `GET /api/departments`, `GET /api/users` untuk admin

Login memakai session cookie Laravel. Frontend terpisah harus mengirim cookie (`credentials: 'include'` pada Fetch/Axios) dan header `Accept: application/json`.

## Akun demo

Semua password: `password`.

| Role | Email |
|---|---|
| Admin | admin@eproc.test |
| User Internal | user@eproc.test |
| Supervisor | supervisor@eproc.test |
| Management | management@eproc.test |
| Procurement | procurement@eproc.test |
| Vendor | vendor@eproc.test |
| Pejabat Keuangan | finance.auth@eproc.test |
| Petugas Gudang | warehouse@eproc.test |
| Unit Keuangan | finance@eproc.test |

## Catatan

- Database default menggunakan SQLite agar langsung dapat dijalankan.
- Upload PDF quotation dan invoice disimpan di `storage/app/public`.
- `routes/api.php` adalah route aplikasi; tidak ada lagi route/view Blade di backend.
- Untuk production, ganti password demo, `APP_DEBUG=false`, dan gunakan database/storage production.
