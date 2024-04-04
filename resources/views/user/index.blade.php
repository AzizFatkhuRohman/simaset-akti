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
@if (session('Delete'))
<script>
    // Tampilkan pesan dengan SweetAlert
    Swal.fire({
        title: 'Del',
        text: '{{ session('Delete') }}',
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
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah user</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="exampleInputPassword1" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="nama">
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="exampleInputPassword1" class="form-label">Nim/Noreg</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" name="nim_noreg">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="exampleInputPassword1" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1"
                                        name="password">
                                </div>
                                <div class="mb-3 col-6">
                                    <label for="exampleInputPassword1" class="form-label">Role</label>
                                    <select class="form-select" aria-label="Default select example" name="role">
                                        <option value="admin">admin</option>
                                        <option value="user">user</option>
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
                        <th>No</th>
                        <th class="col">Nama</th>
                        <th class="col">Nim/Noreg</th>
                        <th class="col">Role</th>
                        <th class="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no =1;
                    @endphp
                    @foreach ($collection as $item)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$item->nama}}</td>
                        <td>{{$item->nim_noreg}}</td>
                        <td>{{$item->role}}</td>
                        <td class="d-flex">
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{$item->id}}">
                                <i class="ti ti-eye"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{$item->nama}}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{url('data-user/edit/'.$item->id)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="mb-3 col-6">
                                                        <label for="exampleInputPassword1"
                                                            class="form-label">Nama</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleInputPassword1" name="nama"
                                                            value="{{$item->nama}}">
                                                    </div>
                                                    <div class="mb-3 col-6">
                                                        <label for="exampleInputPassword1"
                                                            class="form-label">Nim/Noreg</label>
                                                        <input type="text" class="form-control"
                                                            id="exampleInputPassword1" name="nim_noreg"
                                                            value="{{$item->nim_noreg}}">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="mb-3 col-12">
                                                        <label for="exampleInputPassword1"
                                                            class="form-label">Role</label>
                                                        <select class="form-select" aria-label="Default select example"
                                                            name="role">
                                                            @if ($item->role == 'admin')
                                                            <option value="{{$item->role}}">{{$item->role}}</option>
                                                            <option value="user">user</option>
                                                            @else
                                                            <option value="{{$item->role}}">{{$item->role}}</option>
                                                            <option value="admin">admin</option>

                                                            @endif
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
                            <form id="hapus-user" action="{{url('data-user/permanently/'.$item->id)}}" method="post">
                                @method('delete')
                                @csrf
                                <button type="button" onclick="hapusUs()" class="btn btn-danger btn-sm"><i
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
    function hapusUs() {
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
              document.getElementById('hapus-user').submit();
          }
      });
      
  }
</script>
@endsection