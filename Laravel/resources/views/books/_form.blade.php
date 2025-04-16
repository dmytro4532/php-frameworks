<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" class="form-control" value="{{ old('title', $book->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Author</label>
    <select name="author_id" class="form-control" required>
        <option value="">Select Author</option>
        @foreach ($authors as $author)
            <option value="{{ $author->id }}" {{ (old('author_id', $book->author_id ?? '') == $author->id) ? 'selected' : '' }}>
                {{ $author->fullName }}
            </option>
        @endforeach
    </select>
</div>
