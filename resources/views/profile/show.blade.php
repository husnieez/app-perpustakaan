{{-- File: resources/views/profile/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Profil - Perpustakaan Digital Kampus')

@section('content')
    <h1>Profil Petugas</h1>

    @include('partials.alert')

    {{-- Informasi Profil --}}
    <div class="form-card" style="margin-bottom: 24px;">
        <h2 style="margin-top: 0; font-size: 18px; color: #1e3a8a;">Informasi Akun</h2>

        <div class="form-group">
            <label>Nama</label>
            <div class="detail-value">{{ $user->name }}</div>
        </div>

        <div class="form-group">
            <label>Email</label>
            <div class="detail-value">{{ $user->email }}</div>
        </div>

        <div class="form-group">
            <label>Role</label>
            <div class="detail-value">
                <span class="badge {{ $user->role === 'admin' ? 'badge-success' : 'badge-info' }}">
                    {{ ucfirst($user->role) }}
                </span>
            </div>
        </div>
    </div>

    {{-- Form Ganti Password --}}
    <div class="form-card">
        <h2 style="margin-top: 0; font-size: 18px; color: #1e3a8a;">Ganti Password</h2>

        <form action="{{ route('profil.password') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="current_password">Password Lama <span class="required">*</span></label>
                <input type="password" name="current_password" id="current_password">
                @error('current_password')
                    <div class="error" style="color: #b91c1c; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password Baru <span class="required">*</span></label>
                <input type="password" name="password" id="password">
                @error('password')
                    <div class="error" style="color: #b91c1c; font-size: 14px; margin-top: 4px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password Baru <span class="required">*</span></label>
                <input type="password" name="password_confirmation" id="password_confirmation">
            </div>

            <button type="submit" class="btn-primary">Ubah Password</button>
        </form>
    </div>
@endsection
