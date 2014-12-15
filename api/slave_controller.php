<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of slave_controller
 *
 * @author lenin
 */
class slave_controller {
    //put your code here
    private $controller;
    private $action;
    private $arguments;
    public function __construct() {
        if (isset($_GET['url'])) {
            $url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
          
            $url = explode('/', $url);
            $url = array_filter($url);
            $this->controller= strtolower(array_shift($url))."_controller";
            $this->action = strtolower(array_shift($url));
            $this->arguments = $url;              
        }
        
        if (!$this->controller) {
            $this->controller = "template_controller";
        }
   
        if (!$this->action) {
            $this->action = 'index';
        }
        
        if (!isset($this->arguments)) {
            $this->arguments = array();
        }
    }
    
    public function getcontroller() {
        return $this->controller;
    }

    public function getaction() {
        return $this->action;
    }

    public function getarguments() {
        return $this->arguments;
    }
}
