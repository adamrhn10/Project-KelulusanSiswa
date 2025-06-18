<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NilaiRapor extends Model
{
    use HasFactory;

    protected $table = 'nilai_rapor';

    protected $fillable = [
        'siswa_id',
        'rapor1',
        'rapor2',
        'rapor3',
        'rapor4',
        'rapor5',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
    
}
