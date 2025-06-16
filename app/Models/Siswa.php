<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'nisn',
        'nama',
        'kelas',
        'jurusan',
    ];

    public function nilaiRapor()
    {
        return $this->hasOne(NilaiRapor::class, 'siswa_id');
    }

      public function hasilPrediksi()
    {
        return $this->hasOne(HasilPrediksi::class, 'siswa_id');
    }
}
