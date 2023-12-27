<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Code</title>
    <link rel="stylesheet" href="{{ asset('css/createcode.css') }}">

    
</head>
<body>
    <h1>Add New Code</h1>

    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('storecode') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div>
            <label for="deskripsi">Description:</label>
            <textarea id="deskripsi" name="deskripsi" required></textarea>
        </div>

        <div>
            <label for="logo">Logo:</label>
            <input type="file" id="logo" name="logo" required>
        </div>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
