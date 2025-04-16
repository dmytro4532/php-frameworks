@extends('layout')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <p><strong>ID:</strong> {{ $return->id }}</p>
                <p><strong>Loan ID:</strong> {{ $return->loan_id }}</p>
                <p><strong>Returned At:</strong> {{ $return->return_date }}</p>

                <a href="{{ route('returns.edit', $return) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('returns.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection
