@extends('layouts.app')

@section('title', 'Detail Anggota')

@section('content')
    <h1 style="margin-bottom: 8px;">Detail Anggota</h1>

    <p style="margin-bottom: 24px;">
        <a href="{{ route('members.index') }}" class="btn" style="background: #64748b;">&larr; Kembali ke daftar anggota</a>
        <a href="{{ route('members.edit', $member->id) }}" class="btn" style="background: #f59e0b; margin-left: 8px;">Edit Data</a>
    </p>

    <div class="form-card">
        <div class="form-row">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <div class="detail-value">{{ $member->nama }}</div>
            </div>

            <div class="form-group">
                <label>NIM</label>
                <div class="detail-value">{{ $member->nim }}</div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Email</label>
                <div class="detail-value">{{ $member->email }}</div>
            </div>

            <div class="form-group">
                <label>Nomor Telepon</label>
                <div class="detail-value">{{ $member->nomor_telepon ?? $member->telepon ?? '-' }}</div>
            </div>
        </div>

        <div class="form-group">
            <label>Status Anggota</label>
            <div>
                <span class="badge {{ strtolower($member->status) == 'aktif' ? 'badge-success' : 'badge-danger' }}">
                    {{ ucfirst($member->status) }}
                </span>
            </div>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <div class="detail-value">{{ $member->alamat ?? '-' }}</div>
        </div>
    </div>

    <h2 style="margin-top: 32px;">Riwayat Peminjaman</h2>
    <p><em>Diambil lewat relasi <code>$member->loans</code> - satu anggota bisa punya banyak transaksi peminjaman.</em></p>

    <table>
        <thead>
            <tr>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Petugas</th>
                <th>Buku</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($member['loans'] as $loan)
                <tr>
                    <td>{{ $loan['tanggal_pinjam'] }}</td>
                    <td>{{ $loan['tanggal_kembali'] }}</td>
                    <td>{{ $loan['user']['name'] ?? '-' }}</td>
                    <td>
                        @foreach ($loan['loanItems'] as $item)
                            {{ $item['book']['judul'] }}@if (!$loop->last), @endif
                        @endforeach
                    </td>
                    <td>
                        @if ($loan['status'] === 'dikembalikan')
                            <span class="badge badge-success">Dikembalikan</span>
                        @elseif ($loan['status'] === 'dipinjam')
                            <span class="badge badge-warning">Dipinjam</span>
                        @elseif ($loan['status'] === 'terlambat')
                            <span class="badge badge-danger">Terlambat</span>
                        @else
                            <span class="badge">{{ ucfirst($loan['status']) }}</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Anggota ini belum pernah meminjam buku.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection