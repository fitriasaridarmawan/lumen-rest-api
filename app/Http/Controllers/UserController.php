<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        $this->middleware('auth');
    }

    public function register(Request $request)
    {
        //validasi 
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        //inputan body
        $email = $request->input('email');
        $password = $request->input('password');
        $hashPassword = Hash::make($password);  //hash password

        //menyimpan password
        $user = User::create([
            'email' => $email,
            'password' => $hashPassword
        ]);

        //send response after data has been all collected
        return response()->json(['message' => 'Success'],201);
    }

    public function profile()
    {
        return response()->json(['user' => auth()::user()],200);
    }

    //
}
