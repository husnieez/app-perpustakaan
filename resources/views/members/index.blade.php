{{-- File: resources/views/members/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('content')
    <h1 style="margin-bottom: 8px;">Daftar Anggota</h1>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <a href="{{ route('members.create') }}" class="btn btn-primary">+ Tambah Anggota</a>
        
        <form action="{{ route('members.index') }}" method="GET" class="search-form" style="margin-bottom: 0;">
            <input type="text" name="search" class="search-input" placeholder="Cari nama anggota..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary">Cari</button>
        </form>
    </div>

    @include('partials.alert')

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Status</th>
                    <th style="width: 180px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($members as $index => $member)
                    <tr>
                        <td>{{ $members->firstItem() + $index }}</td>
                        <td>{{ $member->nim }}</td>
                        <td>{{ $member->nama }}</td>
                        <td>{{ $member->email }}</td>
                        <td>{{ $member->nomor_telepon ?? $member->telepon ?? '-' }}</td>
                        <td>
                            <span class="badge {{ strtolower($member->status) == 'aktif' ? 'badge-success' : 'badge-danger' }}">
                                {{ ucfirst($member->status) }}
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <div class="action-buttons">
                                {{-- 1. Tombol Detail --}}
                                <a href="{{ route('members.show', $member->id) }}" class="btn-action btn-info">
                                    Detail
                                </a>
                                
                                {{-- 2. Tombol Edit (Navigasi Halaman Edit) --}}
                                <a href="{{ route('members.edit', $member->id) }}" class="btn-action btn-warning">
                                    Edit
                                </a>
                                
                                {{-- 3. Form Hapus (Hanya untuk tombol Hapus) --}}
                                <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; color: #64748b; padding: 20px;">Data anggota tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 16px;">
        {{ $members->links() }}
    </div>
@endsection