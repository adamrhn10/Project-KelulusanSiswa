<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    protected $table = 'sub_kriteria';

    protected $fillable = ['kriteria_id', 'kategori', 'titik_a', 'titik_b', 'titik_c'];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}
