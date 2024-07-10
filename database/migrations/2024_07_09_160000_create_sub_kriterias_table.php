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
    Schema::create('sub_kriterias', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->unsignedBigInteger('kriteria_id');
      $table->integer('bobot');
      $table
        ->foreign('kriteria_id')
        ->references('id')
        ->on('kriterias')
        ->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('sub_kriterias');
  }
};
