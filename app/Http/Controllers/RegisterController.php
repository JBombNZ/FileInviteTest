<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class RegisterController extends Controller
{
    /*
     * 
     */
    public function register(RegisterRequest $request)
    {
        $data = $request->all();
        
        $role = Role::where('name', $data['role'])->first();
        
        $model = new User();
        $model->name = $data['name'];
        $model->email = $data['email'];
        $model->password = Hash::make($data['password']);
        $model->role_id = $role->id;
        
        $model->save();
        
        return response()->json([
            'success' => true
        ]);
        
    }
}
