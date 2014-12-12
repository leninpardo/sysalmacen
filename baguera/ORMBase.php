<?php
/**
* ORMBase
* Clase Abstracta que implementa el acceso a los campos de un
* registro de una tabla en particular
*/
include_once("ORMConnection.php");
include_once("ORMMetaData.php");
include_once("ORMCollection.php");
include_once("ORMException.php");
global $phpORM_debug;
abstract class ORMBase implements Iterator 
{
	/**
	* Nombre de la tabla que sera controlada por esta clase.
	*/
	protected $tablename;
	
        protected $prefijo;
        protected $columnacodigo;
        protected $numerodigitos;
	/**
	* Campos obtenidos por defecto de la base de datos
	* Caracteristica aun no implementada.
	* NO MODIFICAR
	*/
	protected $selectFields = "*";
	
	
	protected $fields;
	protected $primarykeys;	
	protected $metainfo;
	
	protected $className;
	
	protected $bModified;
	protected $bNull;

	protected $sql = null;

	protected $hasone=array();
	protected $hasmany=array();
	
	// Se encarga de almacenar temporalmente los resultados de las peticiones hasone y hasmany
	private $cache = array();

	// Establece las rutas a concatenar cuando se serializa el objeto
	protected $follow = array();

	// me permite definir nombres de campos equivalentes en las tablas
	// Solo se usa en caso de ser necesario cuando tenemos hasone o hasmany
	protected $translator = null;
	
	private $__friends = array("ORMCollection","ORMBase");
	 
	protected $autoreplaceNull = true;

	protected $exceptions = true;
	
	public function rewind() { reset($this->fields); }
	public function current() { return current($this->fields); }
	public function key() { return key($this->fields); }
	public function next() { return next($this->fields); }
	public function valid() { return ($this->current() !== false ); }
	
	/**
	* Devuelve el nombre de la tabla que maneja este objeto.
	*/
	public function getTableName() {return $this->tablename; }


	/*
		Esta funcion se encarga de obtener informacion acerca de la 
		estructura de la tabla. Es llamada automaticamente por el 
		constructor
	*/
/*
 * 
 * name: _getMetadata
 * @param
 * @return
 */
	public function _getMetadata()
	{	
		if ( $this->metainfo !== null ) 
		{
			$response['fields'] = $this->fields;
			$response['primarykeys'] = $this->primarykeys;
			$response['metainfo'] = $this->metainfo;
		}else
		{
			$filename = "model/metadata/$this->tablename.php";
			if (file_exists($filename) )
			{
				include($filename);

				return $metadata;
			}
			$conn = ORMConnection::getConnection(); 
			$rs = $conn->MetaColumns($this->tablename,FALSE);
                        if(!empty($rs)){
                            foreach($rs as $item)
                            {	
                                    $fields[$item->name]=null;
                                    $metainfo[$item->name]= (array)$item; //array("type"=>$item->type,"length"=>$item->max_length);
                                    if (isset($item->primary_key) && $item->primary_key === true )
                                    {
                                        if(isset($item->auto_increment))
                                            $primarykeys[$item->name] = ($item->auto_increment===true)?-1:0;
                                        else
                                            $primarykeys[$item->name] = 0;
                                    }
                            }
                        }
			
			//$metainfo =  $rs;
			$response["fields"] = &$fields;
			$response["primarykeys"] = &$primarykeys;
			$response["metainfo"] = &$metainfo;
                        
		}
		
		return $response;
	}
	 


/*
 * 
 * name: __construct
 * @param
 		$args:  * lista columnas PK y sus respectivos valores
 				* null
 * @return:		* El objeto relacionado con un registro de la base de datos
 				* El objeto sin relacion con ningun registro de la base de datos
 */
	 

