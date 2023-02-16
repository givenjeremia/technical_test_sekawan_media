<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Edit Kendaraan</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <form action="{{ route('kendaraan.update',$data->id) }}" method="post">
    @csrf
    @method('PUT')

  <div class="modal-body">

    <label for="" class="col-form-label">Nama Kendaraan</label>
    <input type="text" class="form-control" name="nama_kendaraan" value="{{ $data->nama_kendaraan }}" required>
    <label for="" class="col-form-label">Komsumsi Bahan Bakar</label>
    <input type="text" class="form-control" name="komsumsi_bahan_bakar" value="{{ $data->komsumsi_bahan_bakar }}">
    <label for="" class="col-form-label">Tanggal Service</label>
    <input type="date" class="form-control" name="jadwal_service"  value="{{ $data->jadwal_service }}">
    

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save</button>
  </div>
</form>
