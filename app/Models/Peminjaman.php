<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Peminjaman extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'peminjaman';
    protected $fillable = [
        'user_id',
        'no_aset',
        'jam_pinjam',
        'jam_pengembalian',
        'keterangan'
    ];
    public function Top()
    {
        return $this->with('user')->latest()->limit(5)->get();
    }
    public function ShowUserLimit()
    {
        return $this->where('user_id', Auth::user()->id)->limit(5)->latest()->get();
    }
    public function ShowUser()
    {
        return $this->where('user_id', Auth::user()->id)->latest()->get();
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function Show()
    {
        return $this->with('user')->latest()->get();
    }
    public function Store($data)
    {
        return $this->create($data);
    }
    public function Edit($id, $data)
    {
        return $this->find($id)->update($data);
    }
    public function Del($id)
    {
        return $this->find($id)->delete();
    }
}
