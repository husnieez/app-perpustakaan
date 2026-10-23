<?php
// File: app/Http/Controllers/LoanController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        return 'LoanController@index';
    }

    public function create()
    {
        $members = Member::all();
        $books = Book::all();

        return view('loans.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|integer|exists:members,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'book_ids' => 'required|array|min:1',
            'book_ids.*' => 'integer|exists:books,id',
        ]);

        $loan = Loan::create([
            'member_id' => $validated['member_id'],
            'user_id' => auth()->id(),
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'tanggal_kembali' => $validated['tanggal_kembali'],
        ]);
    }

    public function show(string $id)
    {
        return "LoanController@show, id: {$id}";
    }

    public function edit(string $id)
    {
        return "LoanController@edit, id: {$id}";
    }

    public function update(Request $request, string $id)
    {
        return "LoanController@update, id: {$id}";
    }

    public function destroy(string $id)
    {
        return "LoanController@destroy, id: {$id}";
    }
}