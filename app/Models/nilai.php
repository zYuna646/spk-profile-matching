<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nilai extends Model
{
  use HasFactory;
  protected $fillable = ['sub_kriteria_id', 'nilai', 'penilaian_id'];

  public function sub_kriteria()
  {
    return $this->belongsTo(subKriteria::class);
  }
}
