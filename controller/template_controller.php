<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of template_controller
 *
 * @author lenin
 */
require_once 'api/controller_api.php';
class template_controller extends controller_api{
    //put your code here
    public function index()
    {
     if($_SESSION['usuario_id']){
         $data=array();
         $view=new View();
         $view->setData($data);
          $view->setData($data);
         $view->setLayout("template/_blank.php");
         $view->setTemplate("template/layout.php");
         $view->render();
     }  
     else{
         $data=array();
         $view=new View();
        $view->setData($data);
         $view->setLayout("template/_blank.php");
        $view->setTemplate("template/login.php");
         $view->render();   
     } 
    }
    ///function _show->ver
    //function _new->nuevo
    //function _edit->editar
    //function _create->insertar
    //function _update->insertar
    //function _destroy->destruir
    
}
