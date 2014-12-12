<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of reportes_controller
 *
 * @author Investigación13
 */
class reportes_controller {
    //put your code here
public function index_entrada()
{

        $view=new View();
      
        $data=array();
       
        $view->setData($data);
         $view->setLayout("template/layout.php");
        $view->setTemplate("template/reportes_entrada/index.php");
        $view->render();  
}
public function procesamiento_entrada(){
    
}
public function procesamiento_salida(){
    
}
public function index_salida()
{

        $view=new View();
      
        $data=array();
       
        $view->setData($data);
         $view->setLayout("template/layout.php");
        $view->setTemplate("template/reportes_salida/index.php");
        $view->render();  
}
}
