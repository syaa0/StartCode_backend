<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Language</title>
    <link rel="stylesheet" href="{{ asset('css/contentview.css') }}"> <!-- Link to your CSS file -->
</head>
<body>
    <!-- Header with Title and Logo -->
    <header style="position: fixed; top: 0; width: 100%; background: white; display: flex; justify-content: space-between; align-items: center; padding: 0 10px;">
        <!-- Add Data Button for Super Admin -->
        @if (Auth::user() && Auth::user()->isSuperAdmin())
            <a href="{{ route('createcode') }}" style="background-color: blue; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">Add Data</a>
        @endif

        <div style="display: flex; align-items: center;">
            <!-- Logo next to the title -->
            <img src="{{ asset('images/startcode.png') }}" alt="Logo" style="height: 30px; margin-right: 10px;">
            
            <!-- "Program Language" Text -->
            <h1>Program Language</h1>
        </div>
    </header>

    <!-- Main Content -->
    <div style="margin-top: 60px; padding: 20px; width: 85%; margin-left: auto; margin-right: auto;"> <!-- Adjusted width and margins -->
        @foreach ($codes as $code)
            <div class="code-item" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;"> <!-- Added margin for spacing -->
                <!-- Link with brief description -->
                <a href="{{ route('viewbyid', ['id' => $code->id]) }}" style="flex-grow: 1; text-decoration: none; color: black;">
                    <div>
                        <h2>{{ $code->name }}</h2>
                        @if ($code->logo)
                            <img src="{{ asset($code->logo) }}" alt="{{ $code->name }} Logo" style="height: 100px;">
                        @endif
                        <!-- Brief description (10 words) -->
                        <p>{{ Str::limit($code->deskripsi, 30) }}</p>
                    </div>
                </a>

                @if (Auth::user() && Auth::user()->isSuperAdmin())
                    <!-- Edit and Delete Buttons for Super Admin -->
                    <div>
                        <a href="{{ route('editcode', $code->id) }}" style="background-color: green; color: white; padding: 5px 10px; text-decoration: none; border-radius: 5px; margin-right: 5px;">Edit</a>
                        <form action="{{ route('deletecode', $code->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')" style="background-color: red; color: white; padding: 5px 10px; border: none; border-radius: 5px;">Delete</button>
                        </form>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    <!-- Include JavaScript if needed -->
</body>
</html>
