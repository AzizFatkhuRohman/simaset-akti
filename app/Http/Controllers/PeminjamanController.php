<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class PeminjamanController extends Controller
{
    protected $peminjaman;
    protected $user;
    protected $equipment;
    public function __construct(Peminjaman $peminjaman, User $user, Equipment $equipment)
    {
        $this->peminjaman = $peminjaman;
        $this->user = $user;
        $this->equipment = $equipment;
    }
    public function get()
    {
        $title = 'Peminjaman';
        $collection = $this->peminjaman->Show();
        $nm = $this->user->UserData();
        $eq = $this->equipment->Show();
        return view('peminjaman.index', compact('title', 'collection', 'nm', 'eq'));
    }
    public function post(Request $request)
    {
        $val = Validator::make($request->all(), [
            'nama' => 'required',
            'no_aset' => 'required',
            'jam_pinjam' => 'required',
            'keterangan' => 'required'
        ]);
        if ($val->fails()) {
            return redirect()->back()->withErrors($val);
        }
        $this->peminjaman->Store([
            'user_id' => $request->nama,
            'no_aset' => $request->no_aset,
            'jam_pinjam' => $request->jam_pinjam,
            'keterangan' => $request->keterangan
        ]);
        return redirect()->back()->with('create', 'Create Successfully');
    }
    public function put(Request $request, $id)
    {
        $val = Validator::make($request->all(), [
            'jam_pinjam' => 'required',
            'keterangan' => 'required'
        ]);
        if ($val->fails()) {
            return redirect('peminjaman-barang')->withErrors($val);
        }
        $this->peminjaman->Edit($id, [
            'jam_pinjam' => $request->jam_pinjam,
            'jam_pengembalian' => $request->jam_pengembalian,
            'keterangan' => $request->keterangan
        ]);
        return redirect('peminjaman-barang')->with('update', 'Update successfully');
    }
    public function peminjaman(Request $request)
    {
        $val = Validator::make($request->all(), [
            'no_aset' => 'required',
            'jam_pinjam' => 'required',
            'keterangan' => 'required'
        ]);
        if ($val->fails()) {
            return redirect('dashboard')->withErrors($val);
        }
        $this->peminjaman->Store([
            ''
        ]);
    }
    public function destroy($id)
    {
        $this->peminjaman->Del($id);
        return redirect('peminjaman-barang')->with('delete', 'Delete successfully');
    }
    public function getUser(){
        $title = 'Dashboard';
        $collection = $this->peminjaman->ShowUser();
        return view('peminjaman.user',compact('title','collection'));
    }
}
