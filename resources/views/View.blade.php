<!-- profile.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
   
    <link href="{{ asset('css/d.css') }}" rel="stylesheet">
    
</head>
<body>
    <div class="container">
        <h1>User Profile</h1>
        <div class="profile-card">
            <div class="profile-header">
                <div class="profile-avatar">
                    @if ($user->profile_pic)
                        <img src="{{ asset('storage/' . $user->profile_pic) }}" alt="Profile Picture">
                    @else
                        <div class="default-avatar">No Image</div>
                    @endif
                </div>
                <div class="profile-info">
                    <p><strong>ID:</strong> {{ $user->id }}</p>
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Mobile:</strong> {{ $user->mobile }}</p>
                </div>
            </div>

 <div class="profile-details">
                <!-- Add more profile details here if needed -->
               
<form action="{{ route('profile.edit') }}" method="GET">
    @csrf <!-- Add CSRF protection if needed -->
    <button type="submit" class="btn btn-primary">Update Profile</button>
</form>
 
 <!--delete-->
 
<form action="{{ route('users.destroy', $user->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>

     <!--log out-->
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf <!-- CSRF protection -->
</form>

<button onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-btn">
    Logout
</button>
</div>

        </div>
    </div>
</body>
</html>


