<?php

class App {

    protected $controller = 'login';
    protected $method = 'index';
    protected $special_url = ['apply'];
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // If URL is empty
        if (empty($url) || !isset($url[0]) || $url[0] === '') {
            $url[0] = $this->controller;
        }

        // Check if actually controller file exists
        if (file_exists('app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            $_SESSION['controller'] = $this->controller;

            if (in_array($this->controller, $this->special_url)) {
                $this->method = 'index';
            }
            unset($url[0]);
        } else {
            header('Location: /home');
            die;
        }

        require_once 'app/controllers/' . $this->controller . '.php';

        $this->controller = new $this->controller;

        // Check method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                $_SESSION['method'] = $this->method;
                unset($url[1]);
            }
        }

        // Rebase params array to have sequential indexes starting at 0
        $this->params = $url ? array_values($url) : [];

        // Call controller method with params
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $segments = explode('/', trim($path, '/'));
        return $segments;
    }
}
