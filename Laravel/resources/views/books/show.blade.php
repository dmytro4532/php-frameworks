@extends('layout')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm rounded">
            <div class="card-body">
                <h4>Title: {{ $book->title }}</h4>
                <p>Author: {{ $book->author->fullName }}</p>
                <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </div>
@endsection
