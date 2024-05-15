<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\password;

class UsersSider extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('123456789');

        DB::table('users')->insert([
            "name" => "Admin user",
            "email" => "admin@gmail.com",
            "password" => $password,
            "admin" => "1",
        ]);

        DB::table('users')->insert([
            "name" => "Cliente user",
            "email" => "cliente@gmail.com",
            "password" => $password,
            "admin" => "0",
        ]);
    }
}
