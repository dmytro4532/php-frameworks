@extends('layout')

@section('content')
    <form method="POST" action="{{ route('returns.store') }}">
        @csrf

        <div class="mb-3">
            <label>Loan</label>
            <select name="loan_id" class="form-control">
                @foreach($loans as $loan)
                    <option value="{{ $loan->id }}">{{ $loan->id }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Returned At</label>
            <input type="datetime-local" name="return_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection
