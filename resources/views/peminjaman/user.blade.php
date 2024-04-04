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
@if (session('delete'))
<script>
    // Tampilkan pesan dengan SweetAlert
    Swal.fire({
        title: 'Del',
        text: '{{ session('delete') }}',
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Peminjaman</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="exampleInputPassword1" class="form-label">Nama</label>
                                    <select class="form-select" aria-label="Default select example" name="nama">
                                        {{-- @foreach ($nm as $item)
                                        <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="exampleInputPassword1" class="form-label">No Aset</label>
                                    <select class="form-select" aria-label="Default select example" name="no_aset">
                                        {{-- @foreach ($eq as $item)
                                        <option value="{{$item->no_asset}}/{{$item->nama_equipment}}">
                                            {{$item->no_asset}}/{{$item->nama_equipment}}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="exampleInputPassword1" class="form-label">Jam Pinjam</label>
                                    <input type="datetime-local" class="form-control" id="exampleInputPassword1"
                                        name="jam_pinjam">
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="exampleInputPassword1" class="form-label">Keterangan</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="1"
                                        name="keterangan"></textarea>
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
                        <th class="col">Nama</th>
                        <th class="col">No Aset</th>
                        <th class="col">Jam Pinjam</th>
                        <th class="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no =1;
                    @endphp
                    @foreach ($collection as $item)
                    <tr>
                        <td>{{$item->user->nama}}</td>
                        <td>{{$item->no_aset}}</td>
                        <td>
                            <div>
                                <div>
                                    <span>{{$item->jam_pinjam}}</span>
                                </div>
                                <div>
                                    @if ($item->jam_pengembalian == null)
                                    <button class="btn btn-outline-warning btn-sm">Belum kembali</button>
                                    @else
                                    <button class="btn btn-outline-success btn-sm">Sudah kembali</button>
                                    @endif
                                </div>
                            </div>
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
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{$item->user->nama}}
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{url('peminjaman-barang/edit/'.$item->id)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="mb-3 col-6">
                                                        <label for="exampleInputPassword1"
                                                            class="form-label">Nama</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleInputPassword1" name="nama"
                                                            value="{{$item->user->nama}}" readonly>
                                                    </div>
                                                    <div class="mb-3 col-6">
                                                        <label for="exampleInputPassword1" class="form-label">No
                                                            Aset</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleInputPassword1" name="no_asset"
                                                            value="{{$item->no_aset}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-3 col-6">
                                                        <label for="exampleInputPassword1" class="form-label">Jam
                                                            Peminjaman</label>
                                                        <input type="datetime-local" class="form-control"
                                                            id="exampleInputPassword1" name="jam_pinjam"
                                                            value="{{$item->jam_pinjam}}">
                                                    </div>
                                                    <div class="mb-3 col-6">
                                                        <label for="exampleInputPassword1" class="form-label">Jam
                                                            Pengembalian</label>
                                                        <input type="datetime-local" class="form-control"
                                                            id="exampleInputPassword1" name="jam_pengembalian"
                                                            value="{{$item->jam_pengembalian}}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1"
                                                            class="form-label">Keterangan</label>
                                                        <textarea class="form-control" id="exampleFormControlTextarea1"
                                                            rows="2" name="keterangan">{{$item->keterangan}}</textarea>
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
                            <form id="hapus-peminjaman" action="{{url('peminjaman-barang/hapus/'.$item->id)}}" method="post">
                                @method('delete')
                                @csrf
                                <button type="button" onclick="hapusP()" class="btn btn-danger btn-sm"><i
                                        class="ti ti-eraser"></i></button>
                            </form>
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
    function hapusP() {
      Swal.fire({
          title: 'Konfirmasi',
          text: 'Apakah Anda yakin ingin menghapus ini secara permanent?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Hapus!',
          cancelButtonText: 'Batal'
      }).then((result) => {
          if (result.isConfirmed) {
              document.getElementById('hapus-peminjaman').submit();
          }
      });
      
  }
</script>
@endsection