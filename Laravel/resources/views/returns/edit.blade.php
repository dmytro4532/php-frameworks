@extends('layout')

@section('content')
    <form method="POST" action="{{ route('returns.update', $return) }}">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Loan</label>
            <select name="loan_id" class="form-control">
                @foreach($loans as $loan)
                    <option value="{{ $loan->id }}" {{ $return->loan_id == $loan->id ? 'selected' : '' }}>
                        {{ $loan->id }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Returned At</label>
            <input type="datetime-local" name="return_date" class="form-control"
                   value="{{ \Carbon\Carbon::parse($return->return_date)->format('Y-m-d\TH:i') }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
