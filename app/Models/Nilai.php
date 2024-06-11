<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function sidang(){
        return $this->belongsTo(sidang::class,'sidang_id');
    }
}
