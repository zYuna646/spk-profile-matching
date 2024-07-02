<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
  }
}