	/**
	*	Crea un objeto tipo ORMBase, obteniendo un registro de la base de datos
	*   cuyas claves PK coincidan con el argumento $args
	*   Internamente llama a $this->find
	*/
	public function __construct($args=null)
	{		
		$this->className = get_class($this);
		
		$metadata = ORMMetadata::getMetadata($this);
		$this->fields = $metadata["fields"];
		$this->primarykeys =  $metadata["primarykeys"];
		$this->metainfo = $metadata["metainfo"];

		if ( is_null($args) )
		 {	
			$this->bNull = True;
			return ;
		 }
		  
		$this->find($args);
	}
        /*
         *@param sqlAsign
         *  where =>"Condicion "
         *  group =>"Agrupacion "
         *  order =>"Ordenamiento "
         * @param state => para el Estado usar solo cuando no se use join
         * @param join 
         *  table =>"Tabla de la cual se hace la union y cruce"
         *  pk    =>"Llave"
         */ 
        public  function listaORM($sqlassign=ARRAY(
                                   "where"=>"",
                                   "group"=>"",
                                   "order"=>""
                                    ),
                                    $state=FALSE,
                                    $join=array()
                                )
        {            
            $sql="SELECT * FROM {$this->tablename} ";
            if(!empty($join)){
               
                foreach($join as $key=>$value){
                    
                    $sql.=" INNER JOIN {$join[$key]['table']} using({$join[$key]['pk']})";
                }
            }
            $WHERE="";
            $GROUP="";
            $ORDER="";            
            if(isset($sqlassign['where'])&&$sqlassign['where']!=""){
                $WHERE=" WHERE ".$sqlassign['where'];
                if($state)$WHERE.=" AND  estado='A'";
            }else if($state)$WHERE=" WHERE estado='A'";
            if(isset($sqlassign['group'])&&$sqlassign['group']!="")$GROUP=" GROUP BY ".$sqlassign['group'];
            if(isset($sqlassign['order'])&&$sqlassign['order']!="")$ORDER=" ORDER BY ".$sqlassign['order'];
            $sql.=$WHERE.$GROUP.$ORDER;
            //die($sql);
            return ORMConnection::Execute($sql);
        }
        /*
         * id          :   Es el Id a Seleccionar
         * descripcion :   Es la Descripcion a Seleccionar
         * estate      :   Es si se va a considerar o no el estado en la seleccion
         * condition   :   Es la condicion que se envia a modo parametro un array (id,val)
         *                 id :Campo de Condicion
         *                 val:Valor de la Condicionante
         * table_orm   :   Es la tabla a anexar con el Orm
         * pk_orm      :   Es la llave del campo ORM que se selecciona
         * field       :   Es la descripcion a anexar
         *     
         */
          public function combo_orm($id,$descripcion,$table_orm,$pk_orm,$field,$estate=true,$condition=array()){
              if(empty($condition)){
                  if($estate)
                    $argc=  $this->getAll ()->WhereAnd ('estado=','A');
                  else
                      $argc=$this->getAll();
              }
              else{
                  if($estate)
                    $argc=  $this->getAll ()->WhereAnd ('estado=','A')->WhereAnd($condition['id']."=",$condition['val']);
                  else
                    $argc=$this->getAll()->WhereAnd($condition['id']."=",$condition['val']);
              }
              $select="<select class='ui-widget-content' id='$id' name='$id' style='width: 100%'  title='".$this->tablename."'><option value='0'>[ SELECCIONE ] </option>";
              include_once "model/$table_orm.php";
              $objorm=new $table_orm();
              
              foreach($argc as $key){
                    $objorm->one("$pk_orm='".$key->$pk_orm."'");
                    $select.="<option value='{$key->$id}'>{$objorm->$field}-{$key->$descripcion}</option>";    
              }
              $select.="</select>";
              return $select;
          }
          public function combo($id,$descripcion,$estate=true,$condition=array(),$seleccione = false,$ancho = 0){
              
              if(empty($condition)){
                  if($estate)
                    $argc=  $this->getAll ()->WhereAnd ('estado=','A');
                  else
                      $argc=$this->getAll();
              }
              else{
                  if($estate)
                    $argc=  $this->getAll ()->WhereAnd ('estado=','A')->WhereAnd($condition['id']."=",$condition['val']);
                  else
                    $argc=$this->getAll()->WhereAnd($condition['id']."=",$condition['val']);
              }
              if(!is_array($descripcion)){
                   $argc = $argc->Orderby($descripcion,true);
              }else{
                  $argc = $argc->Orderby($id,true);
              }
             
              
              if ($seleccione == true)
                    $select="<select class='ui-widget-content' id='$id' name='$id' style='width: 100%'  title='".$this->tablename."'><option value='0'></option>";
              else
                    $select="<select class='ui-widget-content' id='$id' name='$id' style='width: 100%' title='".$this->tablename."'>";
                if(!is_array($descripcion)){
                      foreach($argc as $key){
                    $select.="<option value='{$key->$id}'>{$key->$descripcion}</option>";    
                    }
                    $select.="</select>";
                }else{
                                       
                    foreach($argc as $key){
                       // $select.="<option value='{$key->$id}'>{$key->$descripcion}</option>";   
                        $select.="<option value='{$key->$id}'>";
                        $val=array(); 
                        
                        foreach($descripcion as $value){                              
                            array_push($val,$key->$value);
                        }
                        $select.=implode("-",$val);
                        $select.="</option>";
                      
                    }
                    $select.="</select>";
                }
              
               return $select;
              
          }
          public function opt_combo($id,$descripcion,$estate=true,$condition=array(),$seleccione = false,$ancho = 0){
              
              if(empty($condition)){
                  if($estate)
                    $argc=  $this->getAll ()->WhereAnd ('estado=','A');
                  else
                      $argc=$this->getAll();
              }
              else{
                  if($estate)
                    $argc=  $this->getAll ()->WhereAnd ('estado=','A')->WhereAnd($condition['id']."=",$condition['val']);
                  else
                    $argc=$this->getAll()->WhereAnd($condition['id']."=",$condition['val']);
              }
              if(!is_array($descripcion)){
                   $argc = $argc->Orderby($descripcion,true);
              }else{
                  $argc = $argc->Orderby($id,true);
              }
             
              
              if ($seleccione == true)
                    $select="<option value='0'></option>";
              else
                    $select="";
                if(!is_array($descripcion)){
                      foreach($argc as $key){
                    $select.="<option value='{$key->$id}'>{$key->$descripcion}</option>";    
                    }
                    $select.="</select>";
                }else{
                                       
                    foreach($argc as $key){
                       // $select.="<option value='{$key->$id}'>{$key->$descripcion}</option>";   
                        $select.="<option value='{$key->$id}'>";
                        $val=array(); 
                        
                        foreach($descripcion as $value){                              
                            array_push($val,$key->$value);
                        }
                        $select.=implode("-",$val);
                        $select.="</option>";
                      
                    }
                    $select.="</select>";
                }
              
               return $select;
              
          }
          
