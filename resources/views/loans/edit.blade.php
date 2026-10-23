@extends('layouts.app')

@section('title', 'Edit Peminjaman')

@section('content')
    <h1 style="margin-bottom: 8px;">Edit Peminjaman</h1>

    <p style="margin-bottom: 24px;">
        <a href="{{ route('loans.index') }}" class="btn" style="background: #64748b;">&larr; Kembali ke daftar peminjaman</a>
    </p>

    @if ($errors->any())
        <div class="alert-danger">
            <ul style="margin: 0; padding-left: 18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-card">
        <div class="form-row">
            <div class="form-group">
                <label>Anggota</label>
                <div class="detail-value">{{ $loan['member']['nama'] ?? '-' }} ({{ $loan['member']['nim'] ?? '-' }})</div>
            </div>

            <div class="form-group">
                <label>Petugas</label>
                <div class="detail-value">{{ $loan['user']['name'] ?? '-' }}</div>
            </div>
        </div>

        <div class="form-group">
            <label>Buku yang Dipinjam</label>
            <div class="detail-value">
                @foreach ($loan['loanItems'] as $item)
                    {{ $item['book']['judul'] ?? '-' }}@if (!$loop->last), @endif
                @endforeach
            </div>
        </div>

        <form action="{{ route('loans.update', $loan['id']) }}" method="POST" style="margin-top: 16px;">
            @csrf
            @method('PUT')

            <input type="hidden" name="tanggal_pinjam" value="{{ $loan['tanggal_pinjam'] }}">

            <div class="form-group">
                <label for="tanggal_kembali">Tanggal Kembali <span class="required">*</span></label>
                <input type="date" name="tanggal_kembali" id="tanggal_kembali" value="{{ old('tanggal_kembali', $loan['tanggal_kembali']) }}" required>
                @error('tanggal_kembali')
                    <div class="alert-danger" style="margin-top: 4px; padding: 6px 10px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status <span class="required">*</span></label>
                <select name="status" id="status" required>
                    <option value="dipinjam" @selected(old('status', $loan['status']) == 'dipinjam')>Dipinjam</option>
                    <option value="dikembalikan" @selected(old('status', $loan['status']) == 'dikembalikan')>Dikembalikan</option>
                    <option value="terlambat" @selected(old('status', $loan['status']) == 'terlambat')>Terlambat</option>
                </select>
                @error('status')
                    <div class="alert-danger" style="margin-top: 4px; padding: 6px 10px;">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top: 8px;">Perbarui Peminjaman</button>
        </form>
    </div>
@endsection
