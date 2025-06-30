<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AturanFuzzy extends Model
{
    protected $table = 'aturan_fuzzy';

    protected $fillable = ['output'];

    public function detail()
    {
        return $this->hasMany(AturanDetail::class, 'aturan_id');
    }
    
    public function details()
    {
        return $this->detail(); 
    }
}
