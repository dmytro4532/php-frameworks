<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(Request $request)
    {
        $query = Author::query();

        if ($request->filled('fullName')) {
            $query->where('fullName', 'like', '%' . $request->fullName . '%');
        }

        $itemsPerPage = $request->input('itemsPerPage', 10);
        $authors = $query->paginate($itemsPerPage)->appends($request->all());

        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
        ]);

        Author::create($request->only('fullName'));

        return redirect()->route('authors.index')->with('success', 'Author created!');
    }

    public function show(Author $author)
    {
        return view('authors.show', compact('author'));
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
        ]);

        $author->update($request->only('fullName'));

        return redirect()->route('authors.index')->with('success', 'Author updated!');
    }

    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('authors.index')->with('success', 'Author deleted!');
    }
}
