{{-- File: resources/views/books/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <h1 style="margin-bottom: 8px;">Tambah Buku</h1>

    <p style="margin-bottom: 24px;">
        <a href="{{ route('books.index') }}" class="btn" style="background: #64748b;">&larr; Kembali ke daftar buku</a>
    </p>

    <!-- Alert Success/Error dari partials -->
    @include('partials.alert')

    <!-- Alert Error Validasi Ringkasan -->
    @if ($errors->any())
        <div class="alert-danger">
            <ul style="margin: 0; padding-left: 18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.store') }}" method="POST" class="form-card">
        @csrf

        <div class="form-group">
            <label for="judul">Judul Buku <span class="required">*</span></label>
            <input type="text" name="judul" id="judul" value="{{ old('judul') }}" placeholder="Masukkan judul buku" required>
            @error('judul')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="penulis">Penulis <span class="required">*</span></label>
                <input type="text" name="penulis" id="penulis" value="{{ old('penulis') }}" placeholder="Nama penulis" required>
                @error('penulis')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="penerbit">Penerbit <span class="required">*</span></label>
                <input type="text" name="penerbit" id="penerbit" value="{{ old('penerbit') }}" placeholder="Nama penerbit" required>
                @error('penerbit')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="tahun_terbit">Tahun Terbit <span class="required">*</span></label>
                <input type="number" name="tahun_terbit" id="tahun_terbit" value="{{ old('tahun_terbit') }}" placeholder="Contoh: 2024" required>
                @error('tahun_terbit')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="isbn">ISBN (opsional)</label>
                <input type="text" name="isbn" id="isbn" value="{{ old('isbn') }}" placeholder="Masukkan nomor ISBN">
                @error('isbn')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="stok">Stok <span class="required">*</span></label>
                <input type="number" name="stok" id="stok" value="{{ old('stok', 1) }}" min="0" required>
                @error('stok')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Kategori <span class="required">*</span></label>
                <select name="category_id" id="category_id" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category['id'] }}" @selected(old('category_id') == $category['id'])>
                            {{ $category['nama_kategori'] }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Buku</button>
    </form>
@endsection