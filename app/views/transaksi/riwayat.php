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
              <th>Nis</th>
              <th>Nama</th>
              <?php foreach ($data['bulan'] as $arr) : ?>
                <?php foreach ($arr as $key => $value) : ?>
                  <th width="10%" class="text-capitalize"><?= $value ?></th>
                <?php endforeach ?>
              <?php endforeach ?>
            </tr>
          </thead>
          <tbody>

            <?php foreach ($data['siswa'] as $siswa) : ?>
              <tr>
                <td><?= $siswa['nis'] ?></td>
                <td><?= $siswa['nama'] ?></td>
                <?php foreach ($data['bulan'] as $arr) : ?>
                  <?php foreach ($arr as $key => $value) : ?>
                    <td class="text-center">
                      <?php if (in_array($key, $data['bulanDibayar'][$siswa['id_siswa']])) : ?>
                        <p class="font-weight-bold text-success">v</p>
                      <?php else : ?>
                        <p class="font-weight-bold text-danger">x</p>
                      <?php endif ?>
                    </td>
                  <?php endforeach ?>
                <?php endforeach ?>
              </tr>
            <?php endforeach ?>

          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>