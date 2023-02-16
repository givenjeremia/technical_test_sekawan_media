@extends('layouts.dashboard')

@section('content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Tambah Driver
</button>

<h4 class="pt-3 pb-3">Daftar Driver</h4>
<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama Driver</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Status</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($drivers as $item)     
    <tr>

      <th scope="row">{{ $item->id}}</th>
      <td>{{ $item->nama_driver }}</td>
      <td>{{ $item->keterangan ? $item->keterangan : "Tidak Ada Keterangan"  }}</td>
      <td>{{ $item->status == 1 ? 'Ready' : 'Not Ready'  }}</td>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Driver</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('driver.store') }}" method="post">
        @csrf
        <div class="modal-body">
            <label for="log_harian" class="col-form-label">Nama Driver</label>
            <input type="text" class="form-control" name="nama_driver" id="nama_driver" required>
            <label for="log_harian" class="col-form-label">Keterangan</label>
            <textarea class="form-control" name="keterangan" id="log_harian"></textarea>
            <input type="checkbox"  name="ready_status" value="1">
            <label for="log_harian" class="col-form-label">Ready</label>
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
       url:'{{route("driver.getEditForm" )}}',
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