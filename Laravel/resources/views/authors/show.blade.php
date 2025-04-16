@extends('layout')

@section('content')
    <div class="container mt-5">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
                <h4>Name: {{ $author->fullName }}</h4>
                <a href="{{ route('authors.index') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </div>
@endsection
