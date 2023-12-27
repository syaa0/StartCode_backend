<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Code</title>
    <link rel="stylesheet" href="{{ asset('css/editcode.css') }}">
</head>
<body>
    <h1>Edit Code</h1>

    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('updatecode', $code->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $code->name }}" required>
        </div>

        <div>
            <label for="deskripsi">Description:</label>
            <textarea id="deskripsi" name="deskripsi" required>{{ $code->deskripsi }}</textarea>
        </div>

        <div>
            <label for="logo">Logo:</label>
            <input type="file" id="logo" name="logo">
            <img src="{{ asset($code->logo) }}" alt="Current Logo" style="height: 100px;">
        </div>

        <button type="submit">Update</button>
    </form>
</body>
</html>
