{{-- File: resources/views/categories/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')
    @include('partials.alert')
    <h1>Tambah Kategori</h1>

    <p><a href="{{ route('categories.index') }}" class="btn">&larr; Kembali ke daftar kategori</a></p>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <p>
            <label for="nama_kategori">Nama Kategori</label><br>
            <input type="text" name="nama_kategori" id="nama_kategori"
                   value="{{ old('nama_kategori') }}">
            @error('nama_kategori')
                <br><span class="error">{{ $message }}</span>
            @enderror
        </p>

        <p>
            <label for="deskripsi">Deskripsi (opsional)</label><br>
            <textarea name="deskripsi" id="deskripsi" rows="4">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <br><span class="error">{{ $message }}</span>
            @enderror
        </p>

        <button type="submit" class="btn">Simpan</button>
    </form>
@endsection