<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'mobile' => 'required|string|unique:users,mobile',
            'password' => 'required|string|min:8',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload if a profile picture is provided
        if ($request->hasFile('profile_pic')) {
            $imagePath = $request->file('profile_pic')->store('profile_pics', 'public');
        }

        // Create user record
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'mobile' => $request->input('mobile'),
            'password' => bcrypt($request->input('password')),
            'profile_pic' => $imagePath ?? null,
        ]);
        $user->save();

        return redirect()->route('login')->with('success', 'Registration successful!');
    }

    //edit
    public function edit()
    {
        $user = auth()->user(); // Assuming you're using Laravel's authentication
        return view('edit', compact('user'));
    }
    

//update
public function updateUser(Request $request, $id)
{
    $user = User::findOrFail($id); // Assuming you have a route parameter for user ID

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|unique:users,email,'.$id,
        'mobile' => 'required|string|unique:users,mobile,'.$id,
        'old_password' => 'required|string|min:8', // Validate old password
        'password' => 'nullable|string|min:8|confirmed', // New password confirmation
        'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Check if the old password matches the user's current password
    if (!\Hash::check($request->input('old_password'), $user->password)) {
        return redirect()->back()->with('error', 'The old password is incorrect.');
    }

    // Handle file upload if a new profile picture is provided
    if ($request->hasFile('profile_pic')) {
        $imagePath = $request->file('profile_pic')->store('profile_pics', 'public');
        $user->profile_pic = $imagePath;
    }

    // Update user information
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->mobile = $request->input('mobile');
    
    // Update password if provided
    if ($request->filled('password')) {
        $user->password = bcrypt($request->input('password'));
    }

    $user->save();

    $user = Auth::user();
    return view('view',['user' => $user]);
}


public function destroy($id)
{
    $user = User::findOrFail($id);
    
    // Additional checks if needed before deletion
    
    $user->delete();

    return redirect()->route('login')->with('success', 'User deleted successfully!');
}

    public function logout()
    {
        
        Auth::logout(); // Logout the user
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
    public function showAllUsers()
{
    $users = User::orderBy('id', 'asc')->get(); // Ascending order by ID

    return view('display', compact('users'));
}

    

}
