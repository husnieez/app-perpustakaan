{{-- File: resources/views/members/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tambah Anggota')

@section('content')
    <h1 style="margin-bottom: 8px;">Tambah Anggota</h1>

    <p style="margin-bottom: 24px;">
        <a href="{{ route('members.index') }}" class="btn" style="background: #64748b;">&larr; Kembali ke daftar anggota</a>
    </p>

    <!-- Alert Error Validasi -->
    @if ($errors->any())
        <div class="alert-danger">
            <ul style="margin: 0; padding-left: 18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('members.store') }}" method="POST" class="form-card">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label for="nama">Nama <span class="required">*</span></label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="form-group">
                <label for="nim">NIM <span class="required">*</span></label>
                <input type="text" name="nim" id="nim" value="{{ old('nim') }}" placeholder="Contoh: 3125600064" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="email">Email <span class="required">*</span></label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
            </div>

            <div class="form-group">
                <label for="telepon">Telepon <span class="required">*</span></label>
                <input type="text" name="telepon" id="telepon" value="{{ old('telepon') }}" placeholder="08xxxxxxxxxx" required>
            </div>
        </div>

        <div class="form-group">
            <label for="status">Status <span class="required">*</span></label>
            <select name="status" id="status" required>
                <option value="">-- Pilih Status --</option>
                <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" rows="3" placeholder="Masukkan alamat domisili">{{ old('alamat') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan Data Anggota</button>
    </form>
@endsection