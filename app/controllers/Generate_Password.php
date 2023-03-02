<?php

class Generate_Password extends Controller
{
  public function __construct()
  {
    Gate::isNotLoggedIn();
  }

  public function index($text = '')
  {
    if ($text) {
      echo md5($text . SALT);
    }
  }
}
