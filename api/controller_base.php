<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controller
 *
 * @author lenin
 */
class controller_base{
    //put your code here
    protected $controller;
    protected $action;
    protected  $arguments;
    public   function init(slave_controller $s){
        $this->controller=$s->getcontroller();
        $this->action=$s->getaction();
      
        $this->arguments=$s->getarguments();
        //echo $this->arguments[1];
        $ruta=  "controller/".$this->controller.".php";
        if(is_readable($ruta)){
            require_once $ruta;
          
           //self::setcontroller();
           $inst= new $this->controller;
           //self::setaction();
            if (is_callable(array($this->controller, $this->action))) {
                $action = $s->getaction();
               // $inst->$action();
            } else {
                
                $action = 'index';
                 //$inst->$action();
            }
            if (isset($this->arguments)) {
                
               call_user_func_array(array($this->controller, $this->action), $this->arguments);
           
                
            } else {
                //$inst->$action();
              call_user_func(array($this->controller, $this->action));
            }
        }  else {
           throw new Exception('El archivo no está o no es legible');
}
}
}
