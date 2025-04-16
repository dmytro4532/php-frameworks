<div class="mb-3">
    <label class="form-label">Full Name</label>
    <input type="text" name="fullName" class="form-control" value="{{ old('fullName', $reader->fullName ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $reader->email ?? '') }}" required>
</div>
