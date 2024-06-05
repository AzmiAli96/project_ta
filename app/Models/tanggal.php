<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tanggal extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function sesi(){
        return $this->belongsTo(Sesi::class,'sesi_id');
    }

    public function ruangan(){
        return $this->belongsTo(Ruangan::class,'ruangan_id');
    }

    public function nama_status(){
        if ($this->status=='1') {
            return 'isi';
        }
        return 'kosong';
    }
}
