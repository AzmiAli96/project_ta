<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TA extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class,'nobp');
    }
    public function Dpembimbing1(){
        return $this->belongsTo(Dosen::class,'pembimbing1');
    }
    public function Dpembimbing2(){
        return $this->belongsTo(Dosen::class,'pembimbing2');
    }


}
