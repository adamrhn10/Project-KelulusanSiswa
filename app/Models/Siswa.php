<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = ['nisn', 'nama_siswa', 'kelas', 'jurusan', 'tahun_ajaran'];

    public function nilaiSiswa()
    {
        return $this->hasMany(NilaiSiswa::class);
    }

    public function hasilPrediksi()
    {
        return $this->hasOne(HasilPrediksi::class);
    }
}
