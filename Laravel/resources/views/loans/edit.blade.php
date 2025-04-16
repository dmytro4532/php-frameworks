@extends('layout')

@section('content')
    <div class="container mt-5">
        <form action="{{ isset($loan) ? route('loans.update', $loan->id) : route('loans.store') }}" method="POST">
            @csrf
            @if(isset($loan)) @method('PUT') @endif

            <div class="mb-3">
                <label class="form-label">Book</label>
                <select name="book_id" class="form-select" required>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}" @selected(old('book_id', $loan->book_id ?? '') == $book->id)>
                            {{ $book->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Reader</label>
                <select name="reader_id" class="form-select" required>
                    @foreach ($readers as $reader)
                        <option value="{{ $reader->id }}" @selected(old('reader_id', $loan->reader_id ?? '') == $reader->id)>
                            {{ $reader->fullName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Loan Date</label>
                <input type="date" name="loan_date" class="form-control" value="{{ old('loan_date', $loan->loan_date ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Return (optional)</label>
                <select name="return_id" class="form-select">
                    <option value="">-- No Return --</option>
                    @foreach ($returns as $return)
                        <option value="{{ $return->id }}" @selected(old('return_id', $loan->return_id ?? '') == $return->id)>
                            Returned on {{ $return->return_date }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('loans.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
