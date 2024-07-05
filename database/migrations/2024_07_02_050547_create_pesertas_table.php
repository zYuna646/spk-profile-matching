<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('pesertas', function (Blueprint $table) {
      $table->id();
      $table->string('foto')->nullable();
      $table
        ->foreignId('user_id')
        ->constrained('users')
        ->onDelete('cascade');
      $table
        ->foreignId('pendaftaran_id')
        ->constrained('pendaftarans')
        ->onDelete('cascade');
      $table->string('jk');
      $table->date('tgl_lahir');
      $table->string('agama')->nullable();
      $table->string('asal')->nullable();
      $table->string('no_tlp')->nullable();
      $table->string('sosial_media')->nullable();
      $table->string('pekerjaan')->nullable();
      $table->text('latar_belakang')->nullable();
      $table->boolean('isAnggota')->default(false);
      $table->string('name_organisasi')->nullable();
      $table->text('desc_organisasi')->nullable();
      $table->string('peran_organisasi')->nullable();
      $table->text('desc_essai')->nullable();
      $table->boolean('isPertukaran')->default(false);
      $table->text('motivasi_essai')->nullable();
      $table->string('file_ktp')->nullable();
      $table->string('file_cv')->nullable();
      $table->string('file_ijazah')->nullable();
      $table->json('file_kegiatan_sosial')->nullable();
      $table->string('file_score_report')->nullable();
      $table->json('file_penghargaan')->nullable();
      $table->enum('status_berkas', ['belum', 'proses', 'tolak', 'terima'])->default('belum');
      $table->string('kabupaten_id')->nullable();
      $table->string('provinsi_id')->nullable();
      $table
        ->foreign('kabupaten_id')
        ->references('id')
        ->on('regencies')
        ->onDelete('cascade');
      $table
        ->foreign('provinsi_id')
        ->references('id')
        ->on('provinces')
        ->onDelete('cascade');

      $table
        ->enum('status', [
          'peserta-baru',
          'mengajukan-berkas',
          'lolos-seleksi-provinsi',
          'gugur-seleksi-umum',
          'gugur-seleksi-kabupaten',
          'gugur-seleksi-provinsi',
        ])
        ->default('peserta-baru');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('pesertas');
  }
};
