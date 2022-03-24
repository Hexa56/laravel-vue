<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
class authController extends Controller
{
    function signup()
    {
        $validate = request()->validate([
        "name" => "required",
        "email" => "required|email|unique:users,email",
        'password' => "required|min:6",
        'confirm_password' => "required|min:6|same:password",
        ]);
  
        $add = new User();
        $add->name = request()->name;
        $add->email = request()->email;
        $add->password = Hash::make(request()->password);
        $add->save();
        return redirect('/');
    }

    function login()
    {
         $validate = request()->validate([
        "email" => "required|email",
        'password' => "required|min:6",
        ]);
  
        $check = User::where('email','=',request()->email)->get()->first();
        if(Hash::check(request()->password, $check->password))
        {
            request()->session()->put('user', $check);
        
            return redirect('/home');
        }


    }
}
