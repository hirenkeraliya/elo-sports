<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function login()
    {
        return view('login');

    }

    public function registeraccount(Request $req)
    {

        $userExists = DB::table('user')->where('Email', $req->email)->orWhere('Username', $req->username)->first();

        if ($userExists == null) {
            $user = new Users();
            $req->validate([
                'email' => 'required|email|unique:users',
                'firstname' => 'required|alpha',
                'lastname' => 'required|alpha',
                'username' => 'required|unique:user',
                'password' => 'required',

            ]);

            $imageName = "avatar.jpg";
            if ($req->hasFile('profile')) {
                $req->validate(['profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg']);
                $imageName = time() . '.' . $req->profile->extension();
                $path = $req->profile->move(public_path('images'), $imageName);
            }

            $user->email = $req->email;
            $user->id = $req->id;
            $user->firstName = $req->firstname;
            $user->lastName = $req->lastname;
            $user->username = $req->username;
            $user->phone = $req->phone;
            $user->business_info = $req->business_info;
            $user->address = $req->address;
            $user->profile = $imageName;
            $user->stream_key = Str::replace("-", "", Str::orderedUuid());
            $user->password = Hash::make($req->password);
            $user->save();

            // user
            Auth::login($user);

            return redirect('/');

        } else {
            return redirect('/register');
        }
    }

    public function loginaccount(Request $req)
    {


        $req->validate([
            'username' => 'required',
            'password' => 'required',
        ]);


        $credentials = [
            'username' => $req['username'],
            'password' => $req['password'],
        ];

        // check auth
        if (Auth::attempt($credentials)) {
            if(auth()->user()->status == 1) {


                if(auth()->user()->user_type == 'admin') {
                    return redirect()->to('/dashboard');
                }
                return  redirect()->to('/');
            } else {
                auth()->logout();
                Session::flush();
                return redirect('/login');
            }

        }

        //
        session()->flash('error', 'Username and password does not exists in our database');

        // return redirect
        return redirect('/login');

    }

    public function logout()
    {
        auth()->logout();
        Session::flush();
        return redirect()->to('/');

    }
}
