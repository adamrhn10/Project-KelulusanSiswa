<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AturanFuzzy extends Model
{
     protected $table = 'aturan_fuzzy';
    
    protected $fillable = [
        'rapor1', 'rapor2', 'rapor3', 'rapor4', 'rapor5', 'output'
    ];
}
