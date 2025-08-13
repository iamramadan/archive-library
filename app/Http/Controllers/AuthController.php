<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signin(Request $request){
        $IncomingField = $this->validate($request,[
            'email'=>'required|email||exists:users,email',
            'password'=>'required|min:8'
        ]);
            $auth = Auth::attempt(
                        $request->only('email','password'),
                    $request->filled('remember')
                );
        if ($auth) {
            return redirect()->route('index');
        }
        return back()->with('error','incorrect email or password');
    }
    public function signup(Request $request){
        $IncomingField = $this->validate($request,[
            'username'=>'unique:users,username|max:30|min:5|required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8',
            'password_confirmation'=>'required|same:password'
        ]);
        $IncomingField['password'] = Hash::make($IncomingField['password']);
        User::create($IncomingField);
            $auth = Auth::attempt(
                ['email' => $request->email, 'password' => $request->password],
                $request->filled('remember')
            );
        if ($auth) {
            return redirect()->route('index');
        }
        return back()->with('error','could not sign');
    }
    public function signinpage(){
        return view('auth.signin');
    }
    public function signuppage(){
        return view('auth.signup');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('index');
    }
}
