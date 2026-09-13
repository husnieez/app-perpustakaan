<?php
// File: app/Http/Controllers/MemberController.php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    // Dummy data gak tuh
    private array $members = [
        [
            'id'           => 3125600064,
            'nama'         => 'Husni',
            'nim'          => '1234567890',
            'email'        => 'husni@example.com',
            'nomer_telpon' => '081234567890',
            'alamat'       => 'Jl. Keputih No. 1, Surabaya',
            'status'       => 'aktif',
        ],
        [
            'id'           => 3125600002,
            'nama'         => 'Budi',
            'nim'          => '9876543210',
            'email'        => 'budi@example.com',
            'nomer_telpon' => '082345678901',
            'alamat'       => 'Jl. Mulyorejo No. 2, Surabaya',
            'status'       => 'pasif',
        ],
    ];

    public function index()
    {
        $members = $this->members;
        return view('members.index', compact('members'));
    }
    public function create()
    {
        return view('members.create');
    }

    // Simpan data member baru
    public function store(StoreMemberRequest $request)
    {
        $validated = $request->validated();


        return redirect()
            ->route('members.index')
            ->with('success', 'Data member berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        return "MemberController@show, id: {$id}";
    }

    public function edit(string $id)
    {
        return "MemberController@edit, id: {$id}";
    }

    public function update(Request $request, string $id)
    {
        return "MemberController@update, id: {$id}";
    }

    public function destroy(string $id)
    {
        return "MemberController@destroy, id: {$id}";
    }
}
