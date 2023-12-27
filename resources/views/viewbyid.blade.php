<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Code Details</title>
    <link rel="stylesheet" href="{{ asset('css/viewbyid.css') }}">
</head>
<body>
    <div class="code-details">
        <h1>{{ $code->name }}</h1>
        <img src="{{ asset($code->logo) }}" alt="{{ $code->name }} Logo">
        <p>{{ $code->deskripsi }}</p>
        <!-- Tampilkan detail lainnya dari $code -->
    </div>
</body>
</html>
