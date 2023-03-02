<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $data['title'] ?></h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <?php Flasher::flash() ?>

  <div class="row">
    <div class="col-4">
      <div class="card">
        <div class="card-header">
          <a href="<?= BASE_URL ?>/transaksi" class="btn btn-light btn-icon-split">
            <span class="icon text-gray-600">
              <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Kembali</span>
          </a>
        </div>
        <div class="card-body">
          <img src="<?= BASE_URL; ?>/img/undraw_profile.svg" class="img-fluid p-4" alt="<?= $data['siswa']['nama'] ?>">
          <table>
            <tbody>
              <tr>
                <td>Nis</td>
                <td>: <?= $data['siswa']['nis']; ?></td>
              </tr>
              <tr>
                <td>Nama</td>
                <td>: <?= $data['siswa']['nama']; ?></td>
              </tr>
              <tr>
                <td>Kelas</td>
                <td>: <?= $data['siswa']['nama_kelas']; ?></td>
              </tr>
              <tr>
                <td>Kompetensi Keahlian</td>
                <td>: <?= $data['siswa']['kompetensi_keahlian']; ?></td>
              </tr>
              <tr>
                <td>Tahun Ajaran</td>
                <td>: <?= $data['siswa']['tahun_ajaran']; ?></td>
              </tr>
              <tr>
                <td>Nominal</td>
                <td>: <?= $data['siswa']['nominal']; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-8">
      <div class="row">
        <div class="col">
          <form action="<?= BASE_URL; ?>/transaksi/create" method="post" id="transaksiForm">
            <input type="hidden" name="id_siswa" value="<?= $data['siswa']['id_siswa']; ?>">
            <input type="hidden" name="id_pembayaran" value="<?= $data['siswa']['id_pembayaran']; ?>">
            <div class="row">

              <?php
              $semester = 1;
              foreach ($data['bulan'] as $key) :
              ?>
                <h6 class="font-weight-bold text-gray-800">Semester <?= $semester++ ?></h6>
                <hr>
                <div class="row">
                  <?php foreach ($key as $bulan => $nomor_bulan) : ?>
                    <div class="col-sm-12 col-md-6 col-xl-4 mb-3 spp-card">

                      <?php if (in_array($nomor_bulan, $data['bulanDibayar'])) : ?>
                        <div class="form-group ml-4">
                          <input type="checkbox" name="spp_semester_<?= $nomor_bulan ?>" class="btn-check" id="sppSemester_<?= $nomor_bulan ?>" checked disabled autocomplete="off">
                          <label class="btn btn-secondary" for="sppSemester_<?= $nomor_bulan ?>">
                            <h6 class="text-uppercase"><?= $bulan ?></h6>
                            <h4 class="text-gray-800 font-weight-bold">Rp <?= $data['siswa']['nominal'] ?></h4>
                          </label>
                        </div>

                      <?php else : ?>
                        <div class="form-group ml-4">
                          <input type="checkbox" name="bulan_dibayar[]" class="btn-check checkbox-spp" id="sppSemester_<?= $nomor_bulan ?>" data-nominal="<?= $data['siswa']['nominal'] ?>" value="<?= $nomor_bulan ?>" autocomplete="off">
                          <label class="btn btn-outline-success" for="sppSemester_<?= $nomor_bulan ?>">
                            <h6 class="text-uppercase"><?= $bulan ?></h6>
                            <h4 class="text-gray-800 font-weight-bold">Rp <?= $data['siswa']['nominal'] ?></h4>
                          </label>
                        </div>

                      <?php endif ?>
                    </div>
                  <?php endforeach ?>
                </div>
              <?php endforeach ?>

            </div>
            <button type="button" class="btn btn-success btn-block" id="transaksiButton" data-toggle="modal" data-target="#modalTambahTransaksi">Bayar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalTambahTransaksi" tabindex="-1" role="dialog" aria-labelledby="modalTambahTransaksi" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body m-0 py-3">
          <div class="col">
            <p class="m-0">Total Harga</p>
            <h4 class="font-weight-bold" id="modalTransaksiTotalNominal">Rp 0</h4>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success btn-block">Bayar</button>
          <button class="btn btn-outline-secondary btn-block" type="button" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>

</div>