  public function type($property)
  {
	if ( ! isset($this->metainfo[$property])) return null;
	return $this->metainfo[$property]["type"];
  }

  public function length($property)
  {
	if ( ! isset($this->metainfo[$property])) return null;
	return $this->metainfo[$property]["length"];
  }
  public function one($args){
      $sql="SELECT * FROM $this->tablename WHERE ".$args;
      $query = ORMConnection::Execute($sql,array());
      if(count($query)>0){
          $registro = $query[0];
          foreach($registro as $key=>$value){
                    if ( array_key_exists($key,$this->fields)){
                       $this->fields[$key]=$value;
                    }
          }
      }      
  }

/*
 * 
 * name: find
 * @param :		* lista columnas PK y sus respectivos valores
 * @return		* El objeto relacionado con un registro de la base de datos
 */
	public function find($args)
	{	
		$sql = "select * from $this->tablename where ";
		$where = ""; 
		$whereargs = array();
                
		foreach ($this->primarykeys as $key=>$value)
		{
			if ( ! isset($args[$key]) )	
				 throw new ORMMissingPrimaryKey("Falta argumento $key en la clave primaria ($this->className)");
			 
			$whereargs["$key=?"] = $args[$key];
		 }

		$where = join(" and ",array_keys($whereargs));

		 $sql = "$sql $where"; 
		 $conn = ORMConnection::getConnection();
		  
		 $rs = $conn->GetRow($sql,$whereargs); 
		 if ( sizeof($rs) === 0 ) throw new ORMRecordNotFound("No existe el registro ($this->className)");
		
		 $this->setFields($rs);
		 		 
		 $this->bModified = false;
		 $this->bNull = false;

	}


	static public function debug($debug=true)
	{
		global $phpORM_debug;
		$phpORM_debug = ($debug === false)?false:true;		
	}

	
	public function getPK()
	{
		return $this->primarykeys;
	}

	public function getColumns()
	{
		return array_keys($this->fields);
	}

	protected function translate($class,$key)
	{	
		if ( $this->translator === null ) return $key; 
		if ( isset($this->translator[$class]))
		{ 
			if (isset($this->translator[$class][$key] ))
			{	
				return $this->translator[$class][$key];
			}
		}
		
		return $key;
	}

