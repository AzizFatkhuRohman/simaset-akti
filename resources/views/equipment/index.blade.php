@extends('layouts.app')
@section('main')
@if (session('create'))
<style type="text/css">
    @page {
        size: A4;
        margin: 2cm;
    }

    @media print {
        table {
            width: 10cm;
            height: 3cm;
        }

        img {
            height: 3cm;
            width: auto;
        }
    }

    table {
        width: 10cm;
        height: 3cm;
    }

    img {
        height: 2.5cm;
        width: auto;
    }
</style>
<script>
    // Tampilkan pesan dengan SweetAlert
    Swal.fire({
        title: 'Post',
        text: '{{ session('create') }}',
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif
@if (session('trash'))
<script>
    // Tampilkan pesan dengan SweetAlert
    Swal.fire({
        title: 'Del',
        text: '{{ session('trash') }}',
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif
@if (session('update'))
<script>
    // Tampilkan pesan dengan SweetAlert
    Swal.fire({
        title: 'Put',
        text: '{{ session('update') }}',
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif
@if (session('create'))
<script>
    // Tampilkan pesan dengan SweetAlert
    Swal.fire({
        title: 'Post',
        text: '{{ session('create') }}',
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endif
@if ($errors->any())
<div class="alert text-danger">
    <ul>
        @foreach ($errors->all() as $item)
        <li>{{$item}}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4>{{$title}}</h3>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="ti ti-plus"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah equipment</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="exampleInputPassword1" class="form-label">No Aset</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1"
                                            name="no_asset">
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="exampleInputPassword1" class="form-label">Nama
                                            Barang(Equipment)</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1"
                                            name="nama_equipment">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-4">
                                        <label for="exampleInputPassword1" class="form-label">Panjang</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1"
                                            name="panjang">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="exampleInputPassword1" class="form-label">Lebar</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1"
                                            name="lebar">
                                    </div>
                                    <div class="mb-3 col-4">
                                        <label for="exampleInputPassword1" class="form-label">Tinggi</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1"
                                            name="tinggi">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="exampleInputPassword1" class="form-label">Qty</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1" name="qty">
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="exampleInputPassword1" class="form-label">Tahun Pembelian</label>
                                        <input type="number" class="form-control" id="exampleInputPassword1"
                                            name="tahun">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="exampleInputPassword1" class="form-label">Tempat</label>
                                        <select class="form-select" aria-label="Default select example" name="tempat">
                                            <option value="asrama">Asrama</option>
                                            <option value="kampus">Kampus</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="exampleInputPassword1" class="form-label">lokasi</label>
                                        <input type="text" class="form-control" id="exampleInputPassword1"
                                            name="lokasi">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="exampleInputPassword1" class="form-label">Photo Barang</label>
                                        <input type="file" class="form-control" id="exampleInputPassword1"
                                            name="gambar">
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="exampleInputPassword1" class="form-label">Keterangan</label>
                                        <select class="form-select" aria-label="Default select example"
                                            name="keterangan">
                                            <option value="baik">Baik</option>
                                            <option value="sedang">Sedang</option>
                                            <option value="buruk">Buruk</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="table">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">No Aset</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Nama Equipment</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($collection as $item)
                    @php
                    $id=$item->id
                    @endphp
                    <tr>
                        <th scope="row">{{$item->no_asset}}</th>
                        <td>
                            <img src="{{asset('equipment/'.$item->photo)}}" alt="" width="50px" height="50px">
                        </td>
                        <td>{{$item->nama_equipment}}</td>
                        <td>{{$item->qty}}</td>
                        <td>
                            <div class="d-flex">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal{{$item->id}}">
                                    <i class="ti ti-eye"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$id}}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                    {{$item->no_asset}}/{{$item->nama_equipment}}
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{url('data-equipment/edit/'.$id)}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="mb-3 col-6">
                                                            <label for="exampleInputPassword1" class="form-label">No
                                                                Aset</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputPassword1" name="no_asset"
                                                                value="{{$item->no_asset}}">
                                                        </div>
                                                        <div class="mb-3 col-6">
                                                            <label for="exampleInputPassword1" class="form-label">Nama
                                                                Barang(Equipment)</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputPassword1" name="nama_equipment"
                                                                value="{{$item->nama_equipment}}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="mb-3 col-4">
                                                            <label for="exampleInputPassword1"
                                                                class="form-label">Panjang</label>
                                                            <input type="number" class="form-control"
                                                                id="exampleInputPassword1" name="panjang"
                                                                value="{{$item->panjang}}">
                                                        </div>
                                                        <div class="mb-3 col-4">
                                                            <label for="exampleInputPassword1"
                                                                class="form-label">Lebar</label>
                                                            <input type="number" class="form-control"
                                                                id="exampleInputPassword1" name="lebar"
                                                                value="{{$item->lebar}}">
                                                        </div>
                                                        <div class="mb-3 col-4">
                                                            <label for="exampleInputPassword1"
                                                                class="form-label">Tinggi</label>
                                                            <input type="number" class="form-control"
                                                                id="exampleInputPassword1" name="tinggi"
                                                                value="{{$item->tinggi}}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="mb-3 col-6">
                                                            <label for="exampleInputPassword1"
                                                                class="form-label">Qty</label>
                                                            <input type="number" class="form-control"
                                                                id="exampleInputPassword1" name="qty"
                                                                value="{{$item->qty}}">
                                                        </div>
                                                        <div class="mb-3 col-6">
                                                            <label for="exampleInputPassword1" class="form-label">Tahun
                                                                Pembelian</label>
                                                            <input type="number" class="form-control"
                                                                id="exampleInputPassword1" name="tahun"
                                                                value="{{$item->tahun}}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="mb-3 col-6">
                                                            <label for="exampleInputPassword1"
                                                                class="form-label">Tempat</label>
                                                            <select class="form-select"
                                                                aria-label="Default select example" name="tempat">
                                                                @if ($item->tempat == 'Asrama')
                                                                <option value="{{$item->tempat}}">{{$item->tempat}}
                                                                </option>
                                                                <option value="Kampus">Kampus</option>
                                                                @else
                                                                <option value="{{$item->tempat}}">{{$item->tempat}}
                                                                </option>
                                                                <option value="Asrama">Asrama</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="mb-3 col-6">
                                                            <label for="exampleInputPassword1"
                                                                class="form-label">lokasi</label>
                                                            <input type="text" class="form-control"
                                                                id="exampleInputPassword1" name="lokasi"
                                                                value="{{$item->lokasi}}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="mb-3 col-6">
                                                            <label for="exampleInputPassword1"
                                                                class="form-label">Keterangan</label>
                                                            <select class="form-select"
                                                                aria-label="Default select example" name="keterangan">
                                                                @if ($item->keterangan == 'baik')
                                                                <option value="{{$item->keterangan}}">
                                                                    {{$item->keterangan}}</option>
                                                                <option value="Sedang">Sedang</option>
                                                                <option value="Buruk">Buruk</option>
                                                                @elseif ($item->keterangan == 'sedang')
                                                                <option value="{{$item->keterangan}}">
                                                                    {{$item->keterangan}}</option>
                                                                <option value="Baik">Baik</option>
                                                                <option value="Buruk">Buruk</option>
                                                                @else
                                                                <option value="{{$item->keterangan}}">
                                                                    {{$item->keterangan}}</option>
                                                                <option value="Baik">Baik</option>
                                                                <option value="Sedang">Sedang</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Ubah</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <form id="hapus-sementara" action="{{url('data-equipment/trash/'.$id)}}" method="post">
                                    @csrf
                                    @method('put')
                                    <button class="btn btn-danger btn-sm" type="button" onclick="hapusEq()"><i
                                            class="ti ti-trash"></i></button>
                                </form>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop{{$item->id}}">
                                    <i class="ti ti-printer"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop{{$item->id}}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">
                                                    {{$item->no_asset}}/{{$item->nama_equipment}}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @php
                                                $qr =
                                                \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate($item->no_asset);
                                                @endphp
                                                <table border="1" align="center" style="height:3cm;">
                                                    <tr>
                                                        <td rowspan="3">
                                                            {!!$qr!!}
                                                        </td>
                                                        <td align="center"><b>Akademi Komunitas Toyota Indonesia</b>
                                                        </td>
                                                        <td rowspan="3"><img src="{{asset('logo.png')}}" alt="logo"
                                                                width="100px">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center"><b>
                                                                {{$item->no_asset}} -
                                                                {{$item->tahun}}
                                                            </b></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center"><b>
                                                                {{$item->nama_equipment}}
                                                            </b></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary">
                                                    Unduh
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function hapusEq() {
      Swal.fire({
          title: 'Konfirmasi',
          text: 'Apakah Anda yakin ingin menghapus ini?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Hapus!',
          cancelButtonText: 'Batal'
      }).then((result) => {
          if (result.isConfirmed) {
              document.getElementById('hapus-sementara').submit();
          }
      });
      
  }
</script>
<script>
    new DataTable('#table');
</script>
<script>
    $(document).ready(function() {
        $('.form-select').select2();
    });
</script>
@endsection