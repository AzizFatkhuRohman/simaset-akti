<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Peminjaman;
use App\Models\Pengambilan;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected $equipment;
    protected $peminjaman;
    protected $pengambilan;
    public function __construct(Equipment $equipment, Peminjaman $peminjaman,Pengambilan $pengambilan){
        $this->equipment = $equipment;
        $this->peminjaman = $peminjaman;
        $this->pengambilan = $pengambilan;
    }
    public function index(){
        $title = 'Dashboard';
        $total = $this->equipment->total();
        $baik = $this->equipment->baik();
        $sedang = $this->equipment->sedang();
        $buruk = $this->equipment->buruk();
        $collection = $this->peminjaman->Top();
        $collecP = $this->pengambilan->Top();
        return view('index',compact('title','total','baik','sedang','buruk','collection','collecP'));
    }
    public function dashboard(){
        $title = 'Dashboard';
        $pengambilan = $this->pengambilan->ShowUserLimit();
        $peminjaman = $this->peminjaman->ShowUserLimit();
        $eq = $this->equipment->Show();
        return view('dashboard',compact('title','pengambilan','peminjaman','eq'));
    }
}
