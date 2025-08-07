<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::post('/create-token', function () {
    $user = User::first();
    if ($user) {
        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            'success' => true,
            'token' => $token,
            'user' => $user->name
        ]);
    }
    return response()->json(['error' => 'No user found'], 404);
});
