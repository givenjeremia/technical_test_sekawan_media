<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Penyewaan</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <form action="{{ route('penyewaan.update',$data->id) }}" method="post">
    @csrf
    @method('PUT')

  <div class="modal-body">

    <label  class="col-form-label">Tanggal Sewa</label>
    <input type="date" class="form-control" name="tanggal_sewa" id="tanggal_sewa" value="{{ $data->tanggal_sewa }}">
    <label  class="col-form-label">Waktu Sewa</label>
    <input type="time" class="form-control" name="waktu_sewa" id="tanggal_sewa" value="{{ $data->waktu_sewa }}">
    <label  class="col-form-label">Keterangan</label>
    <textarea class="form-control" name="keterangan" value="{{ $data->keterangan }}">{{ $data->keterangan }}</textarea>

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save</button>
  </div>
</form>
