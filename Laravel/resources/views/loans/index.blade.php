@extends('layout')

@section('content')
    <div class="container mt-5">
        <a href="{{ route('loans.create') }}" class="btn btn-success mb-3">Add Loan</a>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Book</th>
                <th>Reader</th>
                <th>Loan Date</th>
                <th>Return</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($loans as $loan)
                <tr>
                    <td>{{ $loan->book->title }}</td>
                    <td>{{ $loan->reader->fullName }}</td>
                    <td>{{ $loan->loan_date }}</td>
                    <td>
                        {{ $loan->return?->return_date ?? 'Not Returned' }}
                    </td>
                    <td>
                        <form action="{{ route('loans.destroy', $loan->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            <a href="{{ route('loans.show', $loan->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                            <a href="{{ route('loans.edit', $loan->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <form method="GET" class="mb-3">
            <div class="row g-2">
                <div class="col-md-3">
                    <input type="text" name="book" class="form-control" placeholder="Book Title" value="{{ request('book') }}">
                </div>
                <div class="col-md-3">
                    <input type="text" name="reader" class="form-control" placeholder="Reader Name" value="{{ request('reader') }}">
                </div>
                <div class="col-md-2">
                    <input type="date" name="loan_date" class="form-control" value="{{ request('loan_date') }}">
                </div>
                <div class="col-md-2">
                    <select name="returned" class="form-control">
                        <option value="">All</option>
                        <option value="yes" {{ request('returned') == 'yes' ? 'selected' : '' }}>Returned</option>
                        <option value="no" {{ request('returned') == 'no' ? 'selected' : '' }}>Not Returned</option>
                    </select>
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
                    <a href="{{ route('loans.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
        <div class="d-flex justify-content-center mt-3">
            {{ $loans->links() }}
        </div>
    </div>
@endsection
