<?php
///error_reporting(E_ERROR);
define("file", 'sysalmacen');
require './api/controller_base.php';
require './api/slave_controller.php';
include './baguera/configFile.php';
try{
    session_start();
$cont=new controller_base();
$cont->init(new slave_controller);
} catch (Exception $e) {
    echo(utf8_decode($e->getMessage()));
}
?>