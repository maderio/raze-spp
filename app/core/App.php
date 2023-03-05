<?php

class App
{
  protected $controller = 'Dashboard';
  protected $method     = 'index';
  protected $params     = [];

  public function __construct()
  {
    $url  = $this->parseUrl();

    if (isset($url[0])) {
      if (file_exists("../app/controllers/{$url[0]}.php")) {
        $this->controller = $url[0];
        unset($url[0]);
      }
    }

    require_once "../app/controllers/{$this->controller}.php";
    $this->controller = new $this->controller;

    if (isset($url[1])) {
      $url[1] = str_replace('-', '_', $url[1]);
      if (method_exists($this->controller, $url[1])) {
        $this->method = $url[1];
        unset($url[1]);
      }
    }

    if (!empty($url)) {
      $this->params = array_values($url);
    }

    call_user_func_array([$this->controller, $this->method], $this->params);
  }

  public function parseUrl()
  {
    if (isset($_GET['url'])) {
      $url  = rtrim($_GET['url'], '/');
      $url  = filter_var($url, FILTER_SANITIZE_URL);
      $url  = explode('/', $url);
      return $this->filterController($url);
    }
  }

  public function filterController($url)
  {
    $url[0] = str_replace('_', '', $url[0]);
    $url[0] = str_replace('-', '_', $url[0]);
    return $url;
  }
}
