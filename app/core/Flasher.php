<?php

class Flasher
{

  public static function setFlash($type, $msg)
  {
    $_SESSION['flash'] = [
      'type'  => $type,
      'msg'   => $msg,
    ];
  }

  public static function flash()
  {
    if (isset($_SESSION['flash'])) {
      echo '
        <div class="text-center alert alert-' . $_SESSION['flash']['type'] . ' alert-dismissible fade show" role="alert">
          ' . $_SESSION['flash']['msg'] . '
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
      ';
      unset($_SESSION['flash']);
    }
  }
}
