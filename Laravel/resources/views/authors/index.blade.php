@extends('layout')

@section('content')
    <div class="container mt-5">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <a href="{{ route('authors.create') }}" class="btn btn-success mb-3">Add author</a>

                <table class="table table-bordered">
                    <thead>
                    <tr><th>Name</th><th style="width: 20%">Actions</th></tr>
                    </thead>
                    <tbody>
                    @forelse ($authors as $author)
                        <tr>
                            <td>{{ $author->fullName }}</td>
                            <td class="text-center">
                                <form onsubmit="return confirm('Are you sure?');" action="{{ route('authors.destroy', $author->id) }}" method="POST">
                                    <a href="{{ route('authors.show', $author->id) }}" class="btn btn-sm btn-dark">Show</a>
                                    <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="text-center">No authors found.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
