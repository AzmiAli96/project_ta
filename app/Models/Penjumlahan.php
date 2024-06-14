<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjumlahan extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function nilai(){
        return $this->belongsTo(Nilai::class,'nilai_id');
    }
    
    public function scopeWithNilaiIdAndPenilai($query, $nilaiId, $penilai)
    {
        return $query->where('nilai_id', $nilaiId)->where('penilai', $penilai)->first();
    }
}
