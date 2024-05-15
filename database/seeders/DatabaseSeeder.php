<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            HorariosSeeder::class,
        ]);

        $this->call([
            ClienteSeeder::class,
        ]);

        $this->call([
            ColaboradorSeeder::class,
        ]);

        $this->call([
            tipo_servicoSeeder::class,
        ]);

        $this->call([
            MarcacaoSeeder::class,
        ]);

        $this->call([
            FaturaSeeder::class,
        ]);

        $this->call([
            UsersSider::class,
        ]);
    }
}
