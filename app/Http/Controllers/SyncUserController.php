<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class SyncUserController extends Controller
{


    public function syncFromPayroll()
    {
        DB::table('users')->truncate();

        User::create([
            'name' => 'Anton Developer',
            'email' => 'kokonacci@gmail.com',
            'password' => Hash::make("YF2024Aja"),
            'company_name' => 'Kokofibo',
            'db_code' => 1,
            'role' => 8,
            'language' => 'Id',
            'id_karyawan' => 80000,
        ]);

        // Definisikan endpoint yang akan diakses
        $endpoints = [
            'https://payroll.yifang.co.id/api/users/export',
            'https://salary.yifang.co.id/api/users/export',
            'https://sti.yifang.co.id/api/users/export'
        ];

        $allUsers = [];
        $errors = [];

        foreach ($endpoints as $endpoint) {
            try {
                $response = Http::timeout(30)->get($endpoint);

                if ($response->successful()) {
                    $users = $response->json();
                    $allUsers = array_merge($allUsers, $users);
                } else {
                    $errors[] = "Gagal mengambil data dari: $endpoint - Status: " . $response->status();
                }
            } catch (\Exception $e) {
                $errors[] = "Error mengambil data dari $endpoint: " . $e->getMessage();
            }
        }

        // Jika semua endpoint gagal, return error
        if (empty($allUsers) && !empty($errors)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengambil data dari semua endpoint',
                'errors' => $errors
            ], 500);
        }

        $inserted = 0;
        $updated = 0;

        foreach ($allUsers as $u) {
            $user = User::updateOrCreate(
                ['id_karyawan' => $u['id_karyawan']],
                [
                    'name' => $u['name'],
                    'email' => $u['email'],
                    'password' => $u['password'],
                    'company_name' => $u['company_name'],
                    'db_code' => $u['db_code'],
                    'role' => $u['role'],
                    'language' => $u['language'] ?? 'Id',
                ]
            );

            if ($user->wasRecentlyCreated) {
                $inserted++;
            } else {
                $updated++;
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Sinkronisasi user selesai.',
            'inserted' => $inserted,
            'updated' => $updated,
            'total' => count($allUsers),
            'errors' => $errors, // Tetap tampilkan error jika ada
            'successful_endpoints' => count($endpoints) - count($errors)
        ]);
    }
    public function syncFromPayroll1()
    {
        DB::table('users')->truncate();

        User::create([
            'name' => 'Anton Developer',
            'email' => 'kokonacci@gmail.com',
            'password' => Hash::make("YF2024Aja"),
            'company_name' => 'Kokofibo',
            'db_code' => 1,
            'role' => 8,
            'language' => 'Id',
            'id_karyawan' => 80000,
        ]);


        // Ambil data user dari aplikasi Payroll (port 8000)
        $response = Http::get('http://localhost:8000/api/users/export');
        // $response = Http::get('https://payroll.yifang.co.id/api/users/export');
        // $response = Http::get('https://salary.yifang.co.id/api/users/export');
        // $response = Http::get('https://sti.yifang.co.id/api/users/export');

        if ($response->failed()) {
            return response()->json(['status' => 'error', 'message' => 'Gagal mengambil data dari Payroll'], 500);
        }

        $users = $response->json();
        $inserted = 0;
        $updated = 0;

        foreach ($users as $u) {
            $user = User::updateOrCreate(
                ['id_karyawan' => $u['id_karyawan']],
                [
                    'name' => $u['name'],
                    'email' => $u['email'],
                    'password' => $u['password'],
                    'company_name' => $u['company_name'],
                    'db_code' => $u['db_code'],
                    'role' => $u['role'],
                    'language' => $u['language'] ?? 'Id',
                ]
            );

            if ($user->wasRecentlyCreated) {
                $inserted++;
            } else {
                $updated++;
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Sinkronisasi user selesai.',
            'inserted' => $inserted,
            'updated' => $updated,
            'total' => count($users),
        ]);
    }
}
