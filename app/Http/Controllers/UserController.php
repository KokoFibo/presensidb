<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function updateEmail(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'old_email' => 'required|email|exists:users,email',
            'new_email' => 'required|email|unique:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Ambil user berdasarkan email lama
        $user = User::where('email', $request->old_email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        // Update email
        $user->email = $request->new_email;
        $user->save();

        return response()->json([
            'message' => 'Email berhasil diupdate',
            'data' => $user
        ]);
    }
}
