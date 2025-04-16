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
                <form method="GET" class="mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="title" class="form-control" placeholder="Filter by Title" value="{{ request('title') }}">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="author" class="form-control" placeholder="Filter by Author" value="{{ request('author') }}">
                        </div>
                        <div class="col-md-2">
                            <select name="itemsPerPage" class="form-control">
                                @foreach([5, 10, 25, 50] as $count)
                                    <option value="{{ $count }}" {{ request('itemsPerPage', 10) == $count ? 'selected' : '' }}>{{ $count }} per page</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Apply</button>
                            <a href="{{ route('books.index') }}" class="btn btn-secondary w-100">Reset</a>
                        </div>
                    </div>
                </form>
                <div class="d-flex justify-content-center mt-3">
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
