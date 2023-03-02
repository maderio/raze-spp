<?php

class Controller
{

  public function view($view, $data = [])
  {
    require_once "../app/views/{$view}.php";
  }

  public function model($model)
  {
    require_once "../app/models/{$model}.php";
    return new $model;
  }

  public function directTo($path = '')
  {
    header('location: ' . BASE_URL . $path);
    exit;
  }
}
