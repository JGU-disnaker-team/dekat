<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
     *
     * This method authenticates the user, regenerates the session, and redirects
     * the user to the intended location, which is the dashboard in this case.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

                $request->session()->regenerate();

                return redirect()->intended('dashboard');
        }

    /**
     * Log out the authenticated user, invalidate the session, and regenerate the CSRF token.
     */
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
