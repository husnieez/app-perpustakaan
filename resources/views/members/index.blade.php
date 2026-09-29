{{-- File: resources/views/members/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('content')
    <h1>Daftar Anggota</h1>

    <form action="{{ route('members.index') }}" method="GET" class="search-form">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama anggota..." class="search-input">
        <button type="submit" class="btn">Cari</button>
    </form>

    <p><a href="{{ route('members.create') }}" class="btn">+ Tambah Anggota</a></p>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($members as $member)
                <tr>
                    <td>{{ $member['id'] }}</td>
                    <td>{{ $member['nama'] }}</td>
                    <td>{{ $member['nim'] }}</td>
                    <td>{{ $member['email'] }}</td>
                    <td>{{ $member['nomor_telepon'] }}</td>
                    <td>{{ ucfirst($member['status']) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada data anggota.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
     {{-- Pagination dengan query search tetap terbawa --}}
    {{ $members->appends(request()->query())->links() }}
@endsection