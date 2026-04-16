<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Anton Developer',
            'email' => 'kokonacci@gmail.com',
            'password' => Hash::make("YF2024Aja"),
            'company_name' => 'Kokofibo',
            'db_code' => 'salary',
            'role' => 8,
            'language' => 'Id',
            'id_karyawan' => 80000,
        ]);
    }
}
