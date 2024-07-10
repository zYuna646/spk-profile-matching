<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Pendaftaran;
use App\Models\Peserta;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // \App\Models\User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);

    //Role Seeder
    $this->call(IndoRegionSeeder::class);
    $this->call(KriteriaSeeder::class);
    $admin = Role::create([
      'name' => 'Admin',
    ]);
    $verificator = Role::create([
      'name' => 'verificator',
    ]);
    $penilai = Role::create([
      'name' => 'penilai',
    ]);
    $pimpinan = Role::create([
      'name' => 'pimpinan',
    ]);
    $peserta = Role::create([
      'name' => 'peserta',
    ]);

    User::create([
      'name' => 'admin',
      'email' => 'admin@gmail.com',
      'password' => bcrypt('admin'),
      'role_id' => $admin->id,
      'alamat' => 'sementara',
    ]);

    User::create([
      'name' => 'verificator',
      'email' => 'verificator@gmail.com',
      'password' => bcrypt('verificator'),
      'role_id' => $verificator->id,
      'alamat' => 'sementara',
    ]);

    User::create([
      'name' => 'penilai',
      'email' => 'penilai@gmail.com',
      'password' => bcrypt('penilai'),
      'role_id' => $penilai->id,
      'alamat' => 'sementara',
    ]);

    User::create([
      'name' => 'pimpinan',
      'email' => 'pimpinan@gmail.com',
      'password' => bcrypt('pimpinan'),
      'role_id' => $pimpinan->id,
      'alamat' => 'sementara',
    ]);

    $user = User::create([
      'name' => 'peserta',
      'email' => 'peserta@gmail.com',
      'password' => bcrypt('peserta'),
      'role_id' => $peserta->id,
      'alamat' => 'sementara',
    ]);

    Pendaftaran::create([
      'name' => 'ppn',
      'periode' => '2021',
    ]);

    $periode = Pendaftaran::create([
      'name' => 'pp',
      'periode' => '2020',
    ]);

    Peserta::create([
      'user_id' => $user->id,
      'jk' => 'L',
      'tgl_lahir' => '2000-01-01',
      'pendaftaran_id' => $periode->id,
    ]);
  }
}
