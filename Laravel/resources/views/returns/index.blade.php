@extends('layout')

@section('content')
    <div class="container mt-5">
        <a href="{{ route('returns.create') }}" class="btn btn-success mb-3">Add return</a>
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Loan</th>
                <th>Returned At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($returns as $return)
                <tr>
                    <td>{{ $return->id }}</td>
                    <td>{{ $return->loan->id }}</td>
                    <td>{{ $return->return_date }}</td>
                    <td>
                        <a href="{{ route('returns.show', $return->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('returns.edit', $return->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('returns.destroy', $return->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this return?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
