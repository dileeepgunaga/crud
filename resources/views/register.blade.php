<!-- resources/views/register.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
    <h1>User Registration</h1>
   
    <form action="{{ route('register.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
       @endif
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
       

        <label for="mobile">Mobile:</label>
        <input type="text" id="mobile" name="mobile" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="profile_pic">Profile Picture:</label>
        <input type="file" id="profile_pic" name="profile_pic"><br><br>

        <button type="submit">Register</button>
        <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
        <a href="{{ route('display') }}" class="btn btn-primary">Show All Users</a>
    </form>

    
</body>
</html>
