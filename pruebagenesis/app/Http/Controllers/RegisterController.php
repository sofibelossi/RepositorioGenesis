<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Models\User;
class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required', 'string', 'max:255'],
            'email'=>['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'=>['required', 'confirmed', 'min:6', 'max:20']
        ]);
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);
        return to_route('login')->with('status', 'Cuenta creada');
    }

}
