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
   public function nuevo()
    {
        $view=new View();
        $data=array();
        $view->setData($data);
         $view->setLayout("template/layout.php");
        $view->setTemplate("template/usuario/new.php");
        $view->render();  
    }
        public function editar()
    {
        $cate=new usuario();
         $view=new View();
        $data=array();
        $_REQUEST['id_login']=$_REQUEST['id'];
        $cate->find($_REQUEST);
        $data["obj"]=$cate->getFields();
        $view->setData($data);
         $view->setLayout("template/layout.php");
        $view->setTemplate("template/usuario/new.php");
        $view->render();  
    }
 
        public function save()
    {
       $cate = new usuario();
        if ($_REQUEST['id_login'] == null) {
            try {
                $_REQUEST['id_login'] = $cate->max_id("id_login");
                $cate->setFields($_REQUEST);
                $cate->create(true);
            } catch (ORMException $e) {
                $respuesta = "error" . $e;
            }
        } else {
            try {
                $cate->find($_REQUEST);
                $cate->setFields($_REQUEST);
                $cate->update();
            } catch (ORMException $e) {
                $respuesta = "error" . $e;
            }
        }
        if ($respuesta == null) {
            echo "<script>window.location='index';</script>";
        } else {
            ///en caso que ocurra un error
            $view = new View();
            $data = array();
            $data['message'] = $respuesta;
            $view->setData($data);
            $view->setLayout("template/layout.php");
            $view->setTemplate("template/usuario/new.php");
            $view->render();
        }
    }
        public function delete()
    {
        $cate = new usuario();
        try {
            $_REQUEST['id_login'] = $_REQUEST['id'];
            $cate->find($_REQUEST);
            $cate->delete();
        } catch (ORMException $e) {
            $respuesta = "error" . $e;
        }
        if ($respuesta == null) {
            echo "<script>window.location='index';</script>";
        } else {
            $view = new View();
            $data = array();            
            $data['message'] = $respuesta;
            $view->setData($data);
            $view->setLayout("template/layout.php");
            $view->setTemplate("template/usuario/index.php");
            $view->render();
        }
    }
}
