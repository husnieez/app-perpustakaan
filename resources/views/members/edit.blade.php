@extends('layouts.app')

@section('title', 'Edit Anggota')

@section('content')
    <h1 style="margin-bottom: 8px;">Edit Data Anggota</h1>

    <p style="margin-bottom: 24px;">
        <a href="{{ route('members.index') }}" class="btn" style="background: #64748b;">&larr; Kembali ke daftar anggota</a>
    </p>

    @include('partials.alert')

    @if ($errors->any())
        <div class="alert-danger">
            <ul style="margin: 0; padding-left: 18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('members.update', $member->id) }}" method="POST" class="form-card">
        @csrf
        @method('PUT')

        <div class="form-row">
            <div class="form-group">
                <label for="nama">Nama <span class="required">*</span></label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $member->nama) }}" required>
                @error('nama')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nim">NIM <span class="required">*</span></label>
                <input type="text" name="nim" id="nim" value="{{ old('nim', $member->nim) }}" required>
                @error('nim')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="email">Email <span class="required">*</span></label>
                <input type="email" name="email" id="email" value="{{ old('email', $member->email) }}" required>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="telepon">Telepon <span class="required">*</span></label>
                <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $member->nomor_telepon ?? $member->telepon) }}" required>
                @error('telepon')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="status">Status <span class="required">*</span></label>
            <select name="status" id="status" required>
                <option value="">-- Pilih Status --</option>
                <option value="aktif" {{ old('status', strtolower($member->status)) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ old('status', strtolower($member->status)) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
            @error('status')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" rows="3">{{ old('alamat', $member->alamat) }}</textarea>
            @error('alamat')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Perbarui Data Anggota</button>
    </form>
@endsection