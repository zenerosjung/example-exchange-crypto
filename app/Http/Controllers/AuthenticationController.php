<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthenticationController extends BaseController
{
    public function index()
    {
        return $this->view('login.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password')])) {
            $request->session()->put('user', Auth::user());

            return redirect()->route('index')->with('success', 'Login successfully.');
        }
        return redirect()->back()->with('error', 'Unauthorised.');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        $request->session()->remove('user');

        return redirect()->route('index')->with('success', 'Logout successfully.');
    }
}
