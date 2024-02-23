<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|confirmed',
        ]);
    
        $user = new User([
            'user_name' => $request->input('user_name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'update_role' => now()->addDays(30)->toDateString(),
        ]);
    
        $user->save();
    
        return response()->json(['message' => 'Użytkownik zarejestrowany pomyślnie'], 201);
    }
    
}
