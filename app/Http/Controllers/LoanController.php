<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\LoanItem;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['member', 'user', 'loanItems.book'])->paginate(10);

        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $members = Member::all();
        $books = Book::all();
        $users = User::all();

        return view('loans.create', compact('members', 'books', 'users'));
    }

    public function store(Request $request)
    {
        $rules = [
            'member_id' => 'required|integer|exists:members,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'book_ids' => 'required|array|min:1',
            'book_ids.*' => 'integer|exists:books,id',
        ];

        if (!auth()->check()) {
            $rules['user_id'] = 'required|integer|exists:users,id';
        }

        $validated = $request->validate($rules, [
            'member_id.required' => 'Anggota wajib dipilih.',
            'user_id.required' => 'Petugas wajib dipilih.',
            'tanggal_pinjam.required' => 'Tanggal pinjam wajib diisi.',
            'tanggal_kembali.required' => 'Tanggal kembali wajib diisi.',
            'tanggal_kembali.after_or_equal' => 'Tanggal kembali tidak boleh sebelum tanggal pinjam.',
            'book_ids.required' => 'Pilih minimal satu buku.',
            'book_ids.min' => 'Pilih minimal satu buku.',
        ]);

        $userId = auth()->id() ?? $request->input('user_id');

        $loan = Loan::create([
            'member_id' => $validated['member_id'],
            'user_id' => $userId,
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'tanggal_kembali' => $validated['tanggal_kembali'],
            'status' => 'dipinjam',
        ]);

        foreach ($validated['book_ids'] as $bookId) {
            $loan->loanItems()->create(['book_id' => $bookId]);
        }

        return redirect()->route('loans.index')
            ->with('success', 'Transaksi peminjaman berhasil dibuat.');
    }

    public function show(string $id)
    {
        $loan = Loan::with(['member', 'user', 'loanItems.book'])->findOrFail($id);

        return view('loans.show', compact('loan'));
    }

    public function edit(string $id)
    {
        $loan = Loan::with(['member', 'user', 'loanItems.book'])->findOrFail($id);

        return view('loans.edit', compact('loan'));
    }

    public function update(Request $request, string $id)
    {
        $loan = Loan::findOrFail($id);

        $validated = $request->validate([
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'status' => 'required|in:dipinjam,dikembalikan,terlambat',
        ], [
            'tanggal_kembali.required' => 'Tanggal kembali wajib diisi.',
            'tanggal_kembali.after_or_equal' => 'Tanggal kembali tidak boleh sebelum tanggal pinjam.',
        ]);

        $loan->update($validated);

        return redirect()->route('loans.index')
            ->with('success', 'Transaksi peminjaman berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $loan = Loan::findOrFail($id);
        $loan->loanItems()->delete();
        $loan->delete();

        return redirect()->route('loans.index')
            ->with('success', 'Transaksi peminjaman berhasil dihapus.');
    }

    public function kembalikan(string $id)
    {
        $loan = Loan::findOrFail($id);
        $loan->update([
            'status' => 'dikembalikan',
            'tanggal_dikembalikan' => now()->toDateString(),
        ]);

        return redirect()->route('loans.index')
            ->with('success', 'Buku berhasil dikembalikan.');
    }
}