<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use Validator;

class EquipmentController extends Controller
{
    protected $equipment;
    public function __construct(Equipment $equipment)
    {
        $this->equipment = $equipment;
    }
    public function get()
    {
        $title = 'Equipment';
        $collection = $this->equipment->Show();
        return view('equipment.index', compact('title', 'collection'));
    }
    public function post(Request $request)
    {
        $val = Validator::make($request->all(), [
            'no_asset' => 'required|unique:equipment',
            'nama_equipment' => 'required',
            'qty' => 'required',
            'panjang' => 'required|numeric',
            'lebar' => 'required|numeric',
            'tinggi' => 'required|numeric',
            'tahun' => 'required|numeric',
            'tempat' => 'required',
            'lokasi' => 'required',
            'gambar' => 'required|image|mimes:jpg,jpeg,png',
            'keterangan' => 'required'
        ]);
        if ($val->fails()) {
            return redirect()->back()->withErrors($val);
        }
        $gambar = $request->file('gambar');
        $nama_gambar = $gambar->getClientOriginalName();
        $gambar->move(public_path('equipment'), $nama_gambar);
        $this->equipment->Store([
            'no_asset' => $request->no_asset,
            'nama_equipment' => $request->nama_equipment,
            'qty' => $request->qty,
            'panjang' => $request->panjang,
            'lebar' => $request->lebar,
            'tinggi' => $request->tinggi,
            'tahun' => $request->tahun,
            'tempat' => $request->tempat,
            'lokasi' => $request->lokasi,
            'photo' => $nama_gambar,
            'keterangan' => $request->keterangan
        ]);
        return redirect()->back()->with('create', 'Create successfully');
    }
    public function put($id, Request $request)
    {
        $val = Validator::make($request->all(), [
            'no_asset' => 'required',
            'nama_equipment' => 'required',
            'qty' => 'required',
            'panjang' => 'required|numeric',
            'lebar' => 'required|numeric',
            'tinggi' => 'required|numeric',
            'tahun' => 'required|numeric',
            'tempat' => 'required',
            'lokasi' => 'required',
            'keterangan' => 'required'
        ]);
        if ($val->fails()) {
            return redirect('data-equipment')->withErrors($val);
        }
        $data = [
            'no_asset' => $request->no_asset,
            'nama_equipment' => $request->nama_equipment,
            'qty' => $request->qty,
            'panjang' => $request->panjang,
            'lebar' => $request->lebar,
            'tinggi' => $request->tinggi,
            'tahun' => $request->tahun,
            'tempat' => $request->tempat,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan
        ];
        $this->equipment->Edit($id, $data);
        return redirect('data-equipment')->with('update', 'Update successfully');
    }
    public function trash($id)
    {
        $data = [
            'trash_status' => 'ya'
        ];
        $this->equipment->Edit($id, $data);
        return redirect('data-equipment')->with('trash', 'Delete successfully');
    }
    public function getTrash()
    {
        $title = 'Trash';
        $collection = $this->equipment->Trash();
        return view('trash.index', compact('title', 'collection'));
    }
    public function restore($id)
    {
        $this->equipment->Edit($id, [
            'trash_status' => 'tidak'
        ]);
        return redirect('data-equipment')->with('update', 'Restore data successfully');
    }
    public function permanently($id)
    {
        $this->equipment->Del($id);
        return redirect('trash')->with('delete', 'Delete successfully');
    }
    public function filter(Request $request)
    {
        $title = 'Equipment';
        $collection = Equipment::where('keterangan', $request->filter)->get();
        return view('equipment.index', compact('title', 'collection'));
    }
}
