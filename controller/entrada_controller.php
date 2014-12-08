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
    public function index()
    {
      $grid=new grid();
        $view=new View();
        $grid->tablename="entradas";
        $data=array();
        $data["grid"]=$grid->index();
        $view->setData($data);
         $view->setLayout("template/layout.php");
        $view->setTemplate("template/entrada/index.php");
        $view->render();    
    }
    public function nuevo()
    {
         $view = new View();
        $data = array();
        $data['proveedor']=ORMConnection::Execute("select *from proveedor");
        $data['articulos'] = ORMConnection::Execute("SELECT articulos.id_articulo,articulos.articulo,articulos.descripcion,unidad_medida.unidad_medida,categoria.categoria,articulos.stock 
            from articulos INNER JOIN unidad_medida on(unidad_medida.id_medida=articulos.id_articulo)
INNER JOIN categoria on(categoria.id_categoria) GROUP BY 1");
        $view->setData($data);
        $view->setLayout("template/layout.php");
        $view->setTemplate("template/entrada/new.php");
        $view->render();
    }
}
