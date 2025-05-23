<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'level',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function mahasiswa(){
       return $this->hasOne(Mahasiswa::class,'user_id');
    }

    public function dosen(){
        return $this->hasOne(Dosen::class, 'user_id');
    }

    // public function scopePencarian(Builder $query): void
    // {
    //     if (request('search')) {
    //         $query->where(function ($q) {
    //             $q->where('name', 'like', '%' . request('search') . '%')
    //                 ->orWhere('email', 'like', '%' . request('search') . '%')
    //                 ->orWhere('level', 'like', '%' . request('search') . '%');
    //         });
    //     }
    // }
}
