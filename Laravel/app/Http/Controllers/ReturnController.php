<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\ReturnModel;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function index(Request $request)
    {
        $query = ReturnModel::with('loan');

        if ($request->filled('loan_id')) {
            $query->where('loan_id', $request->loan_id);
        }

        if ($request->filled('return_date')) {
            $query->whereDate('return_date', $request->return_date);
        }

        $itemsPerPage = $request->input('itemsPerPage', 10);
        $returns = $query->paginate($itemsPerPage)->appends($request->all());

        return view('returns.index', compact('returns'));
    }


    public function create()
    {
        $loans = Loan::all();
        return view('returns.create', compact('loans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'return_date' => 'required|date',
        ]);

        ReturnModel::create($request->all());
        return redirect()->route('returns.index')->with('success', 'Return created successfully.');
    }

    public function show(ReturnModel $return)
    {
        return view('returns.show', compact('return'));
    }

    public function edit(ReturnModel $return)
    {
        $loans = Loan::all();
        return view('returns.edit', compact('return', 'loans'));
    }

    public function update(Request $request, ReturnModel $return)
    {
        $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'return_date' => 'required|date',
            'condition_notes' => 'nullable|string',
        ]);

        $return->update($request->all());

        return redirect()->route('returns.index')->with('success', 'Return updated successfully.');
    }

    public function destroy(ReturnModel $return)
    {
        $return->delete();
        return redirect()->route('returns.index')->with('success', 'Return deleted successfully.');
    }
}
