<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(): View
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'status' => true,
        ];

        if (Auth::attempt(
            $credentials,
            $request->boolean('remember')
        )) {
            $request->session()->regenerate();

            return redirect()
              ->intended(route('events.index'))
              ->with(
                 'success',
                 'Login realizado com sucesso.'
              );
        }

        return back()
          ->withErrors([
            'email' => 'E-mail ou senha inválidos.',
          ])
          ->onlyInput('email');
    }

    public function showRegister(): View
    {
        return view('auth.register');
    }

    public function register(
        RegisterRequest $request
    ): RedirectResponse {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make(

            $request->input('password')), 'role' => 'user', 'status' => true,]);

              Auth::login($user);

            $request->session()->regenerate();

            return redirect()
              ->route('events.index')
              ->with(
                  'success',
                  'Conta criada com sucesso.'
              );
    }

    public function logout(
        \Illuminate\Http\Request $request
    ): RedirectResponse {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
          ->route('login')
          ->with(
            'success',
            'Você saiu do sistema.'
          );
    }
}
