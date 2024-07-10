<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
  use HasFactory;
  protected $fillable = ['peserta_id', 'isKabupaten'];

  public function nilai()
  {
    return $this->hasMany(nilai::class);
  }
}