	private function getField($attr)
	{
		if ( method_exists($this, "_get_$attr") )
		{
			$method = "_get_$attr";
			return $this->$method();
		}else{
			return $this->fields[$attr];
		}		
	}
		
	
	private function getOne($attr)
	{	
		$className = $this->hasone[$attr];

		$filename = strtolower($className);
		if ( ! class_exists($className,false) )
			include_once("model/$filename.php");

		$aux = new $className();
		$pk = $aux->getPK(); 
		if ( $this->translator === null )
			$pk = $this->fields;
		else
		{
			foreach ($pk as $key => $value )
			{
				//$keyname = $this->translate($className,$key);
				$keyname = $this->translate($attr,$key);
				$pk[$key]=$this->fields[$keyname]; 
			}
		}

        try{
            $aux->find($pk);
        }catch(Exception $e)
        {
            if ( $this->exceptions == true) throw $e;
            return null;
        }
		return $aux;
	
	}

	private function getMany($attr)
	{	
		$className = $this->hasmany[$attr];

		$filename = strtolower($className);
		if ( ! class_exists($className,false) )
			include_once("model/$filename.php");
		
	

		$aux = new $className();
		$pk = $this->getPK();
		$pk2 = array();
		$response =	$aux->getAll();
		foreach ($pk as $key => $value )
		{
			$key2 = $this->translate($className,$key);
			$pk2["$key2 ="]=$this->fields[$key];
			$response = $response->WhereAnd("$key2 = ",$this->fields[$key]);
		}
		
		return $response;		
	}

	public function __get($attr)
	{	

		if ( array_key_exists($attr,$this->fields)) // Buscamos la propiedad entre las columnas de la tabla
		{
			return $this->getField($attr);
		}
		elseif ( array_key_exists($attr,$this->hasone) ) // Se debe devolver un objeto no un valor
		{
			if ( ! isset($cache["one"][$attr]) )
				$cache["one"][$attr] = $this->getOne($attr);
			return $cache["one"][$attr];
		}
		elseif (array_key_exists($attr,$this->hasmany))		//
		{
			if ( ! isset($cache["many"][$attr]) )
				$cache["many"][$attr] = $this->getMany($attr);
			return $cache["many"][$attr];
		}
		else
			throw new ORMPropertyNotValid("Get: Propiedad $attr No valida");
	}

	public function getFields()
	{
		return $this->fields;
	}

	public function setFields($fields = array(),$bNull = false)
	{	
		if ( ! is_array($fields) )
		{
			$this->clean();
			return;
		}
		
		foreach($this->fields as $key=>$value)
		{
			if ( array_key_exists($key,$fields) )
				$this->fields[$key] = $fields[$key];
		}
		$this->bNull = $bNull;
		$this->bModified = true;
	}
	 
	public function __set($attr,$value)
	{
		if ( array_key_exists($attr,$this->fields))
		{
			// ponemos el valor en el formato especificado por la base de datos
			
			if ( array_key_exists($attr, $this->metainfo))
			{
				$formatfunction = "__format".$this->metainfo[$attr]["type"];
				if ( method_exists($this, $formatfunction) ) 
					$value = $this->$formatfuncion($value,$this->metainfo[$attr]);
			}
			
			if ( method_exists($this,"_set_$attr"))
			{
				$method = "_set_$attr";
				$this->$method($value);
			}else
			{
				$this->fields[$attr] = $value;
				
			}
			$this->bModified = true;
		}
		else
			throw new ORMPropertyNotValid("Set: Propiedad $attr No Valida");
	}
	
        public function getCodigo(){
            
            $sql = "select max(".$this->columnacodigo.") as max from ".$this->tablename." where CAST(".$this->columnacodigo." AS VARCHAR) like '".$this->prefijo."%'";
            $conn = ORMConnection::getConnection(); 
            $res = $conn->GetRow($sql); 
                 
            $num = 1;
            
            if (sizeof($res) > 0){
                $max = $res['max'];
                
                $max = str_replace($this->prefijo, "", $max);
                
                $num = intval($max) + 1;
                
            }
            
            $codigo = $this->prefijo;
            
            for($index = $this->numerodigitos ; $index > strlen(strval($num)) ; $index--){
                $codigo = $codigo.'0';
            }
            
            $codigo = $codigo.strval($num);
              
            return $codigo;
        }

