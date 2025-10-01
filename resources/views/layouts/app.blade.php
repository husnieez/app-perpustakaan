{{-- File: resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Perpustakaan Digital Kampus')</title>

    <style>
        * { box-sizing: border-box; }
        body { font-family: sans-serif; margin: 0; color: #1f2937; }
        nav { background: #1e3a8a; padding: 14px 40px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; }
        nav .brand { color: #fff; font-weight: bold; font-size: 18px; }
        nav ul { list-style: none; display: flex; gap: 20px; margin: 0; padding: 0; }
        nav ul li a { color: #cbd5e1; text-decoration: none; padding: 6px 4px; }
        nav ul li a.active { color: #fff; font-weight: bold; border-bottom: 2px solid #fff; }

        /* File: resources/views/layouts/app.blade.php - di dalam <style>, setelah aturan nav ul li a.active */
        nav .navbar-user { display: flex; align-items: center; gap: 12px; color: #cbd5e1; font-size: 14px; }
        nav .btn-logout { background: none; border: 1px solid #cbd5e1; color: #cbd5e1; padding: 4px 10px; border-radius: 4px; cursor: pointer; font-size: 14px; }
        nav .btn-logout:hover { background: #1e40af; color: #fff; }
        
        main { max-width: 900px; margin: 0 auto; padding: 30px 40px; }
        table { border-collapse: collapse; width: 100%; margin-top: 16px; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        .alert-success { background: #d1fae5; color: #065f46; padding: 10px 14px; border-radius: 4px; margin-bottom: 16px; }
        .btn { display: inline-block; padding: 6px 14px; background: #2563eb; color: #fff; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; }
        form.inline { display: inline; }
        footer { text-align: center; padding: 20px; color: #6b7280; font-size: 14px; border-top: 1px solid #e5e7eb; margin-top: 40px; }
        .search-form { margin-bottom: 20px; display: flex; gap: 8px; }
        .search-input { flex: 1; padding: 8px; border: 1px solid #ccc; border-radius: 4px; }
        
        /* Card Container untuk Form */
        .form-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            max-width: 800px;
        }

        /* Mengatur Layout 2 Kolom Sejajar */
        .form-row {
            display: flex;
            gap: 16px;
        }

        .form-row .form-group {
            flex: 1;
        }

        /* Mengatur Jarak & Penataan Label-Input Vertikal */
        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 18px;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }

        .form-group label .required {
            color: #ef4444;
        }

        /* Mengatur Tampilan Input, Select, & Textarea */
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="number"],
        .form-group input[type="password"],
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px 12px;
            font-size: 14px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            background-color: #fff;
            transition: border-color 0.2s, box-shadow 0.2s;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        /* Tombol Utama */
        .btn-primary {
            background: #2563eb;
            color: #ffffff;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        /* Alert Error */
        .alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        /* Responsive Mobile */
        @media (max-width: 640px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
        
        .detail-value {
            padding: 8px 12px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 14px;
            color: #1e293b;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success, .badge-dikembalikan {
            background-color: #dcfce7;
            color: #15803d;
        }

        .badge-info {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .badge-warning, .badge-dipinjam {
            background-color: #fef3c7;
            color: #b45309;
        }

        .badge-danger, .badge-terlambat {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .btn-success {
            background-color: #16a34a;
            color: #ffffff;
        }
        .btn-success:hover {
            background-color: #15803d;
        }

        /* Container Pembungkus Tabel agar Rapi */
        .table-container {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 0;
        }

        th {
            background-color: #f8fafc;
            color: #475569;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 12px 16px;
            border-bottom: 2px solid #e2e8f0;
        }

        td {
            padding: 12px 16px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
            color: #334155;
            vertical-align: middle;
        }

        tr:hover {
            background-color: #f8fafc;
        }

        /* Flexbox untuk Barisan Tombol Aksi */
        .action-buttons {
            display: inline-flex;
            gap: 6px;
            align-items: center;
            justify-content: center;
        }

        /* Styling Dasar Tombol Aksi */
        .btn-action {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 4px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            line-height: 1.2;
        }

        /* Opsi Detail (Biru Muda / Info) */
        .btn-info {
            background-color: #0284c7;
            color: #ffffff;
        }
        .btn-info:hover {
            background-color: #0369a1;
        }

        /* Opsi Edit (Kuning / Warning) */
        .btn-warning {
            background-color: #d97706;
            color: #ffffff;
        }
        .btn-warning:hover {
            background-color: #b45309;
        }

        /* Opsi Hapus (Merah / Danger) */
        .btn-danger {
            background-color: #dc2626;
            color: #ffffff;
        }
        .btn-danger:hover {
            background-color: #b91c1c;
        }

        /* Tombol Sekunder (Kembali / Cari) */
        .btn-secondary {
            background-color: #64748b;
            color: #ffffff;
        }
        .btn-secondary:hover {
            background-color: #475569;
        }
    </style>
</head>
<body>
    @include('partials.navbar')

    <main>
        {{-- BARIS @include('partials.alert') DIHAPUS DARI SINI SUPAYA NOTIFIKASI TIDAK GANDA --}}

        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} Sistem Perpustakaan Digital Kampus
    </footer>
</body>
</html>