<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
        return $this->belongsTo(User::class,'user_id');
    }


    public function ta(){
        return $this->belongsTo(TA::class, 'nobp', 'nobp');
    }

    public function scopePencarian(Builder $query): void
    {
        //query->where('votes', '>', 100);
        if (request('search')){
            $query->where(function ($q) {
                $q->where('nobp', 'like', '%' . request('search') . '%')
                    ->orWhere('namalengkap', 'like', '%' . request('search') . '%')
                    ->orWhereHas('prodi', function ($q) {
                        $q->where('nama_prodi', 'like', '%' . request('search') . '%');
                    });
            });
        }
    }
}
