<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
