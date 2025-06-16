<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HasilPrediksi extends Model
{
    use HasFactory;

    protected $table = 'hasil_prediksi';

    protected $fillable = [
        'siswa_id',
        'hasil_prediksi',
        'nilai_fuzzy',
        'tanggal_prediksi',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
