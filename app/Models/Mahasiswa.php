<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function prodi(){
        return $this->belongsTo(prodi::class,'prodi_id');
    }

    public function jurusan(){
        return $this->belongsTo(jurusan::class,'jurusan_id');
    }

    public function user(){
        return $this->belongsTo(user::class,'user_id');
    }

    public function status(){
        return $this->belongsTo(status::class,'status_id');
    }

    public function ta(){
        return $this->belongsTo(TA::class, 'nobp', 'nobp');
    }
}
