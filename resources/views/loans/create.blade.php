@extends('layouts.app')

@section('title', 'Tambah Peminjaman')

@section('content')
    <h1 style="margin-bottom: 8px;">Tambah Peminjaman</h1>

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

    <form action="{{ route('loans.store') }}" method="POST" class="form-card">
        @csrf

        <div class="form-group">
            <label for="member_id">Anggota <span class="required">*</span></label>
            <select name="member_id" id="member_id" required>
                <option value="">-- Pilih Anggota --</option>
                @foreach ($members as $member)
                    <option value="{{ $member['id'] }}" @selected(old('member_id') == $member['id'])>
                        {{ $member['nama'] }} ({{ $member['nim'] }})
                    </option>
                @endforeach
            </select>
            @error('member_id')
                <div class="alert-danger" style="margin-top: 4px; padding: 6px 10px;">{{ $message }}</div>
            @enderror
        </div>

        @if (auth()->check())
            <div class="form-group">
                <label>Petugas</label>
                <div class="detail-value" style="background: #f8fafc; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px;">
                    {{ auth()->user()->name }}
                </div>
                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            </div>
        @elseif (isset($users))
            <div class="form-group">
                <label for="user_id">Petugas <span class="required">*</span></label>
                <select name="user_id" id="user_id" required>
                    <option value="">-- Pilih Petugas --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user['id'] }}" @selected(old('user_id') == $user['id'])>
                            {{ $user['name'] }}
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="alert-danger" style="margin-top: 4px; padding: 6px 10px;">{{ $message }}</div>
                @enderror
            </div>
        @endif

        <div class="form-row">
            <div class="form-group">
                <label for="tanggal_pinjam">Tanggal Pinjam <span class="required">*</span></label>
                <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}" required>
                @error('tanggal_pinjam')
                    <div class="alert-danger" style="margin-top: 4px; padding: 6px 10px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tanggal_kembali">Tanggal Kembali <span class="required">*</span></label>
                <input type="date" name="tanggal_kembali" id="tanggal_kembali" value="{{ old('tanggal_kembali', date('Y-m-d', strtotime('+7 days'))) }}" required>
                @error('tanggal_kembali')
                    <div class="alert-danger" style="margin-top: 4px; padding: 6px 10px;">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Buku yang Dipinjam <span class="required">*</span></label>
            <div style="border: 1px solid #cbd5e1; border-radius: 6px; padding: 12px; max-height: 220px; overflow-y: auto; background: #fff;">
                @forelse ($books as $book)
                    <label style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px; font-weight: normal; cursor: pointer;">
                        <input type="checkbox" name="book_ids[]" value="{{ $book['id'] }}" style="width: auto;"
                            @checked(is_array(old('book_ids')) && in_array($book['id'], old('book_ids')))>
                        <span><strong>{{ $book['judul'] }}</strong> &mdash; {{ $book['penulis'] }} (Stok: {{ $book['stok'] }})</span>
                    </label>
                @empty
                    <p style="margin: 0; color: #64748b;">Belum ada data buku.</p>
                @endforelse
            </div>
            @error('book_ids')
                <div class="alert-danger" style="margin-top: 4px; padding: 6px 10px;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan Transaksi Peminjaman</button>
    </form>
@endsection
