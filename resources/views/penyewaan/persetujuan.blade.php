@extends('layouts.dashboard')

@section('content')

<h4 class="pt-3 pb-3">Daftar Persetujuan</h4>
<table id="myTable" class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Jenis Kendaraan</th>
      <th scope="col">Driver</th>
      <th scope="col">Tanggal / Waktu</th>
      <th scope="col">Keterangan</th>
      <th scope="col">Tanggal Buat</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>

    @foreach ($data as $item)     
    <tr>

      <th scope="row">{{ $loop->index+1 }}</th>
      <td>{{ $item->kendaraan->nama_kendaraan }}</td>
      <td>{{ $item->driver->nama_driver }}</td>
      <td>
        {{ $item->tanggal_sewa }} / {{ $item->waktu_sewa }}
      </td>
      <td>{{ $item->keterangan }}</td>
      <td>{{ $item->pivot->tanggal_buat }}</td>
      <td>
        {{-- {{ $item->pivot->status }} --}}
        <select class="form-control status_option" name="status_option" id="{{ $item->id }}">
          @foreach (['0' => 'Belum Disetujui', '1' => 'Disetujui'] as $value => $Label)
          <option value="{{ $value }}" {{ $item->pivot->status == $value ? 'selected' : '' }}>{{ $Label }}</option>
          @endforeach
        </select>
      </td>

     
    </tr>
    @endforeach

  </tbody>
</table>
{{-- Modal --}}


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

    $('.status_option').change(function() {
            var id = $(this).attr('id');
            var value_change = $(this).val();
            $.ajax({
                type: 'POST',
                url: "{{ route('persetujuan.changeStatus') }}",
                data: {
                    '_token': '<?php echo csrf_token(); ?>',
                    'id': id,
                    'fnama': 'status',
                    'value': value_change

                },
                success: function(data) {
                    alert(data.msg)
                }
            });
        });
} );
</script>
    
@endsection