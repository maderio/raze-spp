<?php

class Auth extends Controller
{

  public function login()
  {
    Gate::isNotLoggedIn();

    if (!empty($_POST)) {
      $user = $this->model('auth_model')->login($_POST);
      if ($user) {
        unset($_SESSION['user']);
        $_SESSION['user'] = [
          'id'        => $user['id_pengguna'],
          'name'      => $this->model('auth_model')->getNamaPenggunaByRoleAndId($user['role'], $user['id_pengguna']),
          'username'  => $user['username'],
          'role'      => $user['role'],
        ];
        if ($user['role'] < 3) {
          $_SESSION['user']['id_petugas'] = $this->model('petugas_model')->getPetugasByIdPengguna($user['id_pengguna'])['id_petugas'];
        }
        $this->directTo();
      }
    }

    $this->view('partials/auth/header');
    $this->view('auth/login');
    $this->view('partials/auth/footer');
  }

  public function register()
  {
    Gate::isNotLoggedIn();

    if (!empty($_POST)) {
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
