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
<div class="card">
    <div class="card-header">
        {{$title}}
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table" id="table">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">No aset</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Nama equipment</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($collection as $item)
                    <tr>
                        <td>{{$item->no_asset}}</td>
                        <td>
                            <img src="{{asset('equipment/'.$item->photo)}}" alt="" width="50px" height="50px">
                        </td>
                        <td>{{$item->nama_equipment}}</td>
                        <td>{{$item->qty}}</td>
                        <td class="d-flex">
                            <form action="{{url('trash/restore/'.$item->id)}}" method="post">
                                @csrf
                                @method('put')
                                <button class="btn btn-info btn-sm"><i class="ti ti-reload"></i></button>
                            </form>
                            <form id="hapus-trash" action="{{url('trash/permanently/'.$item->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="button" onclick="trash()" class="btn btn-danger btn-sm"><i
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
    function trash() {
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
              document.getElementById('hapus-trash').submit();
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