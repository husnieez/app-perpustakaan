{{-- File: resources/views/categories/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
    <h1 style="margin-bottom: 8px;">Tambah Kategori</h1>

    <p style="margin-bottom: 24px;">
        <a href="{{ route('categories.index') }}" class="btn" style="background: #64748b;">&larr; Kembali ke daftar kategori</a>
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

    <form action="{{ route('categories.store') }}" method="POST" class="form-card">
        @csrf

        <div class="form-group">
            <label for="nama_kategori">Nama Kategori <span class="required">*</span></label>
            <input type="text" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori') }}" placeholder="Masukkan nama kategori" required>
            @error('nama_kategori')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi (opsional)</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" placeholder="Masukkan deskripsi singkat kategori">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan Kategori</button>
    </form>
@endsection