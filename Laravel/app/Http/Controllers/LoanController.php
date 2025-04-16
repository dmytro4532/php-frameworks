<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\Reader;
use App\Models\ReturnModel;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['book', 'reader', 'return'])->get();
        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $books = Book::all();
        $readers = Reader::all();
        $returns = ReturnModel::all();
        return view('loans.create', compact('books', 'readers', 'returns'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'reader_id' => 'required|exists:readers,id',
            'loan_date' => 'required|date',
            'return_id' => 'nullable|exists:returns,id',
        ]);

        Loan::create($request->all());
        return redirect()->route('loans.index')->with('success', 'Loan created successfully.');
    }

    public function show(Loan $loan)
    {
        return view('loans.show', compact('loan'));
    }

    public function edit(Loan $loan)
    {
        $books = Book::all();
        $readers = Reader::all();
        $returns = ReturnModel::all();
        return view('loans.edit', compact('loan', 'books', 'readers', 'returns'));
    }

    public function update(Request $request, Loan $loan)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'reader_id' => 'required|exists:readers,id',
            'loan_date' => 'required|date',
            'return_id' => 'nullable|exists:return_models,id',
        ]);

        $loan->update($request->all());
        return redirect()->route('loans.index')->with('success', 'Loan updated successfully.');
    }

    public function destroy(Loan $loan)
    {
        $loan->delete();
        return redirect()->route('loans.index')->with('success', 'Loan deleted successfully.');
    }
}
