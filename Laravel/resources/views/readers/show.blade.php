@extends('layout')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm rounded">
            <div class="card-body">
                <h4>Name: {{ $reader->fullName }}</h4>
                <p>Email: {{ $reader->email }}</p>
                <a href="{{ route('readers.index') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </div>
@endsection
