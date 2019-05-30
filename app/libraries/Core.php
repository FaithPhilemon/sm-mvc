<?php 
/**
 * APP CORE CLASS
 * Creates URL & Loads core controller (base controller)
 * URL FORMAT - /controller/method/params
 */

class Core{

    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
        // print_r($this->getUrl());

        $url = $this->getUrl();

        // Check coontrollers directory for first[array] value of url(the controller segment)
        if(file_exists('../app/controllers/'. ucwords($url[0]) .'.php')){
            // exist, set as controller
            $this->currentController = ucwords($url[0]);
            // uset 0 index
            unset($url[0]);
        }

        // Require the controller
        require_once '../app/controllers/'. $this->currentController .'.php';

        // Instantiate controller class
        $this->currentController = new $this->currentController;

        // Check the second segment of url [METHOD]
        if(isset($url[1])){
            // check to see if method exist
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];

                // unset url
                unset($url[1]);
            }
        }

        // Get parameter
        $this->params = $url ? array_values($url) : [];

        // Call back with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}

