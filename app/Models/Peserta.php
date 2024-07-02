<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
  use HasFactory;

  protected $fillable = [
    'user_id',
    'jk',
    'tgl_lahir',
    'agama',
    'asal',
    'no_tlp',
    'sosial_media',
    'pekerjaan',
    'latar_belakang',
    'isAnggota',
    'name_organisasi',
    'desc_organisasi',
    'peran_organisasi',
    'desc_essai',
    'isPertukaran',
    'motivasi_essai',
    'file_ktp',
    'file_cv',
    'file_ijazah',
    'file_kegiatan_sosial',
    'file_score_report',
    'file_penghargaan',
    'status',
    'pendaftaran_id',
  ];

  protected $casts = [
    'file_kegiatan_sosial' => 'array',
    'file_penghargaan' => 'array',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
