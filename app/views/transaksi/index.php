<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $data['title'] ?></h1>
  </div>

  <?php Flasher::flash() ?>

  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>Nis</th>
              <th>Nama</th>
              <th>Kelas</th>
              <th>Kompetensi Keahlian</th>
              <th width="10%" class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($data['siswa'] as $key) : ?>
              <tr>
                <td><?= $key['id_siswa']; ?></td>
                <td><a href="<?= BASE_URL ?>/transaksi/detail/<?= $key['id_siswa'] ?>"><?= $key['nis']; ?></a></td>
                <td><?= $key['nama'] ?></td>
                <td><?= $key['nama_kelas'] ?></td>
                <td><?= $key['kompetensi_keahlian'] ?></td>
                <td>
                  <a href="<?= BASE_URL ?>/transaksi/detail/<?= $key['id_siswa'] ?>" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-100">
                      <i class="fas fa-cash-register"></i>
                    </span>
                    <span class="text">Bayar</span>
                  </a>
                </td>
              </tr>
            <?php endforeach ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>