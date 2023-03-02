<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $data['title'] ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <?php Flasher::flash() ?>

  <div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Data Pembayaran</h6>
      <a href="#" data-toggle="modal" data-target="#modalTambahPembayaran" class="btn btn-info btn-icon-split">
        <span class="icon text-white-100">
          <i class="fas fa-plus"></i>
        </span>
        <span class="text">
          Tambah
        </span>
      </a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr class="text-center">
              <th>#</th>
              <th>Tahun Ajaran</th>
              <th>Nominal</th>
              <th width="10%">Aksi</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($data['pembayaran'] as $key) : ?>
              <tr>
                <td><?= $key['id_pembayaran']; ?></td>
                <td><a href="#" data-toggle="modal" data-target="#modalEditPembayaran<?= $key['id_pembayaran'] ?>"><?= $key['tahun_ajaran']; ?></a></td>
                <td><?= $key['nominal']; ?></td>
                <td class="d-flex">
                  <a href="#" data-toggle="modal" data-target="#modalEditPembayaran<?= $key['id_pembayaran'] ?>" class="btn btn-warning mr-2">
                    <span class="icon text-white-50">
                      <i class="fas fa-edit"></i>
                    </span>
                  </a>
                  <a href="#" data-toggle="modal" data-target="#modalHapusPembayaran<?= $key['id_pembayaran'] ?>" class="btn btn-danger">
                    <span class="icon text-white-50">
                      <i class="fas fa-trash"></i>
                    </span>
                  </a>
                </td>
              </tr>
            <?php endforeach ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalTambahPembayaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Pembayaran</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?= BASE_URL ?>/pembayaran/create" method="post">

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="labelTahun">Tahun Ajaran</label>
                <input type="text" class="form-control" name="tahun_ajaran" id="labelTahun" required maxlength="9">
              </div>
              <div class="form-group col-md-6">
                <label for="labelNominal">Nominal</label>
                <input type="text" class="form-control" name="nominal" id="labelNominal" required maxlength="50">
              </div>
            </div>

            <!-- </form> -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php foreach ($data['pembayaran'] as $key) : ?>
    <div class="modal fade" id="modalEditPembayaran<?= $key['id_pembayaran'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Pembayaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?= BASE_URL ?>/pembayaran/update" method="post">

              <div class="form-row">
                <div class="form-group col-md-6">
                  <input type="hidden" name="id_pembayaran" value="<?= $key['id_pembayaran'] ?>">
                  <label for="labelTahun">Tahun Ajaran</label>
                  <input type="text" class="form-control" name="tahun_ajaran" id="labelTahun" required maxlength="9" value="<?= $key['tahun_ajaran'] ?>">
                </div>
                <div class="form-group col-md-6">
                  <label for="labelNominal">Nominal</label>
                  <input type="text" class="form-control" name="nominal" id="labelNominal" required maxlength="50" value="<?= $key['nominal'] ?>">
                </div>
              </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalHapusPembayaran<?= $key['id_pembayaran'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Apakah Yakin Menghapus Pembayaran '<?= $key['tahun_ajaran'] ?>'?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <a href="<?= BASE_URL ?>/pembayaran/delete/<?= $key['id_pembayaran'] ?>" class="btn btn-danger">Hapus</a>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach ?>

</div>
<!-- /.container-fluid -->