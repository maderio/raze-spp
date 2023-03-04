<div class="container">
  <div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-6 d-none d-lg-block text-center">
              <img src="<?= BASE_URL; ?>/img/logo-rectangle.svg" alt="illuatration" width="100%">
            </div>
            <div class="col-lg-6">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                </div>
                <form class="user" action="<?= BASE_URL; ?>/auth/login" method="POST">
                  <?php Flasher::flash() ?>
                  <div class="form-group">
                    <input type="text" name="username" class="form-control form-control-user" placeholder="Nama Pengguna" required>
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user" placeholder="Kata Sandi" required>
                  </div>
                  <button type="submit" class="btn btn-primary btn-user btn-block">
                    Masuk
                  </button>
                </form>
                <hr>
                <div class="text-center">
                  <a class="small" href="#">Lupa Kata Sandi?</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>