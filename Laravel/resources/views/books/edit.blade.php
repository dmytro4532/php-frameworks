@extends('layout')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm rounded">
            <div class="card-body">
                <form action="{{ route('books.update', $book->id) }}" method="POST">
                    @csrf @method('PUT')
                    @include('books._form', ['book' => $book])
                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                    <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
