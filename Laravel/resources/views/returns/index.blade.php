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
        <form method="GET" class="mb-3">
            <div class="row g-2">
                <div class="col-md-3">
                    <input type="number" name="loan_id" class="form-control" placeholder="Loan ID" value="{{ request('loan_id') }}">
                </div>
                <div class="col-md-3">
                    <input type="date" name="return_date" class="form-control" value="{{ request('return_date') }}">
                </div>
                <div class="col-md-2">
                    <select name="itemsPerPage" class="form-control">
                        @foreach([5, 10, 25, 50] as $count)
                            <option value="{{ $count }}" {{ request('itemsPerPage', 10) == $count ? 'selected' : '' }}>
                                {{ $count }} per page
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 mt-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Apply</button>
                    <a href="{{ route('returns.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
        <div class="d-flex justify-content-center mt-3">
            {{ $returns->links() }}
        </div>
    </div>
@endsection
