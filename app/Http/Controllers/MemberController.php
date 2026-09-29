<?php
// File: app/Http/Controllers/MemberController.php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::when(request('search'), function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%");
        })->paginate(10);

        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(StoreMemberRequest $request)
    {
        $validated = $request->validated();

        // Pemetaan input form 'telepon' ke kolom 'nomor_telepon' DB
        if (isset($validated['telepon'])) {
            $validated['nomor_telepon'] = $validated['telepon'];
            unset($validated['telepon']);
        }

        Member::create($validated);

        return redirect()
            ->route('members.index')
            ->with('success', 'Data anggota berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $member = Member::findOrFail($id);
        return view('members.show', compact('member'));
    }

    public function edit(string $id)
    {
        $member = Member::findOrFail($id);
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, string $id)
    {
        $member = Member::findOrFail($id);

        // Validasi input (mengabaikan 'unique' pada email & nim milik anggota ini sendiri)
        $validated = $request->validate([
            'nama'    => 'required|string|max:100',
            'nim'     => 'required|numeric|digits_between:8,15|unique:members,nim,' . $id,
            'email'   => 'required|email|max:100|unique:members,email,' . $id,
            'telepon' => 'required|numeric|digits_between:10,15',
            'status'  => 'required|in:aktif,nonaktif',
            'alamat'  => 'nullable|string|max:300',
        ]);

        // Pemetaan input form 'telepon' ke kolom 'nomor_telepon' di database
        if (isset($validated['telepon'])) {
            $validated['nomor_telepon'] = $validated['telepon'];
            unset($validated['telepon']);
        }

        $member->update($validated);

        return redirect()
            ->route('members.index')
            ->with('success', "Data anggota \"{$member->nama}\" berhasil diperbarui!");
    }

    public function destroy(string $id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()
            ->route('members.index')
            ->with('success', 'Data anggota berhasil dihapus!');
    }
}