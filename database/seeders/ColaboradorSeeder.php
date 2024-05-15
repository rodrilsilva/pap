<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColaboradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('colaborador')->insert([
            "nome" => "Kelly J. Moreland",
            "gen" => "2",
        ]);

        DB::table('colaborador')->insert([
            "nome" => "Margarida Zlata Afonso",
            "gen" => "2",
        ]);

        DB::table('colaborador')->insert([
            "nome" => "Antona Margarida",
            "gen" => "2",
        ]);
    }
}
