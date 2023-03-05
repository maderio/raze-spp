<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $data['title'] ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">
        <a href="<?= BASE_URL ?>" class="btn btn-light btn-icon-split">
          <span class="icon text-gray-600">
            <i class="fas fa-arrow-left"></i>
          </span>
          <span class="text">Kembali</span>
        </a>
      </h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr class="text-center">
              <th width="10%">#</th>
              <th>Waktu</th>
            </tr>
          </thead>
          <tbody>

            <?php
            $i = 1;
            foreach ($data['riwayat_login'] as $key) : ?>
              <tr>
                <td><?= $i++ ?></td>
                <td class="text-center"><?= $key['waktu'] ?></td>
              </tr>
            <?php endforeach ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>