<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilPrediksi extends Model
{
     protected $table = 'hasil_prediksi';

    protected $fillable = ['siswa_id', 'nilai_fuzzy', 'hasil_prediksi', 'tanggal_prediksi'];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
