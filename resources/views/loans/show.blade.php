@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
    <h1 style="margin-bottom: 8px;">Detail Peminjaman</h1>

    <p style="margin-bottom: 24px;">
        <a href="{{ route('loans.index') }}" class="btn" style="background: #64748b;">&larr; Kembali ke daftar peminjaman</a>
        <a href="{{ route('loans.edit', $loan['id']) }}" class="btn" style="background: #d97706; margin-left: 8px;">Edit Peminjaman</a>
    </p>

    <div class="form-card" style="margin-bottom: 24px;">
        <div class="form-row">
            <div class="form-group">
                <label>Anggota</label>
                <div class="detail-value">{{ $loan['member']['nama'] ?? '-' }} ({{ $loan['member']['nim'] ?? '-' }})</div>
            </div>

            <div class="form-group">
                <label>Petugas</label>
                <div class="detail-value">{{ $loan['user']['name'] ?? '-' }}</div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Tanggal Pinjam</label>
                <div class="detail-value">{{ $loan['tanggal_pinjam'] }}</div>
            </div>

            <div class="form-group">
                <label>Tanggal Kembali</label>
                <div class="detail-value">{{ $loan['tanggal_kembali'] }}</div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Tanggal Dikembalikan</label>
                <div class="detail-value">{{ $loan['tanggal_dikembalikan'] ?? '-' }}</div>
            </div>

            <div class="form-group">
                <label>Status</label>
                <div>
                    @if ($loan['status'] === 'dikembalikan')
                        <span class="badge badge-success">Dikembalikan</span>
                    @elseif ($loan['status'] === 'dipinjam')
                        <span class="badge badge-warning">Dipinjam</span>
                    @elseif ($loan['status'] === 'terlambat')
                        <span class="badge badge-danger">Terlambat</span>
                    @else
                        <span class="badge">{{ ucfirst($loan['status']) }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <h2>Buku yang Dipinjam</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Kategori</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($loan['loanItems'] as $item)
                    <tr>
                        <td><strong>{{ $item['book']['judul'] ?? '-' }}</strong></td>
                        <td>{{ $item['book']['penulis'] ?? '-' }}</td>
                        <td>{{ $item['book']['penerbit'] ?? '-' }}</td>
                        <td>{{ $item['book']['category']['nama_kategori'] ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; color: #64748b; padding: 16px;">Tidak ada item buku.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
