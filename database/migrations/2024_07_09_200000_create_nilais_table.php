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
    Schema::create('nilais', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('sub_kriteria_id');
      $table->unsignedBigInteger('penilaian_id');
      $table->integer('nilai');
      $table->timestamps();
      $table
        ->foreign('sub_kriteria_id')
        ->references('id')
        ->on('sub_kriterias')
        ->onDelete('cascade');
      $table
        ->foreign('penilaian_id')
        ->references('id')
        ->on('penilaians')
        ->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('nilais');
  }
};
