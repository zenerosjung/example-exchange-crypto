<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends BaseController
{
    public function index()
    {
        return $this->view('register.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:user,email',
            'password' => 'required|confirmed'
        ]);

        try {
            $data = $request->all();
            $data['password'] = Hash::make($data['password']);

            (new User($data))->save();

            return redirect()->back()
                ->with('success', 'User register successfully.');
        } catch (\Exception $e){
            return redirect()->back()
                ->with('error', 'Error.');
        }
    }
}
