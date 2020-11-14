<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Http\Resources\UserResource;

class LoginController extends Controller
{
    /*
     * 
     */
    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            return new UserResource(Auth::user());
        } 
        
        return response()->json([
            'success' => false,
            'message' => 'Invalid username or password'
        ], 422);        
        
    }
}
