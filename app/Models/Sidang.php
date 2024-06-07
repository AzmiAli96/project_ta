<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sidang extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function validasi(){
        return $this->belongsTo(Validasi::class,'validasi_id');
    }

    public function jadwal(){
        return $this->belongsTo(tanggal::class,'tanggal_id');
    }
    
    public function psek_sidang(){
        return $this->belongsTo(Dosen::class,'sekr_sidang');
    }

    public function anggota1(){
        return $this->belongsTo(Dosen::class,'anggota1');
    }

    public function anggota2(){
        return $this->belongsTo(Dosen::class,'anggota2');
    }
}
