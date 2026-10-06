# E-Procurement Backend

Backend Laravel yang sudah terhubung dengan Blade frontend dan alur:

`PR -> Approval L1/L2 -> RFQ -> Quotation -> Evaluasi -> PO -> Otorisasi -> GR -> Invoice -> 3-Way Matching`

## Menjalankan di VS Code

1. Extract ZIP lalu buka folder `eprocurement-backend` di VS Code.
2. Pastikan PHP 8.3+, Composer, Node.js, dan SQLite tersedia.
3. Jalankan:

```bash
composer install
npm install
php artisan migrate:fresh --seed
npm run build
php artisan serve
```

Buka `http://127.0.0.1:8000/login`.

## Akun demo

Semua password: `password`

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

## Catatan implementasi

- Database default menggunakan SQLite pada `.env` agar langsung bisa dijalankan.
- Upload PDF quotation dan invoice disimpan di `storage/app/public`.
- Role middleware menggunakan field `users.role`.
- Nilai PR lebih dari Rp50.000.000 otomatis membutuhkan approval L1 lalu L2.
- Invoice dianggap cocok bila nominal sama dengan PO dan sudah ada GR berstatus `verified`.
- Untuk production, ganti password demo, `APP_DEBUG=false`, dan gunakan storage/database production.
