<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(user::class,'user_id');
    }

    public function pkajur(){
        return $this->belongsTo(dosen::class,'kajur');
    }

    public function psekjur(){
        return $this->belongsTo(dosen::class,'sekjur');
    }
    

    // public function pembimbing(){
    //     return [$this->pembimbing1,$this->pembimbing2 ];
    // }

    // @foreach ($ta->pembimbing() as $dosen)
    //             <option value="{{$dosen->id}}">{{$dosen->user->name}}</option>
    //             @endforeach
}
