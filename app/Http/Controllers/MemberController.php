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

    public function update(StoreMemberRequest $request, string $id)
    {
        $member = Member::findOrFail($id);
        $validated = $request->validated();
        $member->update($validated);

        return redirect()
            ->route('members.index')
            ->with('success', 'Data anggota berhasil diperbarui!');
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
