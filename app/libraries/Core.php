<?php

class Core{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];
    public function __construct(){
        //print_r($this->getUrl());
        $url = $this->getUrl();

        //looking in controllers for controller ///ucwords capitalizes first word
        if(file_exists('../app/controllers/' . ucwords($url[0]). '.php')){
            //if it exists, set as controller
            $this->currentController = ucwords($url[0]);
            //unset 0 index
            unset($url[0]);
        }
        //require controller
        require_once '../app/controllers/' .$this->currentController. '.php';

        //instantiate it
        $this->currentController = new $this->currentController;
        
    }

    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'],'/');
            $url = filter_var($url,FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}