<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class TA extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class,'nobp', 'nobp');
    }
    public function Dpembimbing1(){
        return $this->belongsTo(Dosen::class,'pembimbing1');
    }
    public function Dpembimbing2(){
        return $this->belongsTo(Dosen::class,'pembimbing2');
    }
    
    public function validasi(){
        return $this->belongsTo(Validasi::class, 'id', 'ta_id');
    }

    // public function scopePencarian(Builder $query): void
    // {
    //     if (request('search')) {
    //         $query->where(function ($q) {
    //             $q->where('nobp', 'like', '%' . request('search') . '%')
    //                 ->orWhere('judul', 'like', '%' . request('search') . '%');
    //         });
    //     }
    // }

}
