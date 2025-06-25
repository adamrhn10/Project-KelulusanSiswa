<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AturanDetail extends Model
{
     protected $table = 'aturan_detail';

    protected $fillable = ['aturan_id', 'kriteria_id', 'kategori'];

    public function aturan()
    {
        return $this->belongsTo(AturanFuzzy::class, 'aturan_id');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }   
}
