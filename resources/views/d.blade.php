<!-- resources/views/users/index.blade.php -->
<!DOCTYPE html>
<html>
<head>
<link href="{{ asset('css/e.css') }}" rel="stylesheet">
    <title>All Users</title>
</head>
<body>
    <h1>All Users</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Profile Pic</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->mobile }}</td>
                <td>
                    @if($user->profile_pic)
                    <img src="{{ asset('storage/'.$user->profile_pic) }}" alt="{{ $user->name }}" style="max-width: 100px;">
                    @else
                    No Image
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
        
    </table>
    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
</body>
</html>
