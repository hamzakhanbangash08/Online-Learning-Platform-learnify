<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    use \Illuminate\Foundation\Auth\AuthenticatesUsers;

    /**
     * Redirect users after login based on role
     */
    protected function authenticated(Request $request, $user)
    {
        // Ensure session regenerate ho jaye
        $request->session()->regenerate();

        // Admin ke liye
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.analytics');
        }

        // Student / Instructor ke liye
        if ($user->hasRole('student') || $user->hasRole('instructor')) {
            return redirect()->route('home');
        }

        // Fallback
        return redirect('/404');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    // * Redirect to Google OAuth
    //  */
     public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle callback from Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Find existing or create new user
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => bcrypt(str()->random(16)), // random password
                ]
            );

            // Login the user
            Auth::login($user);

            return redirect()->intended('home'); // redirect to home/dashboard
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Google login failed.');
        }
    }
}
