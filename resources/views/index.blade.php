@extends('layouts.app')
@section('main')
<div class="p-3 bg-info bg-opacity-10 border border-info border-start-0 rounded-end mb-2">
  Selamat Datang {{Auth::user()->nama}} !
</div>
<div class="card border-primary">
  <div class="card-body">
    <div id='calendar'></div>
  </div>
</div>
<div class="row">
  <div class="col-lg-6 d-flex align-items-stretch">
    <div class="card w-100">
      <div class="card-body p-4">
        <h5 class="card-title fw-semibold mb-4">Peminjaman Terbaru</h5>
        <div class="table-responsive">
          <table class="table text-nowrap mb-0 align-middle">
            <thead class="text-dark fs-4">
              <tr>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Nama</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">No Aset</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Jam Pinjam</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Status</h6>
                </th>
              </tr>
            </thead>
            <tbody>
              @foreach ($collection as $item)
              <tr>
                <td class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">{{$item->user->nama}}</h6>
                  <span class="fw-normal">{{$item->user->nim_noreg}}</span>
                </td>
                <td class="border-bottom-0">
                  <h6 class="fw-semibold mb-1">{{$item->no_aset}}</h6>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal">{{$item->jam_pinjam}}</p>
                </td>
                <td class="border-bottom-0">
                  <div class="d-flex align-items-center gap-2">
                    @if ($item->jam_pengembalian == null)
                    <span class="badge bg-danger rounded-3 fw-semibold">Belum kembali</span>
                    @else
                    <span class="badge bg-primary rounded-3 fw-semibold">Kembali</span>
                    @endif
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6 d-flex align-items-stretch">
    <div class="card w-100">
      <div class="card-body p-4">
        <h5 class="card-title fw-semibold mb-4">Pengambilan Terbaru</h5>
        <div class="table-responsive">
          <table class="table text-nowrap mb-0 align-middle">
            <thead class="text-dark fs-4">
              <tr>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Nama</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Status</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Jenis barang</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Jumlah</h6>
                </th>
              </tr>
            </thead>
            <tbody>
             @foreach ($collecP as $item)
             <tr>
              <td class="border-bottom-0">
                <h6 class="fw-semibold mb-0">{{$item->user->nama}}</h6>
                <span class="fw-normal">{{$item->user->nim_noreg}}</span>
              </td>
              <td class="border-bottom-0">
                <h6 class="fw-semibold mb-1">{{$item->status}}</h6>
              </td>
              <td class="border-bottom-0">
                <p class="mb-0 fw-normal">{{$item->jenis_barang}}</p>
              </td>
              <td class="border-bottom-0">
                <div class="d-flex align-items-center gap-2">
                  <span class="mb-0 fw-normal">{{$item->jumlah}}</span>
                </div>
              </td>
            </tr>
             @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth'
    });
    calendar.render();
  });

</script>
@endsection