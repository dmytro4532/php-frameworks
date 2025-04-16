@extends('layout')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm rounded">
            <div class="card-body">
                <a href="{{ route('readers.create') }}" class="btn btn-success mb-3">Add reader</a>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th style="width: 20%">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($readers as $reader)
                        <tr>
                            <td>{{ $reader->fullName }}</td>
                            <td>{{ $reader->email }}</td>
                            <td>
                                <form action="{{ route('readers.destroy', $reader->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure?');">
                                    <a href="{{ route('readers.show', $reader->id) }}"
                                       class="btn btn-sm btn-dark">SHOW</a>
                                    <a href="{{ route('readers.edit', $reader->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No readers found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <form method="GET" class="mb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="fullName" class="form-control" placeholder="Filter by Name"
                                   value="{{ request('fullName') }}">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="email" class="form-control" placeholder="Filter by Email"
                                   value="{{ request('email') }}">
                        </div>
                        <div class="col-md-2">
                            <select name="itemsPerPage" class="form-control">
                                @foreach([5, 10, 25, 50] as $count)
                                    <option
                                        value="{{ $count }}" {{ request('itemsPerPage', 10) == $count ? 'selected' : '' }}>
                                        {{ $count }} per page
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100">Apply</button>
                            <a href="{{ route('readers.index') }}" class="btn btn-secondary w-100">Reset</a>
                        </div>
                    </div>
                </form>
                <div class="d-flex justify-content-center mt-3">
                    {{ $readers->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
