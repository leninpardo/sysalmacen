<?php
global $config_db;
$config_db['driver'] = 'mysql';
$config_db['server'] = 'localhost';
$config_db['user'] = 'root';
$config_db['password'] = '';
$config_db['database']='sysalmacen';
$config_db['port']='3306';
$config_db['sistema']='sysalmacen';
$config_db['host']='localhost';
$config_db['urlsistema']="{$config_db['host']}{$config_db['url']}";
define("db", $config_db["database"]);
?>
