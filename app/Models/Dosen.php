<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(user::class, 'user_id');
    }

    public function Dkajur()
    {
        return $this->hasOne(Jurusan::class, 'kajur');
    }
    public function Dsekjur()
    {
        return $this->hasOne(Jurusan::class, 'sekjur');
    }
    public function Ppembimbing1()
    {
        return $this->hasOne(TA::class, 'pembimbing1');
    }
    public function Ppembimbing2()
    {
        return $this->hasOne(TA::class, 'pembimbing2');
    }

    public function Dkaprodi()
    {
        return $this->hasOne(prodi::class, 'kaprodi');
    }

    public function scopePencarian(Builder $query): void
    {
        if (request('search')) {
            $query->where(function ($q) {
                $q->where('nidn', 'like', '%' . request('search') . '%')
                    ->orWhere('no_telp', 'like', '%' . request('search') . '%')
                    ->orWhere('alamat', 'like', '%' . request('search') . '%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . request('search') . '%')
                        ->orwhere('email', 'like', '%'. request('search') . '%');
                    });
            });
        }
    }
}
