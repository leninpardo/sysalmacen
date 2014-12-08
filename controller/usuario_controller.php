<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuario_controller
 *
 * @author lenin
 */
require_once 'api/controller_api.php';
require_once 'model/usuario.php';
require_once 'api/grid.php';
class usuario_controller extends controller_api{
    //put your code here
    public  function index($p,$search){
        //$usuario=new usuario();
        $grid=new grid();
        $view=new View();
        $grid->tablename="login";
        $data=array();
        $data["grid"]=$grid->index();
        $view->setData($data);
         $view->setLayout("template/layout.php");
        $view->setTemplate("template/usuario/index.php");
        $view->render(); 
     
       //echo $usuario->all();

    }
    public function guardar(){
        $usuario=new usuario();
        try {
            $usuario->setFields($_REQUEST);
            $usuario->setFind();
            $usuario->update();
        } catch (Exception $ex) {
           $usuario->setFields($_REQUEST);
           $usuario->create(true);
        }
        
    }
}
