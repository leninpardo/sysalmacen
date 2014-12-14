<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of categoria
 *
 * @author Investigación13
 */
require_once 'api/controller_api.php';
require_once 'model/proveedor.php';
require_once 'api/grid.php';
class proveedor_controller {
    //put your code here
        public function index()
    {
      $grid=new grid();
        $view=new View();
        $grid->tablename="proveedor";
        $data=array();
        $data["grid"]=$grid->index();
        $view->setData($data);
         $view->setLayout("template/layout.php");
        $view->setTemplate("template/proveedor/index.php");
        $view->render();    
    }
    public function nuevo()
    {
        $view=new View();
        $data=array();
        $view->setData($data);
         $view->setLayout("template/layout.php");
        $view->setTemplate("template/proveedor/new.php");
        $view->render();  
    }
    public function edit()
    {
        $obj=new proveedor();
         $view=new View();
        $data=array();
        $_REQUEST['idproveedor']=$_REQUEST['id'];
        $obj->find($_REQUEST);
        $data["obj"]=$obj->getFields();
        $view->setData($data);
         $view->setLayout("template/layout.php");
        $view->setTemplate("template/proveedor/new.php");
        $view->render();  
    }
    public function save()
    {
       $cate=new proveedor();
       if($_REQUEST['idproveedor']==null){
           try{
               $_REQUEST['idproveedor'] = $cate->max_id("idproveedor");
                $cate->setFields($_REQUEST);
                $cate->create(true);
            }catch(ORMException $e){
            $respuesta="error".$e;   
           }
       }else{
           try{
           $cate->find($_REQUEST);
           $cate->setFields($_REQUEST);
           $cate->update();
           }catch(ORMException $e)
           {
             $respuesta="error".$e;     
           }
       }
       if($respuesta==null)
       {
       echo "<script>window.location='index';</script>"; 
       }else{
           ///en caso que ocurra un error
           $view=new View();
        $data=array();       
        $data['message']=$respuesta;
         $view->setData($data);
         $view->setLayout("template/layout.php");
        $view->setTemplate("template/proveedor/new.php");
        $view->render();  
       }
    }
    public function delete()
    {
        $cate = new proveedor();
        try {
            $_REQUEST['idproveedor'] = $_REQUEST['id'];
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
            $view->setTemplate("template/proveedor/index.php");
            $view->render();
        }
    }
}
