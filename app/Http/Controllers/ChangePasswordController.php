<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.changePassword');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('posts.index')->with('success', 'Success, Password has changed');
    }

    public function edit()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('auth.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword]
        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->name = request('name');
        User::find(auth()->user()->id)->update(['name' => $user->name]);

        return redirect()->route('posts.index')->with('success', 'Success, Details has changed');
    }
}