@extends('layouts.app')

@section('title', 'Detail Anggota')

@section('content')
    <h1>Detail Anggota</h1>
    <p><a href="{{ route('members.index') }}">&larr; Kembali ke daftar anggota</a></p>

    <ul>
        <li><strong>ID:</strong> {{ $member->id }}</li>
        <li><strong>Nama:</strong> {{ $member->nama }}</li>
        <li><strong>NIM:</strong> {{ $member->nim }}</li>
        <li><strong>Email:</strong> {{ $member->email }}</li>
        <li><strong>No. Telepon:</strong> {{ $member->nomor_telepon }}</li>
        <li><strong>Alamat:</strong> {{ $member->alamat }}</li>
        <li><strong>Status:</strong> {{ ucfirst($member->status) }}</li>
    </ul>
@endsection
