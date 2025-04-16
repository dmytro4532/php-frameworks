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
    </div>
@endsection
