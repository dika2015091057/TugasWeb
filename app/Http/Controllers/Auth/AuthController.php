<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use function Laravel\Prompts\error;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // TODO View Register Page
    public function register()
    {
        return view('register');
    }

    // TODO User Register 
    public function registerPost(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->username = $request->username;
        $user->password = hash::make($request->password);
        $user->save();
        if ($user->fails) {
            return back()->with('error', 'email has');
        }
        // return back()->with('success', 'register successfuly');
        return redirect('/home');
    }


    // TODO View Login Page
    public function login()
    {
        return view('login');
    }

    // TODO User Login
    public function loginPost(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $auth = $request->admin;;
        if ($auth=='true'){
            
            if (Auth::guard('admin')->attempt($credentials)) {
                // Otentikasi berhasil untuk admin
                return redirect('/dashboardAdmin')->with('success', 'Login successful');
            }
            return back()->with('error', 'Email or password is incorrect');
        } 
        //return($credetials);
        if (Auth::guard('user')->attempt($credentials)) {
            // Otentikasi berhasil untuk admin
            return redirect('/home')->with('success', 'Login successful');
        }

        return back()->with('error', 'Email or password is incorrect');
    }


    //TODO User Or Admin Logout
    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
