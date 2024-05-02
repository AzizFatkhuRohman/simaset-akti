@extends('layouts.app')
@section('main')
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
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $item)
        <li>{{$item}}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4>{{$title}}</h4>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="ti ti-plus"></i>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pengambilan</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            @csrf
                            <input type="text" name="nama" value="{{Auth::user()->id}}" hidden>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Status</label>
                                <select class="form-select" aria-label="Default select example" name="status">
                                    <option value="mahasiswa">mahasiswa</option>
                                    <option value="pegawai">pegawai</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="exampleInputPassword1" class="form-label">Jenis Barang</label>
                                    <select class="form-select" aria-label="Default select example" name="jenis_barang">
                                        @foreach ($eq as $item)
                                        <option value="{{$item->no_asset}}/{{$item->nama_equipment}}">
                                            {{$item->no_asset}}/{{$item->nama_equipment}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <mb-3 class="col-6">
                                    <label for="exampleInputPassword1" class="form-label">Qty</label>
                                    <input type="number" class="form-control" name="jumlah">
                                </mb-3>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"
                                    name="keterangan"></textarea>
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
                        <th class="col">Nama</th>
                        <th class="col">Jenis Barang</th>
                        <th class="col">Jumlah</th>
                        <th class="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no =1;
                    @endphp
                    @foreach ($collection as $item)
                    @php
                    $uniq = $item->id
                    @endphp
                    <tr>
                        <td>{{$item->user->nama}}</td>
                        <td>{{$item->jenis_barang}}</td>
                        <td>
                            {{$item->jumlah}}
                        </td>
                        <td class="d-flex">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{$item->id}}">
                                <i class="ti ti-zoom-in"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detail data
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                                <div class="row">
                                                    <div class="mb-3 col-4">
                                                        <label for="exampleInputPassword1"
                                                            class="form-label">Nama</label>
                                                        <input type="text" class="form-control" name="nama"
                                                            value="{{$item->user->nama}}" readonly>
                                                    </div>
                                                    <div class="mb-3 col-4">
                                                        <label for="exampleInputPassword1"
                                                            class="form-label">Status</label>
                                                        <input type="text" class="form-control" name="status"
                                                            value="{{$item->status}}" readonly>
                                                    </div>
                                                    <mb-3 class="col-4">
                                                        <label for="exampleInputPassword1"
                                                            class="form-label">Qty</label>
                                                        <input type="text" class="form-control" name="jumlah"
                                                            value="{{$item->jumlah}}">
                                                    </mb-3>
                                                </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Jenis
                                                Barang</label>
                                            <input type="test" class="form-control" name="jumlah"
                                                value="{{$item->jenis_barang}}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Keterangan</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"
                                                name="keterangan">{{$item->keterangan}}</textarea>
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
    new DataTable('#table');
</script>
<script>
    $(document).ready(function() {
        $('.form-select').select2();
    });
</script>
@endsection