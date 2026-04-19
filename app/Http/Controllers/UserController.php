<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'required|string|min:6',
            'db_code' => 'required|string',
            'id_karyawan' => 'required|integer',
            'role' => 'required|integer',
            'language' => 'required|string',
            'outsource' => 'required|integer',
            'company_name' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'db_code' => $request->db_code,
            'id_karyawan' => $request->id_karyawan,
            'role' => $request->role,
            'language' => $request->language,
            'outsource' => $request->outsource,
            'company_name' => $request->company_name,
        ]);

        return response()->json([
            'message' => 'User berhasil dibuat',
            'data' => $user
        ], 201);
    }

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



    public function destroyByKaryawan($id_karyawan)
    {
        $user = User::where('id_karyawan', $id_karyawan)->first();

        if (!$user) {
            return response()->json([
                'message' => 'User tidak ditemukan'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'message' => 'User berhasil dihapus'
        ], 200);
    }
}
