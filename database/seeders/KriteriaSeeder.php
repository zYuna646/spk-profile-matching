<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $team = Kriteria::create([
      'name' => 'Team Building',
    ]);
    $keagamaan = Kriteria::create([
      'name' => 'Keagamaan',
    ]);
    $condev = Kriteria::create([
      'name' => 'Condev',
    ]);
    $wawasan = Kriteria::create([
      'name' => 'Wawasan Kebangsaan',
    ]);
    $public = Kriteria::create([
      'name' => 'Public Speaking',
    ]);
    $art = Kriteria::create([
      'name' => 'Art And Culture',
    ]);

    $team
      ->subKriteria()
      ->createMany([
        ['name' => 'sk1', 'bobot' => 3, 'kriteria_id' => $team->id],
        ['name' => 'sk2', 'bobot' => 4, 'kriteria_id' => $team->id],
        ['name' => 'sk3', 'bobot' => 4, 'kriteria_id' => $team->id],
        ['name' => 'sk4', 'bobot' => 5, 'kriteria_id' => $keagamaan->id],
        ['name' => 'sk5', 'bobot' => 4, 'kriteria_id' => $keagamaan->id],
        ['name' => 'sk6', 'bobot' => 5, 'kriteria_id' => $keagamaan->id],
        ['name' => 'sk7', 'bobot' => 4, 'kriteria_id' => $condev->id],
        ['name' => 'sk8', 'bobot' => 4, 'kriteria_id' => $condev->id],
        ['name' => 'sk9', 'bobot' => 3, 'kriteria_id' => $condev->id],
        ['name' => 'sk10', 'bobot' => 3, 'kriteria_id' => $wawasan->id],
        ['name' => 'sk11', 'bobot' => 4, 'kriteria_id' => $wawasan->id],
        ['name' => 'sk12', 'bobot' => 4, 'kriteria_id' => $wawasan->id],
        ['name' => 'sk13', 'bobot' => 3, 'kriteria_id' => $public->id],
        ['name' => 'sk14', 'bobot' => 4, 'kriteria_id' => $public->id],
        ['name' => 'sk15', 'bobot' => 5, 'kriteria_id' => $public->id],
        ['name' => 'sk16', 'bobot' => 5, 'kriteria_id' => $art->id],
        ['name' => 'sk17', 'bobot' => 4, 'kriteria_id' => $art->id],
        ['name' => 'sk18', 'bobot' => 5, 'kriteria_id' => $art->id],
      ]);
  }
}
