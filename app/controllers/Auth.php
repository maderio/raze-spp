<?php

class Auth extends Controller
{
  public function __construct()
  {
    if (isset($_COOKIE['user']) && !isset($_SESSION['user'])) {
      $user = $this->model('auth_model')->attemptByCookie($_COOKIE['user']);
      if ($user) {
        $this->model('auth_model')->setUserSession($user);
        if ($user['role'] < 3) {
          $_SESSION['user']['id_petugas'] = $this->model('petugas_model')->getPetugasByIdPengguna($user['id_pengguna'])['id_petugas'];
        } else {
          $_SESSION['user']['id_siswa'] = $this->model('siswa_model')->getSiswaByIdPengguna($user['id_pengguna'])['id_siswa'];
        }
        $this->redirect();
      }
    }
  }

  public function login()
  {
    Middleware::isNotLoggedIn();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $user = $this->model('auth_model')->attempt($_POST);
      if ($user) {
        $user['cookie'] = md5($user['username'] . $user['password'] . time());
        $this->model('auth_model')->setUserSession($user);
        $this->model('auth_model')->setUserCookie($user);
        if ($user['role'] < 3) {
          $_SESSION['user']['id_petugas'] = $this->model('petugas_model')->getPetugasByIdPengguna($user['id_pengguna'])['id_petugas'];
        } else {
          $_SESSION['user']['id_siswa'] = $this->model('siswa_model')->getSiswaByIdPengguna($user['id_pengguna'])['id_siswa'];
        }
        $this->redirect();
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
    Middleware::isNotLoggedIn();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($this->model('auth_model')->register($_POST) > 0) {
        $this->redirect('/auth/login');
      }
      $this->redirect('/auth/register');
    }

    $this->view('partials/auth/header');
    $this->view('auth/register');
    $this->view('partials/auth/footer');
  }

  public function logout()
  {
    Middleware::isLoggedIn();
    session_unset();
    session_destroy();
    setcookie('user', '', time() - 3600, '/');
    $this->redirect('/login');
  }
}
