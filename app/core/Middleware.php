<?php

class Middleware
{
  public static function isLoggedIn()
  {
    if (isset($_SESSION['user'])) {
      return true;
    } else {
      header('Location: ' . BASE_URL . '/auth/login');
      exit;
    }
  }

  public static function isNotLoggedIn()
  {
    if (!isset($_SESSION['user'])) {
      return true;
    } else {
      header('Location: ' . BASE_URL);
      exit;
    }
  }

  public static function isAdmin()
  {
    if ($_SESSION['user']['role'] == 1) {
      return true;
    } elseif ($_SESSION['user']['role'] == 3) {
      header('Location: ' . BASE_URL . '/dashboard/siswa');
    } else {
      header('HTTP/1.0 403 Forbidden');
      echo 'Access denied.';
      exit;
    }
  }

  public static function isPetugas()
  {
    if ($_SESSION['user']['role'] <= 2) {
      return true;
    } elseif ($_SESSION['user']['role'] == 3) {
      header('Location: ' . BASE_URL . '/dashboard/siswa');
    } else {
      header('HTTP/1.0 403 Forbidden');
      echo 'Access denied.';
      exit;
    }
  }

  public static function isSiswa()
  {
    if ($_SESSION['user']['role'] == 3) {
      return true;
    } else {
      header('HTTP/1.0 403 Forbidden');
      echo 'Access denied.';
      exit;
    }
  }
}
