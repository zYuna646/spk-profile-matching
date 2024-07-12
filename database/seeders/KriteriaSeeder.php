<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use App\Models\subKriteria;
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
      'bobot' => 0.2,
    ]);
    $keagamaan = Kriteria::create([
      'name' => 'Keagamaan',
      'bobot' => 0.2,
    ]);
    $condev = Kriteria::create([
      'name' => 'Condev',
      'bobot' => 0.2,
    ]);
    $wawasan = Kriteria::create([
      'name' => 'Wawasan Kebangsaan',
      'bobot' => 0.2,
    ]);
    $public = Kriteria::create([
      'name' => 'Public Speaking',
      'bobot' => 0.1,
    ]);
    $art = Kriteria::create([
      'name' => 'Art And Culture',
      'bobot' => 0.1,
    ]);

    $item = [
      ['name' => 'sk1', 'bobot' => 3, 'kriteria_id' => $team->id, 'isCF' => true],
      ['name' => 'sk2', 'bobot' => 4, 'kriteria_id' => $team->id, 'isCF' => true],
      ['name' => 'sk3', 'bobot' => 4, 'kriteria_id' => $team->id, 'isCF' => false],
      ['name' => 'sk4', 'bobot' => 5, 'kriteria_id' => $keagamaan->id, 'isCF' => true],
      ['name' => 'sk5', 'bobot' => 4, 'kriteria_id' => $keagamaan->id, 'isCF' => true],
      ['name' => 'sk6', 'bobot' => 5, 'kriteria_id' => $keagamaan->id, 'isCF' => false],
      ['name' => 'sk7', 'bobot' => 4, 'kriteria_id' => $condev->id, 'isCF' => true],
      ['name' => 'sk8', 'bobot' => 4, 'kriteria_id' => $condev->id, 'isCF' => true],
      ['name' => 'sk9', 'bobot' => 3, 'kriteria_id' => $condev->id, 'isCF' => false],
      ['name' => 'sk10', 'bobot' => 3, 'kriteria_id' => $wawasan->id, 'isCF' => true],
      ['name' => 'sk11', 'bobot' => 4, 'kriteria_id' => $wawasan->id, 'isCF' => true],
      ['name' => 'sk12', 'bobot' => 4, 'kriteria_id' => $wawasan->id, 'isCF' => false],
      ['name' => 'sk13', 'bobot' => 3, 'kriteria_id' => $public->id, 'isCF' => true],
      ['name' => 'sk14', 'bobot' => 4, 'kriteria_id' => $public->id, 'isCF' => true],
      ['name' => 'sk15', 'bobot' => 5, 'kriteria_id' => $public->id, 'isCF' => false],
      ['name' => 'sk16', 'bobot' => 5, 'kriteria_id' => $art->id, 'isCF' => true],
      ['name' => 'sk17', 'bobot' => 4, 'kriteria_id' => $art->id, 'isCF' => true],
      ['name' => 'sk18', 'bobot' => 5, 'kriteria_id' => $art->id, 'isCF' => false],
    ];
    foreach ($item as $key => $value) {
      subKriteria::create($value);
    }
  }
}