        public function update()
	{
		if ( $this->bNull ) throw new ORMNullObject("No se puede actualizar un objeto inexistente");
		 
		if ( $this->bModified )
		{	
			
			$sql = "update $this->tablename set ";
			$set = "";
			$setargs = array();
			$where = ""; 
			$whereargs = array(); 
			foreach($this->fields as $key => $value )
			{ 
				
				if ( ! array_key_exists($key,$this->primarykeys) )
				{ 
					$set = "$set $key=?,";
					if ( $this->metainfo[$key]["type"] == "varchar" or $this->metainfo[$key]["type"] == "int" )
					{ 
						if ( ! is_null($value) )
							$value = substr($value,0,$this->metainfo[$key]["max_length"]);
					}

					$setargs[] = $value;
				}else{
					$where = "$where $key=? and";
					$whereargs[]= $value;	
				}
			}
	
			$where = substr($where,0,strlen($where)-3);
			$set   = substr($set  ,0,strlen($set)-1);
			$sql = "$sql $set where $where";


			$args = array_merge($setargs,$whereargs);
			$conn = ORMConnection::getConnection();  

			$conn->Execute($sql,$args);
			$this->bModified = false;
		}
	}
	
	// Devuelve true en caso que el objeto actual este registrado en la base de datos
	public function exists() { return ! $this->bNull; } 


	// registra al objeto actual en la base de datos
	public function create($force=false)
	{	
	  if ( $force == false )
		if ( ! $this->bNull ) throw new ORMNotNullObject("No se puede crear un objeto ya existente");
		
		$className = get_class($this);
	
		$autoinc = null;
		foreach( $this->primarykeys as $key => $value )
		{
			if ( $value === -1 ) // es autonumerico
			{
			  $autoinc = $key;
			  continue;
			 }

                        if ($this->metainfo[$key]['has_default'] == 1){
                            $autoinc = $key;
                            continue;
                        }

			if ( is_null($this->fields[$key])) 
			{
				throw new ORMMissingPrimaryKey("Create: Falta clave primara $key");
			}
		}


		$keys = "";
		$values = "";
		$valuesargs = array(); 
		foreach ($this->fields as $key=>$value)
		{
			//if ( $value === null ) continue;
			if ( $key === $autoinc ) continue;
			
			if ( $value === null )
			{	
				if ( $this->metainfo[$key]['has_default'] == true )
				{
					$value = $this->metainfo[$key]['default_value'];
					$this->$key = $this->metainfo[$key]['default_value'];
				}else
                                    continue;
			}

			$keys = "$keys $key,";
			$values = "$values ?,"; 
			
			if ( $this->metainfo[$key]["type"] == "varchar" or $this->metainfo[$key]["type"] == "int" ) 
			{
				if ( ! is_null($value) )                                  
                                    $value = substr($value,0,$this->metainfo[$key]["max_length"]);
			}
			$valuesargs[] = ($this->autoreplaceNull and is_null($value))?" ":$value;
		}
			
		$keys = substr($keys,0,strlen($keys)-1);
		$values = substr($values,0,strlen($values)-1);
		
		$sql = "insert into $this->tablename ($keys) values ( $values ) "; 
		$conn = ORMConnection::getConnection();
                $this->sql['sql'] =  $sql;
                $this->sql['values'] = $valuesargs;
                $this->sql['campos'] = $keys;

		$rs = $conn->Execute($sql,$valuesargs); // Donde se llama a addslahes
		
		$this->bNull = false;
		$this->bModified = false;
		if ( is_null($autoinc) ) // NO se genero autoincremento
		{
                    
		}else{
//			$this->fields[$autoinc]=$conn->Insert_ID();
//                   $id = ORMConnection::Execute("SELECT LAST_INSERT_ID() AS seq");
                   $id = ORMConnection::Execute("SELECT LASTVAL() AS seq");
                   $this->fields[$autoinc] = $id[0]['seq'];
		}		
	}
	 
	public function clean()
	{
		$this->_getMetadata();
		$this->bNull = true;
	}
	 
	 
	public function getAll()
	{
            
		$coll = new ORMCollection($this);
		return $coll;
	}  

  	// Se encarga de borrar los objetos de la base de datos
  	public function delete()
  	{
  		if ( $this->bNull === false )
  		{
  			
  			$where = "";
  			$whereargs = array();
  			foreach ($this->primarykeys as $key=>$value)
  			{
  				$where = "$where $key=? and";
  				$whereargs[] = $this->fields[$key];
  			}
  			$where = substr($where,0,strlen($where)-3);
  			$sql = "delete from $this->tablename where $where";

  			$conn = ORMConnection::getConnection();
  			$conn->Execute($sql,$whereargs);
  		}
  	}

	public function toJSON()
	{
		return json_encode($this->fields);
	}

        
        public function activateFollow($follow)
        {
            if ( is_array($follow) )
                $this->follow = $follow;
        }

