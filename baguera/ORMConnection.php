<?php

require_once('adodb/adodb.inc.php');
include_once('adodb/adodb-exceptions.inc.php');

include_once("ORMException.php");


class ORMConnection{

	static protected $conn = null;

	public static function  getConnection(){
                        include 'configFile.php';
			//$config_db = $this->getConnectionParamaters(); 

			$conn = ADONewConnection($config_db["driver"]); 
                      
			$conn->PConnect($config_db["server"].":".$config_db['port'],$config_db["user"],$config_db["password"],$config_db["database"]);
			if ( $conn == null)
			{
				throw new ORMConnectionError("Error de Conexion");
			}
			
			if ( ! isset($config_db["charset"]) ) $config_db["charset"] = "utf8";
			
			$conn->execute("SET NAMES '".$config_db["charset"]."'");
			

			global $phpORM_debug;
			$conn->debug = $phpORM_debug;
			$conn->SetFetchMode(ADODB_FETCH_ASSOC);

			return $conn; 
	}
        public static  function closeConnection(){
             if ( self::$conn != null ) 
                 self::$conn->Close();
        }
        public static function debug($debug=true){
		if ( $debug != true ) $debug = false;

		global $phpORM_debug;
		$phpORM_debug = $debug;

	}
        public static  function Begin(){
            if ( self::$conn == null ) 
			self::$conn = self::getConnection();
            self::$conn->BeginTrans();
        }
        public static function Commit(){
            if ( self::$conn == null ) 
			self::$conn = self::getConnection();
            self::$conn->CommitTrans();
        }
        public static function Rollback(){
            if ( self::$conn == null ) 
			self::$conn = self::getConnection();
            self::$conn->RollbackTrans();
        }
        public static  function Execute($sql, $params=array()){
		if ( self::$conn == null ) 
			self::$conn = self::getConnection();
                
		$rs = self::$conn->Execute($sql,$params);
//                $sql=$sql;
//                self::$conn->Execute("INSERT INTO auditoria(l_sql,l_val,l_fecha,l_fval,id_usuario,l_uval)
//                                    values('{$sql}',md5('$sql'),
//                                            NOW(),md5(CAST (now() as VARCHAR)),
//                                            {$_SESSION['usuario']['id_usuario']},md5('{$_SESSION['usuario']['id_usuario']}'))");
//                  self::closeConnection();
                  $aux = array();
                  foreach ( $rs as $item ) $aux[] = $item;
                  //self::$conn->Execute("SELECT grabar_auditoria()");
                  return $aux;
	}

	public static  function getType($t){
		$orm = new ADORecordSet(null);

                return $orm->MetaType($t);
	}
}

?>