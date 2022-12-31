<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthStaffController extends Controller
{
    public function login(Request $request)
    {
        // $validateData = $request->validate([
        //     'email' => 'required',
        //     'password' => 'required'
        // ]);
           
        if (auth()->attempt(request(['email','password']))==false) {
            
            return response()->json(['error' => 'Unauthorized']);
        }
           $user = Auth::user();
           $success['token'] =$user->createToken('API Token')->accessToken;
        return response()->json(['user'=>$user,'success'=>$success]);
    }
    
    public function register(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
           
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['msg'=>"success"]);
       
    }
}
