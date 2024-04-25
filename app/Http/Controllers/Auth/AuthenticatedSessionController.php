<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // Attempt to authenticate the user
        $remember = $request->filled('remember'); // Check if "remember me" checkbox is checked

        if (Auth::attempt($request->only('email', 'password'), $remember)) {
            // If authentication is successful, regenerate the session and redirect
            $request->session()->regenerate();

            $user = Auth::user();

            // Check if the user's email is verified
            if (!$user->hasVerifiedEmail()) {
                // If email is not verified, send verification notification
                $user->sendEmailVerificationNotification();

                // Redirect the user to the email verification notice page
                return redirect()->route('verification.notice');
            }

            // Check user type and redirect accordingly
            if ($user->userType === 'admin') {
                return redirect()->route(RouteServiceProvider::ADMIN_DASHBOARD);
            } elseif ($user->userType === 'SuperAdmin') {
                return redirect()->route(RouteServiceProvider::SUPER_ADMIN_DASHBOARD);
            }

            // Redirect to the intended URL after successful login
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        // If authentication fails, throw validation exception
        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
