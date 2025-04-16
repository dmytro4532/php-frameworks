@extends('layout')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('authors.update', $author->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @include('authors._form', ['author' => $author])

                            <button type="submit" class="btn btn-primary mt-3">Update</button>
                            <a href="{{ route('authors.index') }}" class="btn btn-secondary mt-3">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
