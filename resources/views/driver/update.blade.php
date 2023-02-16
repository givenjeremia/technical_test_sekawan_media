<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Kendaraan</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <form action="{{ route('driver.update',$data->id) }}" method="post">
    @csrf
    @method('PUT')

  <div class="modal-body">

    <label for="" class="col-form-label">Nama Driver</label>
    <input type="text" class="form-control" name="nama_driver" id="nama_driver" value="{{ $data->nama_driver }}" required>
    <label for="" class="col-form-label">Keterangan</label>
    <textarea class="form-control" name="keterangan" value="{{ $data->keterangan  }}">{{ $data->keterangan  }}</textarea>
    <input type="checkbox"  name="ready_status" value="1" {{ $data->status == 1 ? 'checked' : '' }}>
    <label for="" class="col-form-label">Ready</label>

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save</button>
  </div>
</form>
