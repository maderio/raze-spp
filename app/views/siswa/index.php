<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $data['title'] ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <?php Flasher::flash() ?>

  <div class="card shadow mb-4">
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Data Siswa</h6>
      <a href="#" data-toggle="modal" data-target="#modalTambahSiswa" class="btn btn-info btn-icon-split">
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
              <th>Nisn</th>
              <th>Nis</th>
              <th>Username</th>
              <th>Nama</th>
              <th>Kelas</th>
              <th width="10%" class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($data['siswa'] as $key) { ?>
              <tr>
                <td><?= $key['id_siswa']; ?></td>
                <td><a href="<?= BASE_URL ?>/siswa/detail/<?= $key['id_siswa'] ?>"><?= $key['nisn']; ?></a></td>
                <td><?= $key['nis']; ?></td>
                <td><?= $key['username']; ?></td>
                <td><?= $key['nama']; ?></td>
                <td><?= $key['nama_kelas']; ?></td>
                <td class="text-center">
                  <a href="<?= BASE_URL ?>/siswa/detail/<?= $key['id_siswa'] ?>" class="btn btn-warning">
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
  <div class="modal fade" id="modalTambahSiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Tambah Siswa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="<?= BASE_URL ?>/siswa/create" method="post">

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="labelNisn">Nisn</label>
                <input type="text" class="form-control" name="nisn" id="labelNisn" required maxlength="10">
              </div>
              <div class="form-group col-md-6">
                <label for="labelNis">Nis</label>
                <input type="text" class="form-control" name="nis" id="labelNis" required maxlength="5">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="labelNama">Nama</label>
                <input type="text" class="form-control" name="nama" id="labelNama" required maxlength="50">
              </div>
              <div class="form-group col-md-6">
                <label for="labelTelepon">Telepon</label>
                <input type="text" class="form-control" name="telepon" id="labelTelepon" required maxlength="14">
              </div>
            </div>

            <div class="form-group">
              <label for="labelAlamat">Alamat</label>
              <textarea name="alamat" class="form-control" id="labelAlamat" cols="30" rows="5"></textarea>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="labelKelas">Kelas</label>
                <select name="id_kelas" id="labelKelas" class="form-control" required>
                  <?php foreach ($data['kelas'] as $key) : ?>
                    <option value="<?= $key['id_kelas'] ?>"><?= $key['nama'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="labelSpp">SPP</label>
                <select name="id_pembayaran" id="labelSpp" class="form-control" required>
                  <?php foreach ($data['pembayaran'] as $key) : ?>
                    <option value="<?= $key['id_pembayaran'] ?>"><?= $key['tahun_ajaran'] ?></option>
                  <?php endforeach ?>
                </select>
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