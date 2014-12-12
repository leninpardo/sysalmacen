<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of articulo_controller
 *
 * @author Investigación13
 */
require_once 'api/controller_api.php';
require_once 'model/categoria.php';
require_once 'api/grid.php';
require_once 'model/articulo.php';
require_once 'model/unidad.php';
class articulo_controller {
    //put your code here
     public function index()
    {
         ///
      $grid=new grid();
        $view=new View();
        $grid->tablename="vista_articulos";
        $data=array();
        $data["grid"]=$grid->index();
        $view->setData($data);
         $view->setLayout("template/layout.php");
        $view->setTemplate("template/articulo/index.php");
        $view->render();    
        //
    }
      public function nuevo()
    {
        $view = new View();
        $data = array();
        $categ = new categoria();
        $unidad = new unidad();
        $data['categoria'] = ORMConnection::Execute("select *from categoria", array());
        $data['unidad'] = ORMConnection::Execute("select *from unidad_medida", array());
        $view->setData($data);
        $view->setLayout("template/layout.php");
        $view->setTemplate("template/articulo/new.php");
        $view->render();
    }
    ///esta funcion se utliza tanto apra guardar y actualizar
    public function save(){
        $cate = new articulo();
        if ($_REQUEST['id_articulo'] == null) {
            try {
                //crea un nuevo registro
                $_REQUEST['id_articulo'] = $cate->max_id("id_articulo");
                $cate->setFields($_REQUEST);///cadena del query
                $cate->create(true);//ejecutando o haciendo la inyeccion sql
                //
            } catch (ORMException $e) {
                $respuesta = "error" . $e;
            }
            
        } else {
            try {
                //actualizar un registro
                $cate->find($_REQUEST);
                $cate->setFields($_REQUEST);
                $cate->update();
            } catch (ORMException $e) {
                $respuesta = "error " . $e;
            }
        }
        if ($respuesta == null) {
            echo "<script>window.location='index';</script>";
        } else {
            //En caso de error vuelve al  mismo formulario
            $view = new View();
            $data = array();

            $data['message'] = $respuesta;
            $view->setData($data);
            $view->setLayout("template/layout.php");
            $view->setTemplate("template/articulo/new.php");
            $view->render();
        }
    }
    ///
    public function editar(){
            $view = new View();
        $data = array();
        $categ = new categoria();
        $unidad = new unidad();
        $articulo=new articulo();
        $data['categoria'] = ORMConnection::Execute("select *from categoria", array());
        $data['unidad'] = ORMConnection::Execute("select *from unidad_medida", array());
        $_REQUEST['id_articulo']=$_REQUEST['id'];
        $articulo->find($_REQUEST);
        $data['obj']=$articulo->getFields();
        $view->setData($data);
        $view->setLayout("template/layout.php");
        $view->setTemplate("template/articulo/new.php");
        $view->render();
    }
     public function eliminar()
    {
        $cate = new articulo();
        try {
            $_REQUEST['id_articulo'] = $_REQUEST['id'];
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
            $view->setTemplate("template/articulo/index.php");
            $view->render();
        }
    }
}
