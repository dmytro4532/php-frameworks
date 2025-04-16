<!DOCTYPE html>
<html>
<head>
    <title>Library System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container">
    <nav class="mb-4">
        <a href="{{ url('/') }}" class="btn btn-secondary">Home</a>
    </nav>
    @yield('content')
</div>
</body>
</html>
