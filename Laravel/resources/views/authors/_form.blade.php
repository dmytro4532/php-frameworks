<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="fullName" value="{{ old('fullName', $author->fullName ?? '') }}" class="form-control" required>
</div>
