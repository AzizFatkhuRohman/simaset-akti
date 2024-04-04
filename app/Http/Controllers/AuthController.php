<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    protected $user;
    public function __construct(\App\Models\User $user)
    {
        $this->user = $user;
    }
    public function get()
    {
        $title = 'Login';
        return view('auth.login', compact('title'));
    }
    public function login(Request $request)
    {
        $val = Validator::make($request->all(), [
            'nim_noreg' => 'required',
            'password' => 'required'
        ]);
        if ($val->fails()) {
            return redirect()->back()->withErrors($val);
        }
        if (Auth::attempt($request->only('nim_noreg', 'password'))) {
            if (Auth::user()->role == 'admin') {
                return redirect()->intended('/');
            } else {
                return redirect()->intended('dashboard');
            }

        } else {
            return redirect()->back()->with('failed', 'Email atau password salah!');
        }

    }
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
    public function user()
    {
        $title = 'User';
        $collection = $this->user->Show();
        return view('user.index', compact('title', 'collection'));
    }
    public function add(Request $request)
    {
        $val = Validator::make($request->all(), [
            'nama' => 'required',
            'nim_noreg' => 'required|unique:users',
            'password' => 'required|min:4',
            'role' => 'required'
        ]);
        if ($val->fails()) {
            return redirect()->back()->withErrors($val);
        } else {
            $this->user->Add([
                'role' => $request->role,
                'nama' => $request->nama,
                'nim_noreg' => $request->nim_noreg,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->back()->with('create', 'Create successfully');
        }

    }
    public function destroy($id)
    {
        $this->user->Del($id);
        return redirect('data-user')->with('Delete', 'Delete Successfully');
    }
    public function put(Request $request, $id)
    {
        $val = Validator::make($request->all(), [
            'nama' => 'required',
            'nim_noreg' => 'required',
            'role' => 'required'
        ]);
        if ($val->fails()) {
            return redirect('data-user')->withErrors($val);
        } else {
            $this->user->Edit($id, [
                'nama' => $request->nama,
                'nim_noreg' => $request->nim_noreg,
                'role' => $request->role
            ]);
            return redirect('data-user')->with('create', 'Create Successfully');
        }

    }
}
