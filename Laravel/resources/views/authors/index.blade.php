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
                <form method="GET" class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="fullName" class="form-control" placeholder="Filter by Name" value="{{ request('fullName') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="itemsPerPage" class="form-control">
                                @foreach([5, 10, 25, 50] as $count)
                                    <option value="{{ $count }}" {{ request('itemsPerPage', 10) == $count ? 'selected' : '' }}>
                                        {{ $count }} per page
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100">Apply</button>
                            <a href="{{ route('authors.index') }}" class="btn btn-secondary w-100">Reset</a>
                        </div>
                    </div>
                </form>
                <div class="d-flex justify-content-center mt-3">
                    {{ $authors->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
