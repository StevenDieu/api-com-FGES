<?php

class Dispatcher
{

    protected $controller = 'home';
    protected $method = 'index';
    protected $params = array();
    protected $url;

    function __construct()
    {
        $this->url = $this->parseUrl();

        if ($this->url[0] != "api" && $this->url[0] != "assistance") {
            if ($_SERVER["REQUEST_URI"] != '/login' && empty($_SESSION["LOGIN"])) {
                header("location: /login");
            }
            if ($_SERVER["REQUEST_URI"] == '/login' && !empty($_SESSION["LOGIN"])) {
                header("location: /");
            }
        }
        $correctControllerIsLoaded = $this->loadController($this->url[0]);
        unset($this->url[0]);
        if ($correctControllerIsLoaded && isset($this->url[1])) {
            $this->loadControllerMethod($this->url[1]);
        }
        $this->params = $this->url ? array_values($this->url) : array();

        call_user_func_array(array($this->controller, $this->method), $this->params);
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return $this->url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

    protected function loadController($controller)
    {
        if ($controller && file_exists(dirname(__FILE__) . '/../controllers/' . ucfirst($controller) . 'Controller.php')) {
            $correctController = true;
            $this->controller = $controller;
        }

        require_once dirname(__FILE__) . '/../controllers/' . ucfirst($this->controller) . 'Controller.php';

        $controllerName = ucfirst($this->controller) . 'Controller';
        $this->controller = new $controllerName;

        return (isset($correctController) && $correctController);
    }

    protected function loadControllerMethod($method)
    {
        if (method_exists($this->controller, $method)) {
            $this->method = $method;
            unset($this->url[1]);
        }
    }

}
