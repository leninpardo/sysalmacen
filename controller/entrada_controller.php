<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of entrada_controller
 *
 * @author Investigación13
 */
require_once 'api/controller_api.php';
require_once 'model/entrada.php';
require_once 'api/grid.php';
class entrada_controller extends controller_api{
    //put your code here
    public function index() {
        $grid = new grid();
        $view = new View();
        $grid->tablename = "entradas";
        $data = array();
        $data["grid"] = $grid->index();
        $view->setData($data);
        $view->setLayout("template/layout.php");
        $view->setTemplate("template/entrada/index.php");
        $view->render();
    }

    public function nuevo() {
        $view = new View();
        $data = array();
        $data['proveedor'] = ORMConnection::Execute("select *from proveedor");
        $data['articulos'] = ORMConnection::Execute("SELECT articulos.id_articulo,articulos.articulo,articulos.descripcion,unidad_medida.unidad_medida,categoria.categoria,articulos.stock 
            from articulos INNER JOIN unidad_medida on(unidad_medida.id_medida=articulos.id_articulo)
INNER JOIN categoria on(categoria.id_categoria) GROUP BY 1");
        $view->setData($data);
        $view->setLayout("template/layout.php");
        $view->setTemplate("template/entrada/new.php");
        $view->render();
    }
    public function getproductos(){
       $grid=new grid();
        $view=new View();
        $grid->tablename="vista_articulos";
        $data=array();
        $data["grid"]=$grid->index();
        $view->setData($data);
         //$view->setLayout("template/layout.php");
        $view->setTemplate("template/entrada/producto.php");
        echo $view->render_json();   
    }
    
    public function save(){
       $cate=new entrada();
       if($_REQUEST['id_entrada']==null){
           try{
               $_REQUEST['id_entradas'] = $cate->max_id("id_entradas");
               //$_REQUEST['id_login']=$_SESSION['usuario_id'];
                $cate->setFields($_REQUEST);
                $cate->create(true);
                require_once 'model/detalle_entrada.php';
                $obj_det=new detalle_entrada();
                require_once 'model/articulo.php';
                $obj_art=new articulo();
                foreach ($_REQUEST['articulo'] as $a){
                    $_REQUEST['id_detalle_entrada']=$obj_det->max_id("id_detalle_entrada");
                    $_REQUEST['id_articulo']=$a;
                    
                    $_REQUEST['cantidad']=$_REQUEST['articulo'.$a];
                    $obj_det->setFields($_REQUEST);
                    $obj_det->create(true);
                    $_REQUEST['stock']=$_REQUEST['stock'.$a]- $_REQUEST['cantidad'];
                    $obj_art->find($_REQUEST);
                    $obj_art->setFields($_REQUEST);
                    $obj_art->update();
                }
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
        $view->setTemplate("template/categoria/new.php");
        $view->render();  
       } 
    }
public function edit(){
    
}

}
