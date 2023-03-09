<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $data['title'] ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <?php Flasher::flash() ?>

  <div class="card shadow mb-4">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th width="10%">Id Transaksi</th>
              <th>Nominal</th>
              <th>Tahun Ajaran</th>
              <th>Petugas</th>
              <th>Waktu</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($data['transaksi'] as $key) : ?>
              <tr>
                <td><?= $key['id_transaksi'] ?></td>
                <td><?= $key['nominal'] ?></td>
                <td><?= $key['tahun_ajaran'] ?></td>
                <td><?= $key['nama_petugas'] ?></td>
                <td><?= date('h:i:s A (j F Y)', strtotime($key['tanggal_bayar'])) ?></td>
              </tr>
            <?php endforeach ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>