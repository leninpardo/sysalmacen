<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login_controller
 *
 * @author Investigación13
 */
require_once 'api/controller_api.php';
require_once 'model/usuario.php';
class login_controller extends controller_api {
    //put your code here
    public function index()
    {
        $ususario=new usuario();
        $datos=ORMConnection::Execute("select *from login where user=? and password=?",array($_REQUEST['usuario'],$_REQUEST['clave']));
        //echo count($datos);
        if(count($datos)>0)
        {
            $_SESSION['usuario_id']=$datos[0]['user'];
             $_SESSION['usuario']=$datos[0]['id_login'];
            $_SESSION['nombre']=$datos[0]['nombre'];
            echo "<script> window.location='template/index'; </script>"; 
        }else{
           echo "<script> window.location='template/index'; </script>"; 
        }
    }
    public function logout(){
        session_destroy();
         echo "<script> window.location='/".file."/template/index'; </script>"; 
    }
}
