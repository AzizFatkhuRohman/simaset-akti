<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role',
        'nama',
        'nim_noreg',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function pengambilan(){
        return $this->hasMany(Pengambilan::class,'user_id');
    }
    public function peminjaman(){
        return $this->hasMany(Peminjaman::class,'user_id');
    }
    public function UserData(){
        return $this->orderBy('nama')->get();
    }
    public function Show(){
        return $this->latest()->get();
    }
    public function Add($data){
        return $this->create($data);
    }
    public function Del($id){
        return $this->find($id)->delete();
    }
    public function Edit($id,$data){
        return $this->find($id)->update($data);
    }
}
