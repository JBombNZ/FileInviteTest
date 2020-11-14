<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /*
     * 
     */
    public function index(Request $request)
    {
        return new UserResource(Auth::user());
    }
    
}
