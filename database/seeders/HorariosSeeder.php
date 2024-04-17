<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HorariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('horarios')->insert([
            'id' => 1,
            'hora_inicio_manha' => '08:00:00',
            'hora_fim_manha' => '12:00:00',
            'hora_inicio_tarde' => '14:00:00',
            'hora_fim_tarde' => '18:00:00',
        ]);

        DB::table('horarios')->insert([
            'id' => 2,
            'hora_inicio_manha' => '08:30:00',
            'hora_fim_manha' => '12:30:00',
            'hora_inicio_tarde' => '14:30:00',
            'hora_fim_tarde' => '18:30:00',
        ]);

        DB::table('horarios')->insert([
            'id' => 3,
            'hora_inicio_manha' => '09:00:00',
            'hora_fim_manha' => '13:00:00',
            'hora_inicio_tarde' => '15:00:00',
            'hora_fim_tarde' => '19:00:00',
        ]);

        DB::table('horarios')->insert([
            'id' => 4,
            'hora_inicio_manha' => '09:30:00',
            'hora_fim_manha' => '13:30:00',
            'hora_inicio_tarde' => '15:30:00',
            'hora_fim_tarde' => '19:30:00',
        ]);

        DB::table('horarios')->insert([
            'id' => 5,
            'hora_inicio_manha' => '10:00:00',
            'hora_fim_manha' => '14:00:00',
            'hora_inicio_tarde' => '16:00:00',
            'hora_fim_tarde' => '20:00:00',
        ]);

        DB::table('horarios')->insert([
            'id' => 6,
            'hora_inicio_manha' => '10:30:00',
            'hora_fim_manha' => '14:30:00',
            'hora_inicio_tarde' => '16:30:00',
            'hora_fim_tarde' => '20:30:00',
        ]);

        DB::table('horarios')->insert([
            'id' => 7,
            'hora_inicio_manha' => '11:00:00',
            'hora_fim_manha' => '15:00:00',
            'hora_inicio_tarde' => '17:00:00',
            'hora_fim_tarde' => '21:00:00',
        ]);
    }
}