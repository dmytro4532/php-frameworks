@extends('layout')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h4>Book: {{ $loan->book->title }}</h4>
                <h4>Reader: {{ $loan->reader->fullName }}</h4>
                <p>Loaned on: {{ $loan->loan_date }}</p>
                <p>Returned on: {{ $loan->return?->returned_at ?? 'Not yet returned' }}</p>
                <a href="{{ route('loans.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
@endsection
