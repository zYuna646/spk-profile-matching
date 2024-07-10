<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianProvinsi extends Model
{
  use HasFactory;
  protected $fillable = ['peserta_id', 'nilai_id'];
  public function nilai()
  {
    return $this->belongsTo(nilai::class);
  }
}