	public function toXML($depth=0)
	{
		$dom = new DOMDocument('1.0');
		
		$o = $dom->createElement("ormbase");
		$o->setAttribute("name",get_class($this));
		$dom->appendChild($o);
		
		foreach ( $this->fields as $k=>$f )
		{
			$att = $dom->createElement("attribute");
			$att->setAttribute("name",$k);
			$att->setAttribute("value",$f);
			
			$o->appendChild($att);
		}
		
                foreach ( $this->follow as $fkey => $fvalue)
		{   
                    if ( is_array($fvalue))
                    {
                        if ( array_key_exists($fkey,$this->hasmany) )
                        {
                            $aux = $this->followMany($fkey,$dom);
                            $o->appendChild($aux);
                        }elseif ( array_key_exists($fkey,$this->hasone) )
                            {
                                $aux = $this->followOne($fkey,$dom);
                                $o->appendChild($aux);
                            }
                    }else{
                        if ( array_key_exists($fvalue,$this->hasmany))
                        {  
                            $aux = $this->followMany($fvalue,$dom);
                            $o->appendChild($aux);
                        }elseif ( array_key_exists($fvalue,$this->hasone) )
                            {
                                $aux = $this->followOne($fvalue,$dom);
                                $o->appendChild($aux);
                            }
                    }

		}
		
		return $dom;
	}

        private function followMany($attr,$dom)
        {
        		$aux = $dom->createElement("attribute");
        		$aux->setAttribute("name",$attr);
        		
        		$xml = $this->$attr;
        		$xml->activateFollow($this->follow[$attr]);
        		$xml = $xml->toXML();
        		$xml = $xml->getElementsbyTagName("ormcollection")->item(0);
        		$xml = $dom->importNode($xml,true);
        		
        		$aux->appendChild($xml);
        		
        		return $aux;
        	
            /*
            foreach( $this->$attr as $hm )
            {
                if ( is_array(@$this->follow[$attr]) )
                    $hm->activateFollow($this->follow[$attr]);
                $_dom = $hm->toXML();
                $_dom = $_dom->getElementsbyTagName("ormbase")->item(0);
                $_dom = $dom->importNode($_dom,true);
                $aux->appendChild($_dom);
            }
            return $aux;*/
        }

      private function followOne($attr,$dom)
      {
          $aux = $dom->createElement("attribute");
          $aux->setAttribute("name",$attr);


          $hm = $this->$attr;

          if ( is_a($hm,'ORMBase'))
          {
              if ( is_array(@$this->follow[$attr]) )
                $hm->activateFollow($this->follow[$attr]);

              $_dom = $hm->toXML();
              $_dom = $_dom->getElementsbyTagName("ormbase")->item(0);
              $_dom = $dom->importNode($_dom,true);
              $aux->appendChild($_dom);

          }

          return $aux;
      }

    public function toArray()
    {
        return $this->fields;
    }

    static public function select($pk)
    {
    	$className = get_called_class();
    	
    	$obj = new $className();
    	
    	if ( ! is_array($pk)  && count($obj->primaryKeys) == 1 )
    	{
    		$auxPK = array_keys($obj->primaryKeys);
    		$pk = array($auxPK[0] => $pk);	
    	}
    	
    	$obj->find($pk);
    	
    	return $obj;
    }
  
    public function __toSleep()
    {	
    	return $this->fields;
    }

    public function getType($t){
        return ORMConnection::getType($t);
    }
    public function query($sql) {
            return ORMConnection::Execute($sql);
    }
    public  function all() {
     
           return ORMConnection::Execute("select * from $this->tablename where estado_$this->tablename=1");
    
            
    }
    public function count()
    {
        $count= ORMConnection::Execute("select count(*) as total from $this->tablename");
        return $count[0]['total'];
    }
       public function _getFields()
    {
     return ORMConnection::Execute("SELECT COLUMN_NAME as colum_name  FROM information_schema.COLUMNS where table_catalog='".db."' and TABLE_NAME='$this->tablename'");   
    }
    function _convert_fetch_all($data,$fields){
        $data_m=array();
      foreach ($data as $d=>$k)
        {
           // echo $k['usuario_id'];
            foreach ($fields as $j=>$f)
            {
              $campo=$f['colum_name'];
                $dato=$data[$d]["$campo"];
                $data_m[$d][$j]=$dato;
            }
            //echo $dato;
        } 
        return $data_m;
    }
        public function max_id($field){
        $data= self::query("select max($field)+1 as id from $this->tablename");
            if( $data[0]['id']==null){
            $id=1;
        }else{
            $id= $data[0]['id'];
        }
        return $id;
    }
}
?>