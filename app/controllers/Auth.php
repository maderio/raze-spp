<?php

class Auth extends Controller
{

  public function login()
  {
    Gate::isNotLoggedIn();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $user = $this->model('auth_model')->login($_POST);
      if ($user) {
        $user['cookie'] = md5($user['username'] . $user['password'] . time());
        $this->model('auth_model')->setUserSession($user);
        $this->model('auth_model')->setUserCookie($user);
        if ($user['role'] < 3) {
          $_SESSION['user']['id_petugas'] = $this->model('petugas_model')->getPetugasByIdPengguna($user['id_pengguna'])['id_petugas'];
        } else {
          $_SESSION['user']['id_siswa'] = $this->model('siswa_model')->getSiswaByIdPengguna($user['id_pengguna'])['id_siswa'];
        }
        $this->directTo();
      } else {
        Flasher::setFlash('danger', 'Nama Pengguna atau Sandi salah!');
      }
    }

    $this->view('partials/auth/header');
    $this->view('auth/login');
    $this->view('partials/auth/footer');
  }

  public function register()
  {
    Gate::isNotLoggedIn();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($this->model('auth_model')->register($_POST) > 0) {
        $this->directTo('/auth/login');
      }
      $this->directTo('/auth/register');
    }

    $this->view('partials/auth/header');
    $this->view('auth/register');
    $this->view('partials/auth/footer');
  }

  public function logout()
  {
    Gate::isLoggedIn();

    unset($_SESSION['user']);
    $this->directTo();
  }
}
