@extends('layouts.app')

@section('title', 'Daftar Peminjaman')

@section('content')
    <h1 style="margin-bottom: 8px;">Daftar Peminjaman</h1>

    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <p style="margin-bottom: 20px;">
        <a href="{{ route('loans.create') }}" class="btn btn-primary">+ Tambah Peminjaman</a>
    </p>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Anggota</th>
                    <th>Petugas</th>
                    <th>Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($loans as $loan)
                    <tr>
                        <td>{{ $loan['id'] }}</td>
                        <td>{{ $loan['member']['nama'] ?? '-' }}</td>
                        <td>{{ $loan['user']['name'] ?? '-' }}</td>
                        <td>
                            @foreach ($loan['loanItems'] as $item)
                                {{ $item['book']['judul'] ?? '-' }}@if (!$loop->last), @endif
                            @endforeach
                        </td>
                        <td>{{ $loan['tanggal_pinjam'] }}</td>
                        <td>{{ $loan['tanggal_kembali'] }}</td>
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
                        <td>
                            <div class="action-buttons">
                                @if ($loan['status'] === 'dipinjam')
                                    <form class="inline" action="{{ route('loans.kembalikan', $loan['id']) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn-action btn-success" onclick="return confirm('Apakah Anda yakin buku ini sudah dikembalikan?')">Kembalikan</button>
                                    </form>
                                @endif
                                <a href="{{ route('loans.show', $loan['id']) }}" class="btn-action btn-info">Detail</a>
                                <a href="{{ route('loans.edit', $loan['id']) }}" class="btn-action btn-warning">Edit</a>
                                <form class="inline" action="{{ route('loans.destroy', $loan['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-danger" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center; color: #64748b; padding: 24px;">Belum ada data peminjaman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 16px;">
        {{ $loans->links() }}
    </div>
@endsection
