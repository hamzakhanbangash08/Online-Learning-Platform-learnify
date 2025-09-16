<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\NewUserRegistered;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'city'     => ['required', 'string', 'max:255'],
            'cnic'     => ['required', 'string', 'max:20'],
            'image'    => ['nullable', 'image', 'max:2048'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $imagePath = null;

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $imageName = time() . '_' . $data['image']->getClientOriginalName();
            $data['image']->move(public_path('profile_images'), $imageName);
            $imagePath = 'profile_images/' . $imageName;
        }

        // User create
        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'city'     => $data['city'],
            'cnic'     => $data['cnic'],
            'image'    => $imagePath,
        ]);

        // Default role assign (agar role system use kar rahe ho)
        $user->assignRole('User'); // 'User' ko aapka default role bana dena

        // Admin ko notification bhejna
        $admin = User::role('Admin')->first();
        if ($admin) {
            $admin->notify(new NewUserRegistered($user));
        }

        return $user;
    }

    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect('/login')->with('success', 'Registration successful! Please login.');
    }
}
