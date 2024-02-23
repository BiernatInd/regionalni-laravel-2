<?php

namespace App\Http\Controllers\AdminPanel\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function downloadUsersList()
    {
        $users = User::all();
    
        return response()->json([
            'users' => $users,
        ]);
    }

    public function deleteUser($id) {
        $users = User::where('id', $id)->first();
    
        if (!$users) {
            return response()->json(['error' => 'Użytkownik nie został znaleziony.'], 404);
        }
    
        $users->delete();
    
        return response()->json(['message' => 'Użytkownik został prawidłowo usunięty.']);
    }
}
