<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'no_asset',
        'nama_equipment',
        'qty',
        'panjang',
        'lebar',
        'tinggi',
        'tahun',
        'tempat',
        'lokasi',
        'photo',
        'keterangan',
        'trash_status'
    ];
    public function total()
    {
        return $this->where('trash_status', 'tidak')->count();
    }
    public function baik()
    {
        return $this->where('trash_status', 'tidak')
            ->where('keterangan', 'baik')
            ->count();
    }
    public function sedang()
    {
        return $this->where('trash_status', 'tidak')
            ->where('keterangan', 'sedang')
            ->count();
    }
    public function buruk()
    {
        return $this->where('trash_status', 'tidak')
            ->where('keterangan', 'buruk')
            ->count();
    }
    public function Show()
    {
        return $this->where('trash_status', 'tidak')->latest()->get();
    }
    public function Trash()
    {
        return $this->where('trash_status', 'ya')->latest()->get();
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
