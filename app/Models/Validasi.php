<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validasi extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function mahasiswa(){
        return $this->belongsTo(TA::class,'ta_id');
    }
}
