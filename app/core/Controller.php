<?php

class Controller
{
  protected function view($view, $data = [])
  {
    if (file_exists("../app/views/{$view}.php")) {
      require_once "../app/views/{$view}.php";
    } else {
      die('View does not exist');
    }
  }

  protected function model($model)
  {
    if (file_exists("../app/models/{$model}.php")) {
      require_once "../app/models/{$model}.php";
      return new $model;
    } else {
      die('Model does not exist');
    }
  }

  protected function redirect($path = '')
  {
    header('Location: ' . BASE_URL . $path);
    exit;
  }
}
