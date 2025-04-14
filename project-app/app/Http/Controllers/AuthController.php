<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
// use Illuminate\Foundation\Auth\User as Authenticatable;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }

    public function formLogin()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|exists:users,username|max:12',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            $user = Auth::guard('admin')->user(); // Use the same guard consistently
            if ($user->role == 'admin' || $user->role == 'ketua_kelas') {
                return redirect()->route('user');
            } else if ($user->role == 'bendahara') {
                return redirect()->route('siswa');
            } else if ($user->role == 'siswa') {
                $siswa = Siswa::where('user_id', $user->id)->first();
                if ($siswa) {
                    return redirect()->route('kelas');
                }
                return redirect()->route('siswa.create');
            }
        }

        return back()->withErrors([
            'password' => trans('validation.attributes.password-incorrect'),
            'username' => trans('validation.attributes.username-invalid'),
            'username' => trans('validation.attributes.username-incorrect'),
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
