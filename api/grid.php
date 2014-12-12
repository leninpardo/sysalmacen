<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of grid
 *
 * @author lenin
 */
include_once '../baguera/ORMBase.php';
include_once 'api/class.AutoPagination.php';
class grid extends ORMBase{
    //put your code here
    public $tablename;
    public  $tabla;
    public $p;
    public $index;
    public  $search;
    public function __construct() {
        $this->tabla="<table class='table table-bordered table-hover dataTable' id='table_$this->tablename'><tr>";
    }
    public function index()
    {
        $data=  ORMConnection::Execute("select *from ".$this->tablename, array());
        return $data;
    }
            function addColumn($column){
        $this->tabla.="<td>$column</td>";
    }
    function _sql($campos)
    {
        if($this->search==null)
        {
            $sql="select * from $this->tablename limit 10 offset $this->index";
        }
        else{
            $sql="select * from $this->tablename where ";
            $c=0;
            foreach ($campos as $f)
            {
                 $c++;
                      $campo=$f['colum_name'];
                if($c<count($campos))
                {
                  $sql.=" cast($campo as varchar) like '%".$this->search."%' or ";   
                }else{
                     $sql.=" cast($campo as varchar) like '%".$this->search."%'  ";
                }
          
               
            }
            $sql.=" limit 10 offset $this->index";
        }
        return $sql;
    }
    public function _grid()
    {
        if($this->p==null){
            $this->p=1;
            $this->index=0;
        }else{
            $this->index=($this->p-1)*10;
        }
        $this->tabla.="</tr>";
         $fields=  $this->_getFields();
        $data=$this->query(self::_sql($fields));
        foreach ($data as $k=>$j)
        {
            $this->tabla.="<tr>";
            foreach ($fields as $f)
            {
              $campo=$f['colum_name'];
               $dato=$data[$k]["$campo"];
               $this->tabla.="<td>$dato</td>";
                
            }
            $this->tabla.="</tr>";
        } 
        $this->tabla.="</table>";
        
       // return $this->tabla;
        //echo $this->count();
       $obj = new AutoPagination(100, $this->p); // is the total record count
       echo $obj->_paginateDetails();
       //data total limit de 1o
       //count de toda la data
        //total de campos
        //se divide 10 para determinar la cantidad de 
        //se muestre si es decimal se aumenta+1
        // 
    }

    //postgres sacar el nombre de los campos de la tabla
 
}
