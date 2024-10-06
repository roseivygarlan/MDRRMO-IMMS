<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'=>'MDRRMO_Admin',
                'email'=>'admin@example.com',
                'phone'=>'09314141222',
                'address'=>'MDRRMO - Bulan',
                'position'=>'Administrator',
                'started_at'=> Now(),
                'status'=>'Activated',
                'type' => '1111',
                'password' => Hash::make('admin12345'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'=>'Brgy. Obrero',
                'email'=>'obrero@example.com',
                'phone'=>'09314141111',
                'address'=>'Obrero Bulan Sorsogon',
                'position'=>'Barangay',
                'started_at'=> Now(),
                'status'=>'Activated',
                'type' => '1010',
                'password' => Hash::make('obrero12345'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'=>'Brgy. Otavi',
                'email'=>'otavi@example.com',
                'phone'=>'09314141666',
                'address'=>'Otavi Bulan Sorsogon',
                'position'=>'Barangay',
                'started_at'=> Now(),
                'status'=>'Activated',
                'type' => '1010',
                'password' => Hash::make('otavi12345'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            $userId = DB::table('users')->insert($user);
        }
    }
}
