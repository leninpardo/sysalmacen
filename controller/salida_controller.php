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
require_once 'model/salida.php';
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
 

    public function nuevo() {
        $view = new View();
        $data = array();
        $data['proveedor'] = ORMConnection::Execute("select *from proveedor");
       /* $data['articulos'] = ORMConnection::Execute("SELECT articulos.id_articulo,articulos.articulo,articulos.descripcion,unidad_medida.unidad_medida,categoria.categoria,articulos.stock 
            from articulos INNER JOIN unidad_medida on(unidad_medida.id_medida=articulos.id_articulo)
INNER JOIN categoria on(categoria.id_categoria) GROUP BY 1");*/
        $view->setData($data);
        $view->setLayout("template/layout.php");
        $view->setTemplate("template/salida/new.php");
        $view->render();
    }

    public function getproductos() {
        $grid = new grid();
        $view = new View();
        $grid->tablename = "vista_articulos";
        $data = array();
        $data["grid"] = $grid->index();
        $view->setData($data);
        //$view->setLayout("template/layout.php");
        $view->setTemplate("template/entrada/producto.php");
        echo $view->render_json();
    }

    public function save() {
        $cate = new salida();
        if ($_REQUEST['id_salida'] == null) {
            try {
                $_REQUEST['id_salida'] = $cate->max_id("id_salida");
                //$_REQUEST['id_login']=$_SESSION['usuario_id'];
                $cate->setFields($_REQUEST);
                $cate->create(true);
                require_once 'model/detalle_salida.php';
                $obj_det = new detalle_salida();
                require_once 'model/articulo.php';
                $obj_art = new articulo();
                foreach ($_REQUEST['articulo'] as $a) {
                    $_REQUEST['id_detalle_salida'] = $obj_det->max_id("id_detalle_salida");
                    $_REQUEST['id_articulo'] = $a;

                    $_REQUEST['cantidad'] = $_REQUEST['articulo' . $a];
                    $obj_det->setFields($_REQUEST);
                    $obj_det->create(true);
                    $_REQUEST['stock'] = $_REQUEST['stock' . $a] - $_REQUEST['cantidad'];
                    $obj_art->find($_REQUEST);
                    $obj_art->setFields($_REQUEST);
                    $obj_art->update();
                }
            } catch (ORMException $e) {
                $respuesta = "error" . $e;
            }
        } else {
            try {
                require_once 'model/articulo.php';
                $prod=new articulo();
               $datos_det=ORMConnection::Execute("SELECT articulos.id_articulo,articulos.descripcion,categoria.categoria,unidad_medida.unidad_medida,articulos.stock,detalle_salida.cantidad
from articulos INNER JOIN detalle_salida on(detalle_salida.id_articulo=articulos.id_articulo)
INNER JOIN categoria on(categoria.id_categoria=articulos.id_categoria)
INNER JOIN  unidad_medida on(unidad_medida.id_medida=articulos.id_medida)
WHERE detalle_salida.id_salida=?", array($_REQUEST['id_salida']));
                foreach ($datos_det as $dt)
                {
                   $_REQUEST['id_articulo']=$dt['id_articulo'];
                   
                   $prod->find($_REQUEST);
                   $datos=$prod->getFields();
                   $_REQUEST['stock']=$datos['stock']+$dt['cantidad'];
                   $prod->find($_REQUEST);
                   $prod->setFields($_REQUEST);
                   $prod->update();
                   
                   
                }
                 ORMConnection::Execute("delete from detalle_salida where id_salida=?",array($_REQUEST['id_salida']));
               // ORMConnection::Execute("delete from detalle_entrada where detalle_entrada.id_entradas=?",array($_REQUEST['id']));
                $cate->find($_REQUEST);
                $cate->setFields($_REQUEST);
                $cate->update();
                //
                
                 require_once 'model/detalle_salida.php';
                $obj_det = new detalle_salida();
                
                $obj_art = new articulo();
                foreach ($_REQUEST['articulo'] as $a) {
                    $_REQUEST['id_detalle_salida'] = $obj_det->max_id("id_detalle_salida");
                    $_REQUEST['id_articulo'] = $a;

                    $_REQUEST['cantidad'] = $_REQUEST['articulo'.$a];
                    $obj_det->setFields($_REQUEST);
                    $obj_det->create(true);
                  
                   $_REQUEST['stock'] = $_REQUEST['stock'.$a] -$_REQUEST['cantidad'];
                    $obj_art->find($_REQUEST);
                    $obj_art->setFields($_REQUEST);
                    $obj_art->update();
                }
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
            $view->setTemplate("template/categoria/new.php");
            $view->render();
        }
    }

    public function editar() {
          $cate=new salida();
         $view=new View();
        $data=array();
        $_REQUEST['id_salida']=$_REQUEST['id'];
        $cate->find($_REQUEST);
        $data["obj"]=$cate->getFields();
        $data['proveedor'] = ORMConnection::Execute("select *from proveedor");
        ////////////////////////////////////
        $data['obj_detalle']=  ORMConnection::Execute("SELECT articulos.id_articulo,articulos.descripcion,categoria.categoria,unidad_medida.unidad_medida,articulos.stock,detalle_salida.cantidad
from articulos INNER JOIN detalle_salida on(detalle_salida.id_articulo=articulos.id_articulo)
INNER JOIN categoria on(categoria.id_categoria=articulos.id_categoria)
INNER JOIN  unidad_medida on(unidad_medida.id_medida=articulos.id_medida)
WHERE detalle_salida.id_salida=?", array($_REQUEST['id']));
        $view->setData($data);
         $view->setLayout("template/layout.php");
        $view->setTemplate("template/entrada/new.php");
        $view->render(); 
    }
    
    public function eliminar(){
         $cate = new salida();
        try {
            ORMConnection::Execute("delete from detalle_salida where id_salida=?",array($_REQUEST['id']));
            $_REQUEST['id_salida'] = $_REQUEST['id'];
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
            $view->setTemplate("template/categoria/index.php");
            $view->render();
        }
}

}
