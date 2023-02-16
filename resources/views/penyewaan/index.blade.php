@extends('layouts.dashboard')

@section('content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Tambah Penyewaan
</button>

<h4 class="pt-3 pb-3">Daftar Penyewaan</h4>
<table id="myTable" class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Jenis Kendaraan</th>
      <th scope="col">Driver</th>
      <th scope="col">Tanggal / Waktu</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Status</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($penyewaan as $item)     
    <tr>

      <th scope="row">{{ $loop->index+1 }}</th>
      <td>{{ $item->kendaraan->nama_kendaraan }}</td>
      <td>{{ $item->driver->nama_driver }}</td>
      <td>{{ $item->tanggal_sewa  }} / {{ $item->waktu_sewa  }}</td>
      <td>{{ $item->keterangan  }}</td>
      <td>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#status_{{$item->id}}">
          Status Penyewaan
        </button>
        <div class="modal fade" id="status_{{$item->id}}" tabindex="-1" role="basic" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title text-dark">{{ $item->tanggal_sewa}} - ({{$item->kendaraan->nama_kendaraan}}/{{ $item->driver->nama_driver }})  </h4>
              </div>
              <div class="modal-body">
                @if (count($item->persetujuan) > 0)
                    @foreach ($item->persetujuan as $items)
                    <p class=" text-dark">{{ $items->role == 1 ? 'Supervisor Region' : 'Manajer' }} <span>({{ $items->username }})</span></p>
                    <p class=" text-dark">Tanggal Buat  : <span> {{ $items->pivot->tanggal_buat }}</span></p>
                    <p class=" text-dark">Tanggal Setuju  : <span> {{ $items->pivot->tanggal_setuju ? $items->pivot->tanggal_setuju : 'Belum Melakukan Persetujuan' }}</span></p>
                    <p class=" text-dark">Status  : <span> {{ $items->pivot->status == 1 ? 'Sudah Disetujui' : 'Belum Melakukan Persetujuan' }}</span></p>

                    <hr>
                    @endforeach
                @else
                    <p class=" text-dark">Eror</p>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Penyewaan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('penyewaan.store') }}" method="post">
        @csrf
        <div class="modal-body">
            <label  class="col-form-label">Kendaraan</label>
            <select class="form-control" name="kendaraan_id" id="">
                @foreach ($kendaraans as $item)  
                  <option value="{{ $item->id }}">{{ $item->nama_kendaraan }}</option>
                @endforeach
            </select>
            <label  class="col-form-label">Tanggal Sewa</label>
            <input type="date" class="form-control" name="tanggal_sewa" id="tanggal_sewa">
            <label  class="col-form-label">Waktu Sewa</label>
            <input type="time" class="form-control" name="waktu_sewa" id="tanggal_sewa">
            <label  class="col-form-label">Keterangan</label>
            <textarea class="form-control" name="keterangan"></textarea>
            <label class="col-form-label">Driver</label>
            <select class="form-control" name="driver_id">
                @foreach ($drivers as $item)  
                  <option value="{{ $item->id }}">{{ $item->nama_driver }}</option>
                @endforeach
            </select>
            <label class="col-form-label">Persetujuan 1 (Supervisor Region)</label>
            <select class="form-control" name="supervisor_id" >
              @foreach ($supervisis as $item)
                  <option value="{{ $item->id }}">{{ $item->username }}</option>
              @endforeach
            </select>
            <label  class="col-form-label">Persetujuan 2 (Manajer)</label>
            <select class="form-control" name="manajer_id">
                @foreach ($manajers as $item)
                  <option value="{{ $item->id }}">{{ $item->username }}</option>
                @endforeach
            </select>

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
$(document).ready(function() {
    $('#myTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
          {
                extend: 'excelHtml5',
                title: 'Data Penyewaan'
            },
        ]
    } );
} );
function getEditForm(id){
     $.ajax({
       type:'POST',
       url:'{{route("penyewaan.getEditForm" )}}',
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