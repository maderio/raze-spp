<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $data['title'] ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <?php Flasher::flash() ?>

  <div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Data Petugas</h6>
      <a href="#" data-toggle="modal" data-target="#modalTambahPetugas" class="btn btn-info btn-icon-split">
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
            <tr>
              <th>#</th>
              <th>Username</th>
              <th>Nama</th>
              <th width="10%" class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($data['petugas'] as $key) { ?>
              <tr>
                <td><?= $key['id_petugas']; ?></td>
                <td><a href="<?= BASE_URL ?>/petugas/detail/<?= $key['id_petugas'] ?>"><?= $key['username']; ?></a></td>
                <td><?= $key['nama']; ?></td>
                <td class="text-center">
                  <a href="<?= BASE_URL ?>/petugas/detail/<?= $key['id_petugas'] ?>" class="btn btn-warning">
                    <span class="icon text-white-100">
                      <i class="fas fa-edit"></i>
                    </span>
                  </a>
                </td>
              </tr>
            <?php } ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalTambahPetugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Petugas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?= BASE_URL ?>/petugas/create" method="post">

            <div class="form-group">
              <label for="labelNama">Nama</label>
              <input type="text" class="form-control" name="nama" id="labelNama" required maxlength="50">
            </div>
            <div class="form-group">
              <label for="labelUsername">Username</label>
              <input type="text" class="form-control" name="username" id="labelUsername" required maxlength="25">
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="labelPass">Password</label>
                <input type="password" class="form-control" name="password" id="labelPass" required maxlength="50">
              </div>
              <div class="form-group col-md-6">
                <label for="labelConfPassword">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" id="labelConfPassword" required maxlength="50">
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

</div>