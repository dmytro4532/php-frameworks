<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use App\Models\Reader;
use Illuminate\Http\Request;

class ReaderController extends Controller
{
    public function index(Request $request)
    {
        $query = Reader::query();

        if ($request->filled('fullName')) {
            $query->where('fullName', 'like', '%' . $request->fullName . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        $itemsPerPage = $request->input('itemsPerPage', 10);
        $readers = $query->paginate($itemsPerPage)->appends($request->all());

        return view('readers.index', compact('readers'));
    }

    public function create()
    {
        return view('readers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:readers,email',
        ]);

        Reader::create($request->all());
        return redirect()->route('readers.index')->with('success', 'Reader created!');
    }

    public function show(Reader $reader)
    {
        return view('readers.show', compact('reader'));
    }

    public function edit(Reader $reader)
    {
        return view('readers.edit', compact('reader'));
    }

    public function update(Request $request, Reader $reader)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:readers,email,' . $reader->id,
        ]);

        $reader->update($request->all());
        return redirect()->route('readers.index')->with('success', 'Reader updated!');
    }

    public function destroy(Reader $reader)
    {
        $reader->delete();
        return redirect()->route('readers.index')->with('success', 'Reader deleted!');
    }
}
