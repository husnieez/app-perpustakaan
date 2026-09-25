{{-- File: resources/views/books/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
    @include('partials.alert')
    <h1>Tambah Buku</h1>

    <p><a href="{{ route('books.index') }}" class="btn">&larr; Kembali ke daftar buku</a></p>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <p>
            <label for="judul">Judul</label><br>
            <input type="text" name="judul" id="judul" value="{{ old('judul') }}">
            @error('judul')
                <br><span class="error">{{ $message }}</span>
            @enderror
        </p>

        <p>
            <label for="penulis">Penulis</label><br>
            <input type="text" name="penulis" id="penulis" value="{{ old('penulis') }}">
            @error('penulis')
                <br><span class="error">{{ $message }}</span>
            @enderror
        </p>

        <p>
            <label for="penerbit">Penerbit</label><br>
            <input type="text" name="penerbit" id="penerbit" value="{{ old('penerbit') }}">
            @error('penerbit')
                <br><span class="error">{{ $message }}</span>
            @enderror
        </p>

        <p>
            <label for="tahun_terbit">Tahun Terbit</label><br>
            <input type="number" name="tahun_terbit" id="tahun_terbit" value="{{ old('tahun_terbit') }}">
            @error('tahun_terbit')
                <br><span class="error">{{ $message }}</span>
            @enderror
        </p>

        <p>
            <label for="isbn">ISBN (opsional)</label><br>
            <input type="text" name="isbn" id="isbn" value="{{ old('isbn') }}">
            @error('isbn')
                <br><span class="error">{{ $message }}</span>
            @enderror
        </p>

        <p>
            <label for="stok">Stok</label><br>
            <input type="number" name="stok" id="stok" value="{{ old('stok', 1) }}">
            @error('stok')
                <br><span class="error">{{ $message }}</span>
            @enderror
        </p>

        <p>
            <label for="category_id">Kategori</label><br>
            <select name="category_id" id="category_id">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category['id'] }}" @selected(old('category_id') == $category['id'])>
                        {{ $category['nama_kategori'] }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <br><span class="error">{{ $message }}</span>
            @enderror
        </p>

        <button type="submit" class="btn">Simpan</button>
    </form>
@endsection