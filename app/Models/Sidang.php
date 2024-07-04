<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sidang extends Model
{
    use HasFactory;
    protected $guarded=[];

    // public function validasi(){
    //     return $this->belongsTo(Validasi::class,'validasi_id');
    // }
    public function ta(){
        return $this->belongsTo(TA::class,'ta_id');
    }

    public function jadwal(){
        return $this->belongsTo(tanggal::class,'tanggal_id');
    }

    public function psek_sidang(){
        return $this->belongsTo(Dosen::class,'sekr_sidang');
    }

    public function panggota1(){
        return $this->belongsTo(Dosen::class,'anggota1');
    }

    public function panggota2(){
        return $this->belongsTo(Dosen::class,'anggota2');
    }

    public function nilai(){
        return $this->hasMany(nilai::class,'sidang_id', 'id');
    }

    public function nilaiPembimbing1(){
        return $this->hasMany(Nilai::class, 'sidang_id', 'id')->where('penilai', 'pembimbing1');
    }
    public function nilaiPembimbing2(){
        return $this->hasMany(Nilai::class, 'sidang_id', 'id')->where('penilai', 'pembimbing2');
    }
    public function nilaiketua(){
        return $this->hasMany(Nilai::class, 'sidang_id', 'id')->where('penilai', 'ketua');
    }
    public function nilaisekretaris(){
        return $this->hasMany(Nilai::class, 'sidang_id', 'id')->where('penilai', 'sekretaris');
    }
    public function nilaianggota1(){
        return $this->hasMany(Nilai::class, 'sidang_id', 'id')->where('penilai', 'anggota1');
    }
    public function nilaianggota2(){
        return $this->hasMany(Nilai::class, 'sidang_id', 'id')->where('penilai', 'anggota2');
    }


}
