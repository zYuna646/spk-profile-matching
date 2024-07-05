al<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('alumnis', function (Blueprint $table) {
      $table->id();
      $table->string('foto')->nullable();
      $table->string('name');
      $table->string('tahun_start');
      $table->string('tahun_end');
      $table->string('alamat');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('alumnis');
  }
};
