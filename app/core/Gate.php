<?php

class Gate
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
    if (isset($_SESSION['user'])) {
      switch ($_SESSION['user']['role']) {
        case 1:
          header('location: ' . BASE_URL . '/admin');
          exit;
          break;
        case 2:
          header('location: ' . BASE_URL . '/staff');
          exit;
          break;
        default:
          header('location: ' . BASE_URL . '/student');
          exit;
          break;
      }
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
