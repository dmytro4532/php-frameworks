@extends('layout')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm rounded">
            <div class="card-body">
                <form action="{{ route('readers.store') }}" method="POST">
                    @csrf
                    @include('readers._form')
                    <button type="submit" class="btn btn-success mt-3">Save</button>
                    <a href="{{ route('readers.index') }}" class="btn btn-secondary mt-3">Back</a>
                </form>
            </div>
        </div>
    </div>
@endsection
