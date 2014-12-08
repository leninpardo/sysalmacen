<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of salida_controller
 *
 * @author Investigación13
 */
require_once 'api/controller_api.php';
require_once 'model/entrada.php';
require_once 'api/grid.php';
class salida_controller extends controller_api{
    //put your code here
     public function index()
    { $grid=new grid();
        $view=new View();
        $grid->tablename="salida";
        $data=array();
        $data["grid"]=$grid->index();
        $view->setData($data);
         $view->setLayout("template/layout.php");
        $view->setTemplate("template/salida/index.php");
        $view->render(); 
        
    }
}
