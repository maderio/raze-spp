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
      <form action="<?= BASE_URL ?>/pengguna/update" method="post">
        <div class="form-row">
          <div class="col-md-5 d-flex justify-content-center align-item-center">
            <div class="col-8"><img src="<?= BASE_URL ?>/img/undraw_profile_<?= array_rand([1, 2, 3, 4]) ?>.svg" alt="<?= $_SESSION['user']['name'] ?>" class="img-profile rounded-circle shadow-lg"></div>
          </div>

          <div class="col-md-7">

            <?php Flasher::flash() ?>

            <input type="hidden" name="id_pengguna" value="<?= $_SESSION['user']['id'] ?>">
            <div class="form-group">
              <label for="labelName">Nama Lengkap</label>
              <input type="text" class="form-control" name="nama" id="labelName" required maxlength="50" value="<?= $_SESSION['user']['name'] ?>">
            </div>
            <div class="form-group">
              <label for="labelUsername">Nama Pengguna</label>
              <input type="text" class="form-control" name="username" id="labelUsername" required maxlength="25" value="<?= $_SESSION['user']['username'] ?>">
            </div>

            <div class="form-group">
              <label for="labelOldPassword">Kata Sandi Lama</label>
              <input type="password" class="form-control" name="password[old]" id="labelOldPassword" required maxlength="50">
            </div>

            <div class="card shadow mb-4">
              <a href="#collapseCardExample" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-black-50">Ubah Kata Sandi</h6>
              </a>
              <div class="collapse" id="collapseCardExample">
                <div class="card-body">

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="labelNewPassword">Kata Sandi Baru</label>
                      <input type="password" class="form-control" name="password[new]" id="labelNewPassword" maxlength="50">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="labelConfirmNewPassword">Konfirmasi Kata Sandi Baru</label>
                      <input type="password" class="form-control" name="password[confirm]" id="labelConfirmNewPassword" maxlength="50">
                    </div>
                  </div>

                </div>
              </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>