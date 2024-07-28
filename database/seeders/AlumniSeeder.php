<?php

// database/seeders/AlumniSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumni;

class AlumniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Alumni::create([
                'foto' => "alumni$i.jpg",
                'name' => "Alumni $i",
                'tahun_start' => '2010',
                'tahun_end' => '2014',
                'alamat' => "Jl. Alumni $i",
            ]);
        }
    }
}
