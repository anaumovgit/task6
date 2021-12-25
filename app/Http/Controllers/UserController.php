<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'password_show' => $request->password,
        ]);
        session()->flash('success', 'Successful registration!');
        Auth::login($user);
        return redirect()->route('homepage');
    }

    public function loginForm()
    {
        return view('user.login');
    }

    public function  login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt([
            'name' => $request->name,
            'password' => $request->password
        ])) {
            $user = Auth::user();
            if ($user->status == 'blocked') {
                Auth::logout();
                return redirect()->back()->with('error', 'Your account is blocked');
            }
            else {
                $user->auth_at = new \DateTime();
                $user->save();
                return redirect()->route('homepage');
            }
        }
        else {
            return redirect()->back()->with('error', 'Incorrect username or password');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.create');
    }

    public function block(Request $request)
    {
        $ids = $request->ids;
        $users = User::all();
        if (!empty($users) && $ids != null) {
            for ($i = 0; $i < count($ids); $i++) {
                $user = User::where('id', $ids[$i])->first();
                $user->status = 'blocked';
                $user->save();
            }
        }
        session()->flash('success', 'Successful!');
        return redirect('/');

    }

    public function unblock(Request $request)
    {
        $ids = $request->ids;
        $users = User::all();
        if (!empty($users) && $ids != null) {
            for ($i = 0; $i < count($ids); $i++) {
                $user = User::where('id', $ids[$i])->first();
                $user->status = 'active';
                $user->save();
            }
        }
        session()->flash('success', 'Successful!');
        return redirect('/');
    }

    public function delete(Request $request)
    {
        $ids = $request->ids;
        $users = User::all();
        if (!empty($users) && $ids != null) {
            for ($i = 0; $i < count($ids); $i++) {
                $user = User::where('id', $ids[$i])->first();
                $user->delete();
            }
        }
        session()->flash('success', 'Successful!');
        return redirect('/');
    }
}
