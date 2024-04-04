<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Pengambilan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class PengambilanController extends Controller
{
    protected $pengambilan;
    protected $user;
    protected $equipment;
    public function __construct(Pengambilan $pengambilan, Equipment $equipment, User $user)
    {
        $this->pengambilan = $pengambilan;
        $this->equipment = $equipment;
        $this->user = $user;
    }
    public function get()
    {
        $title = 'Pengambilan barang';
        $collection = $this->pengambilan->Show();
        $eq = $this->equipment->Show();
        $nm = $this->user->UserData();
        return view('pengambilan.index', compact('title', 'collection', 'eq', 'nm'));
    }
    public function post(Request $request)
    {
        $val = Validator::make($request->all(), [
            'nama' => 'required',
            'status' => 'required',
            'jenis_barang' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required|max:200'
        ]);
        if ($val->fails()) {
            return redirect()->back()->withErrors($val);
        } else {
            $this->pengambilan->Store([
                'user_id' => $request->nama,
                'status' => $request->status,
                'jenis_barang' => $request->jenis_barang,
                'jumlah' => $request->jumlah,
                'keterangan' => $request->keterangan
            ]);
            return redirect()->back()->with('create', 'Create successfully');
        }

    }
    public function put(Request $request, $id)
    {
        $val = Validator::make($request->all(), [
            'jenis_barang' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required|max:200'
        ]);
        if ($val->fails()) {
            return redirect('pengambilan-barang')->withErrors($val);
        }
        $data = [
            'jenis_barang'=>$request->jenis_barang,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan
        ];
        $this->pengambilan->Edit($id, $data);
        return redirect('pengambilan-barang')->with('update', 'Updated Successfully');
    }
    public function destroy($id)
    {
        $this->pengambilan->Del($id);
        return redirect('pengambilan-barang')->with('delete', 'Deleted Successfully');
    }
    public function pengambilan(Request $request)
    {
        $val = Validator::make($request->all(), [
            'status' => 'required',
            'jenis_barang' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'required'
        ]);
        if ($val->fails()) {
            return redirect('dashboard')->withErrors($val);
        }
        $this->pengambilan->Store([
            'user_id' => Auth::user()->id,
            'status' => $request->status,
            'jenis_barang' => $request->jenis_barang,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan
        ]);
        return redirect('dashboard')->with('create','Create successfully');
    }
}
