<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
     protected $table = 'kriteria';

    protected $fillable = ['kode', 'nama_kriteria'];

    public function nilaiSiswa()
    {
        return $this->hasMany(NilaiSiswa::class);
    }

    public function subKriteria()
    {
        return $this->hasMany(SubKriteria::class);
    }

    public function aturanDetails()
    {
        return $this->hasMany(AturanDetail::class);
    }
}
