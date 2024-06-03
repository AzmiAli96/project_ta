<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(user::class,'user_id');
    }

    public function Dkajur()
    {
        return $this->hasOne(Jurusan::class, 'kajur');
    }
    public function Dsekjur()
    {
        return $this->hasOne(Jurusan::class, 'sekjur');
    }

    public function Dkaprodi()
    {
        return $this->hasOne(prodi::class, 'kaprodi');
    }
}
