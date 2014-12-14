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
require_once 'api/controller_api.php';
require_once 'model/entrada.php';
require_once 'model/salida.php';
class reportes_controller {
    //put your code here
public function index_entradas()
{

        $view=new View();
      
        $data=array();
       
        $view->setData($data);
         $view->setLayout("template/layout.php");
        $view->setTemplate("template/reportes_entrada/index.php");
        $view->render();  
}
public function procesamiento_entrada(){
  $entrada=new entrada();
     $view=new View();
        $data=array();
  $data['kardex']=ORMConnection::Execute("SELECT
entradas.id_entradas,
entradas.fecha_entrada,
entradas.tiempo,
entradas.tipo_comprobante,
entradas.numero_comprobante,
entradas.guia_remision,
entradas.chofer,
detalle_entrada.cantidad,
articulos.articulo,
articulos.descripcion,
unidad_medida.unidad_medida,
categoria.categoria
FROM
entradas
INNER JOIN proveedor ON proveedor.idproveedor = entradas.proveedor
INNER JOIN detalle_entrada ON detalle_entrada.id_entradas = entradas.id_entradas
INNER JOIN articulos ON articulos.id_articulo = detalle_entrada.id_articulo
INNER JOIN unidad_medida ON unidad_medida.id_medida = articulos.id_medida
INNER JOIN categoria ON categoria.id_categoria = articulos.id_categoria
WHERE fecha_entrada>=?and fecha_entrada<=?",array($_REQUEST['fi'],$_REQUEST['ff']));       
        $view->setData($data);
         $view->setLayout("template/layout.php");
        $view->setTemplate("template/reportes_entrada/kardex.php");
        $view->render();  
}
public function procesamiento_salida(){
      $entrada=new salida();
     $view=new View();
        $data=array();
  $data['kardex']=ORMConnection::Execute("SELECT
entradas.id_entradas,
entradas.fecha_entrada,
entradas.tiempo,
entradas.tipo_comprobante,
entradas.numero_comprobante,
entradas.guia_remision,
entradas.chofer,
detalle_entrada.cantidad,
articulos.articulo,
articulos.descripcion,
unidad_medida.unidad_medida,
categoria.categoria
FROM
entradas
INNER JOIN proveedor ON proveedor.idproveedor = entradas.proveedor
INNER JOIN detalle_entrada ON detalle_entrada.id_entradas = entradas.id_entradas
INNER JOIN articulos ON articulos.id_articulo = detalle_entrada.id_articulo
INNER JOIN unidad_medida ON unidad_medida.id_medida = articulos.id_medida
INNER JOIN categoria ON categoria.id_categoria = articulos.id_categoria
WHERE fecha_entrada>=?and fecha_entrada<=?",array($_REQUEST['fi'],$_REQUEST['ff']));       
        $view->setData($data);
         $view->setLayout("template/layout.php");
        $view->setTemplate("template/reportes_entrada/kardex.php");
        $view->render();  
}
public function index_salidas()
{

        $view=new View();
      
        $data=array();
       
        $view->setData($data);
         $view->setLayout("template/layout.php");
        $view->setTemplate("template/reportes_salida/index.php");
        $view->render();  
}
}
