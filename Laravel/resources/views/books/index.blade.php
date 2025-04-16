@extends('layout')

@section('content')
    <div class="container mt-5">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <a href="{{ route('books.create') }}" class="btn btn-success mb-3">Add book</a>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th style="width: 20%">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author->fullName }}</td>
                            <td>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    <a href="{{ route('books.show', $book->id) }}" class="btn btn-sm btn-dark">Show</a>
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4">No books found.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
