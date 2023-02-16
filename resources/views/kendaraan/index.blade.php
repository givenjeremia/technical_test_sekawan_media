@extends('layouts.dashboard')

@section('content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Tambah Kendaraan
</button>

<img src="https://drive.google.com/uc?export=view&id=1Fh5G-9XjtXdO_ynZnqjDFml1jID1T79D" alt="">

<h4 class="pt-3 pb-3">Daftar Kendaraan</h4>
<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama Kendaraan</th>
      <th scope="col">Komsumsi Bahan Bakar</th>
      <th scope="col">Jadwal Service</th>
      <th scope="col">Riwayat Kendaraan</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($kendaraans as $item)     
    <tr>

      <th scope="row">{{ $item->id}}</th>
      <td>{{ $item->nama_kendaraan }}</td>
      <td>{{ $item->komsumsi_bahan_bakar }}</td>
      <td>{{ $item->jadwal_service }}</td>
      <td>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#riwayat_{{$item->id}}">
          Riwayat Kendaraan
        </button>
        <div class="modal fade" id="riwayat_{{$item->id}}" tabindex="-1" role="basic" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title text-dark">{{$item->nama_kendaraan}}</h4>
              </div>
              <div class="modal-body">
                @if (count($item->riwayatKendaraan) > 0)
                    @foreach ($item->riwayatKendaraan as $items)
                    <p class=" text-dark">Tanggal : <span>{{ $items->waktu }}</span></p>
                    <p class=" text-dark" >Keterangan : <span>{{ $items->keterangan }}</span></p>
                    <hr>
                    @endforeach
                @else
                    <p class=" text-dark">Riwayat Mobil Belum Ada</p>
                @endif
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        
      </td>
      <td>
       
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalEdit" onclick="getEditForm({{$item->id}})">
          Edit
        </button>
      </td>
    </tr>
    @endforeach


  </tbody>
</table>
{{-- Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kendaraan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('kendaraan.store') }}" method="post">
        @csrf
        <div class="modal-body">
            <label for="" class="col-form-label">Nama Kendaraan</label>
            <input type="text" class="form-control" name="nama_kendaraan" required>
            <label for="" class="col-form-label">Komsumsi Bahan Bakar</label>
            <input type="text" class="form-control" name="komsumsi_bahan_bakar" >
            <label for="" class="col-form-label">Tanggal Service</label>
            <input type="date" class="form-control" name="jadwal_service">
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
    </div>
  </div>
</div>

{{-- modal edit --}}
<div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" id="modalContent">

    </div>
  </div>
</div>
@endsection


@section('js')
<script>
  function getEditForm(id){
     $.ajax({
       type:'POST',
       url:'{{route("kendaraan.getEditForm" )}}',
       data:{'_token':'<?php echo csrf_token() ?>',
           'id':id
    },
       success: function(data){
         $('#modalContent').html(data.msg)
       }
     });
   }
</script>
    
@endsection