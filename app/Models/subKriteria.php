<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subKriteria extends Model
{
  use HasFactory;

  protected $fillable = ['name', 'bobot', 'kriteria_id', 'isCF'];
  public function kriteria()
  {
    return $this->belongsTo(Kriteria::class);
  }

  public function nilai()
  {
    return $this->hasMany(nilai::class);
  }
}
