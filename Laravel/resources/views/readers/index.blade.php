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
                                <form action="{{ route('readers.destroy', $reader->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    <a href="{{ route('readers.show', $reader->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                    <a href="{{ route('readers.edit', $reader->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3">No readers found.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
