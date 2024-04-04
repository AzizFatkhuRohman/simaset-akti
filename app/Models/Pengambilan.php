<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Pengambilan extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'pengambilan';
    protected $fillable = [
        'user_id',
        'status',
        'jenis_barang',
        'jumlah',
        'keterangan'
    ];
    public function Top()
    {
        return $this->with('user')->limit(5)->latest()->get();
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
