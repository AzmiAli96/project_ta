<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prodi extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function jurusan(){
        return $this->belongsTo(jurusan::class,'jurusan_id');
    }
    public function pkaprodi(){
        return $this->belongsTo(dosen::class,'kaprodi');
    }
    // public function prodip($jurusan ){
    //     return self::where('jurusan_id',$jurusan);
    // }
    
}
