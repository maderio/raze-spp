<?php

class Gate extends Controller
{

  public static function isLoggedIn()
  {
    if (!isset($_SESSION['user'])) {
      header('location: ' . BASE_URL . '/auth/login');
      exit;
    }
  }

  public static function isNotLoggedIn()
  {
    if (isset($_COOKIE['user'])) {
      $user = self::model('auth_model')->getPenggunaByCookie($_COOKIE['user']);
      if (!$user) {
        header('location: ' . BASE_URL);
        exit;
      }
    }
    if (isset($_SESSION['user'])) {
      header('location: ' . BASE_URL);
      exit;
    }
  }

  public static function isAdmin()
  {
    self::isLoggedIn();

    if ($_SESSION['user']['role'] != 1) {
      header('location: ' . BASE_URL);
      exit;
    }
  }

  public static function isPetugas()
  {
    self::isLoggedIn();

    if ($_SESSION['user']['role'] != 2) {
      header('location: ' . BASE_URL);
      exit;
    }
  }

  public static function isSiswa()
  {
    self::isLoggedIn();

    if ($_SESSION['user']['role'] != 3) {
      header('location: ' . BASE_URL);
      exit;
    }
  }
}
