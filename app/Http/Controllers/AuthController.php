<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');
            $remember = $request->boolean('remember');

            if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate();
                
                $user = Auth::user();
                
                // Redirect berdasarkan tipe pengguna
                if ($user->tipe_pengguna === 'admin') {
                    return redirect()->intended(route('admin.dashboard'));
                } else {
                    return redirect()->intended(route('user.dashboard'));
                }
            }

            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->withInput($request->only('email'));

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    }

    /**
     * Show registration form
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle registration request
     */
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'alamat' => 'required|string',
                'no_telp' => 'required|string',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'tipe_pengguna' => 'user', // Default user
            ]);

            Auth::login($user);

            return redirect()->route('user.dashboard');

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
        }
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }

    /**
     * Show forgot password form
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Send reset link email
     */
    public function sendResetLinkEmail(Request $request)
    {
        // Implementasi reset password
        $request->validate(['email' => 'required|email']);
        
        // Logic untuk mengirim email reset
        return back()->with('success', 'Link reset password telah dikirim ke email Anda.');
    }

    /**
     * Show reset password form
     */
    public function showResetPasswordForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    /**
     * Reset password
     */
    public function resetPassword(Request $request)
    {
        // Implementasi reset password
        return redirect()->route('login')->with('success', 'Password berhasil direset.');
    }
}