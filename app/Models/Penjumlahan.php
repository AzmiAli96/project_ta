<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjumlahan extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function nilai(){
        return $this->belongsTo(sidang::class,'nilai_id');
    }

    
}
