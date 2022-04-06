  <?php
  header("Content-Type:text/html; charset=utf-8");
  class Conexion  // se declara una clase para hacer la conexion con la base de datos
  {
	  var $con;
	  function Conexion()
	  {
		  // se definen los datos del servidor de base de datos 
		  $conection['server']="localhost";  //host
		  $conection['user']="root";         //  usuario
		  $conection['pass']="wWLB2TvXpHdWLNFC";             //password
		  $conection['base']="zeuss_db2";           //base de datos		
		  // crea la conexion pasandole el servidor , usuario y clave
		  $conect= mysql_connect($conection['server'],$conection['user'],$conection['pass']);
		  
		  if ($conect) // si la conexion fue exitosa , selecciona la base
		  {
			  mysql_select_db($conection['base']);		
			  mysql_query("SET NAMES 'utf8'");	
			  $this->con=$conect;
		  }
	  }
	  function getConexion() // devuelve la conexion
	  {
		  return $this->con;
	  }
	  function Close()  // cierra la conexion
	  {
		  mysql_close($this->con);
	  }	
  }
  class sQuery   // se declara una clase para poder ejecutar las consultas, esta clase llama a la clase anterior
  {
	  var $coneccion;
	  var $consulta;
	  var $resultados;
	  function sQuery()  // constructor, solo crea una conexion usando la clase "Conexion"
	  {
		  $this->coneccion= new Conexion();
	  }
	  function executeQuery($cons)  					// metodo que ejecuta una consulta y la guarda en el atributo $pconsulta
	  {
		  $this->consulta= mysql_query($cons,$this->coneccion->getConexion());
		  return $this->consulta;
	  }	
	  function getResults()   						// retorna la consulta en forma de result.
	  {return $this->consulta;}
	  
	  function Close()								// cierra la conexion
	  {$this->coneccion->Close();}	
	  
	  function Clean() 								// libera la consulta
	  {mysql_free_result($this->consulta);}
	  
	  function getResultados() // debuelve la cantidad de registros encontrados
	  {return mysql_affected_rows($this->coneccion->getConexion()) ;}
	  
	  function getAffect() // devuelve las cantidad de filas afectadas
	  {return mysql_affected_rows($this->coneccion->getConexion()) ;}

      function fetchAll()
      {
	  $rows=array();
		  if ($this->consulta)
		  {
			  while($row=  mysql_fetch_array($this->consulta))
			  {
				  $rows[]=$row;
			  }
		  }
	  return $rows;
      }
      function fetchRow()
      {
	  //$rows=array();
		  if ($this->consulta)
		  {
			  $row =  mysql_fetch_row($this->consulta);
		  }
	  return $row[0];
      }
      
  }

  class Clientes
  {
	  //var $ClientesID;
	  var $ClientesN;
	  function get_CLientes()
	  {
		  
		  $obj_clientes 	= new sQuery();
		  
		  //$obj_clientes	-> executeQuery("SELECT * FROM `clientes`");
		      
		  $obj_clientes	-> executeQuery("SELECT Id,Empresa FROM `clientes`");
		  $this->ClientesN= $obj_clientes->fetchAll();
	//	  return ($obj_clientes->fetchAll()); 
	  }
	  function getSedes($id)
	  {
		  $obj_clientes = new sQuery();
		  $obj_clientes-> executeQuery("SELECT Id,Sede FROM `sedes` WHERE Id_Cliente=$id ");
		  return $obj_clientes->fetchAll();	
	  }
  }

  class Muestras
  {
	  var $Id;     //se declaran los atributos de la clase, que son los atributos del usuario
	  var $Cliente;
	  var $Codigo;
	  var $Nombres;
	  var $Fecha_I;
	  var $Fecha_R;
	  var $Hora_ingreso;
	  var $Sede;
	  
	  var $Parametro;
	  var $Codigo_M;
	  var $Consecutivo;
	  var $Descripcion;
	  var $Acta;
	  var $Hora_rec;
	  var $Temperatura;
	  var $Lote;
	  var $Observaciones;
	  var $Fecha_prod;
	  var $Fecha_venc;
	  var $Cantidad;
	  var $Empaque;
	  var $Lugar;
	  var $Medio;
	  var $Datos_campo;
	  var $Comparador_dc;
	  var $Estado_tiempo;
	  var $Unidad;
	  var $Clase;
	  var $Categ;
	  var $Caracteristicas;

	  var $Temp_Parametro;
	  var $Temp_Codigo_M;
	  var $Temp_Consecutivo;
	  var $Temp_Descripcion;
	  var $Temp_Acta;
	  var $Temp_Hora_rec;
	  var $Temp_Temperatura;
	  var $Temp_Lote;
	  var $Temp_Observaciones;
	  var $Temp_Fecha_prod;
	  var $Temp_Fecha_venc;
	  var $Temp_Cantidad;
	  var $Temp_Empaque;

	  var $estado; 

      public static function getParametrizacion ($cod=0) 
	  {
		  $consulta="Id_p= 0";
		  if ($cod!=0){$consulta="Id_p= 'p".$cod."'";}		
		  $obj_parametro=new sQuery();
		  $obj_parametro->executeQuery("SELECT * FROM parametros WHERE Is_Deleted=False AND $consulta ORDER BY Codigo ASC ");  
		  return $obj_parametro->fetchAll(); 
	  } 
      function getTipos ($cod=0) 
	  {
		  $consulta="Id_p= 0";
		  if ($cod!=0){$consulta="Id_p= 'p".$cod."'";}		
		  $obj_parametro=new sQuery();
		  $obj_parametro->executeQuery("SELECT Tipo FROM parametros WHERE Is_Deleted=False AND $consulta"); 
		  return $obj_parametro->fetchRow(); // retorna todos los parametros
  //		return $obj_parametro->fetchAll(); 
	  } 
	  function getClase($Id){
		  $obj_clase  = new sQuery();
		  $result 	 = $obj_clase->executeQuery("SELECT * FROM lista_clases WHERE Id=$Id ");
	      $row 		 = mysql_fetch_array($result);
		  if(count($row)!=1){
			  $this->Clase = $row['Clase'];
		  }
	  }
	  function getCategoria($Id){
		  $obj_cat  = new sQuery();
		  $result 	 = $obj_cat->executeQuery("SELECT * FROM categorias WHERE Id=$Id ");
	      $row 		 = mysql_fetch_array($result);
		  if(count($row)!=1){
			  $this->Categ = $row['Categoria'];
		  }	
	  }

	  function getCodigosPar()
	  {
			  $obj_parametro=new sQuery();
			  $obj_parametro->executeQuery("SELECT Id, Codigo FROM parametros WHERE Is_Deleted=False"); // ejecuta la consulta para traer al parametro
			  return $obj_parametro->fetchAll();
	  }
	  function getParametros($Id=0){
			  $obj_parametro=new sQuery();
			  $obj_parametro->executeQuery("SELECT * FROM lista_parametros WHERE Id=$Id"); 
			  //echo ("SELECT * FROM lista_parametros WHERE Id=$Id");// 
			  return $obj_parametro->fetchAll(); // retorna todos los parametros
	  }
	  function getParametrosN($Id=0){
			  $obj_parametro=new sQuery();
			  $obj_parametro->executeQuery("SELECT Nombre FROM lista_parametros WHERE Id=$Id"); 
			  return $obj_parametro->fetchRow(); // retorna todos los parametros
	  }	

	  function getMedios(){
			  $obj_medio=new sQuery();
			  $obj_medio->executeQuery("SELECT * FROM medios"); 
			  return $obj_medio->fetchAll(); // retorna todos los parametros
	  }	

      public static function getMuestra() 
		  {
		  $obj_muestra =new sQuery();
		  $obj_muestra ->executeQuery("SELECT muestras.*, clientes.Empresa AS Nombre_cliente
			  FROM muestras JOIN clientes 
				  ON muestras.Is_Deleted=False AND clientes.Id=muestras.Cliente 
					  AND muestras.Fecha_Ingreso ORDER BY muestras.Id DESC");
		  return $obj_muestra->fetchAll(); // retorna todos los datos
	  }
      public static function getMuestraList($Fdesde, $Fhasta) 
	  {
		  $obj_muestra =new sQuery();
		  $obj_muestra ->executeQuery("SELECT muestras.*, clientes.Empresa AS Nombre_cliente
			  FROM muestras JOIN clientes 
				  ON muestras.Is_Deleted=False AND clientes.Id=muestras.Cliente 
					  AND muestras.Fecha_Ingreso BETWEEN $Fdesde AND $Fhasta
						  ORDER BY muestras.Id DESC");
		  return $obj_muestra->fetchAll(); // retorna todos los datos
	  }

	  function CNMuestras($nro=0) // declara el constructor, si trae el numero de usuario lo busca , si no, trae todos los datos
	  {
		  $obj_muestra = new sQuery();
		  $obj_muestra->executeQuery("SELECT CN FROM detalles_muestra WHERE Codigo_M=$nro ORDER BY CN ASC");
		  return $obj_muestra->fetchAll();
	  
	  }	
	  function DetallesMuestras($nro=0, $Nro=0) // declara el constructor, si trae el numero de usuario lo busca , si no, trae todos los datos
	  {
		  $obj_muestra = new sQuery();
		  $result 	 = $obj_muestra->executeQuery("SELECT * FROM detalles_muestra WHERE Codigo_M=$nro AND CN=$Nro ORDER BY CN ASC");
	      $row 		 = mysql_fetch_array($result);
		  if(count($row)!=1){
			  
		      $this->Codigo_M		= $row['Codigo_M'];
			  $this->Consecutivo	= $row['CN'];
			  $this->Parametro	= $row['Parametro'];
			  $this->Descripcion  = $row['Descripcion'];
			  $this->Acta	  		= $row['Acta'];
			  $this->Hora_rec	  	= $row['Hora_recoleccion'];
			  $this->Temperatura 	= $row['Temperatura'];
			  $this->Lote 		= $row['Lote_tubo'];
			  $this->Observaciones= $row['Observaciones'];
			  $this->Fecha_prod 	= $row['fecha_produccion'];
			  $this->Fecha_venc 	= $row['fecha_vencimiento'];
			  $this->Cantidad 	= $row['cantidad'];
			  $this->Empaque 		= $row['empaque'];
			  $this->Lugar 		= $row['lugar'];
			  $this->Medio 		= $row['medio'];
			  $this->Datos_campo 	= $row['datos_campo'];
			  $this->Comparador_dc 	= $row['Comparador'];
			  $this->Estado_tiempo= $row['estado_tiempo'];
			  $this->Unidad		= $row['unidad'];
			  $this->Caracteristicas=$row['Caracteristicas'];

		  }
		  else
		  {		
		      $this->Codigo_M	= "";
			  $this->Consecutivo	= '';
			  $this->Parametro	= '';
			  $this->Descripcion  = '';
			  $this->Acta	  		= '';
			  $this->Hora_rec	  	= '';
			  $this->Temperatura 	= '';
			  $this->Lote 		= '';
			  $this->Observaciones= '';
			  $this->Fecha_prod 	= '';
			  $this->Fecha_venc 	= '';
			  $this->Cantidad 	= '';
			  $this->Empaque 		= '';
			  $this->Lugar 		= '';
			  $this->Medio 		= '';
			  $this->Datos_campo 	= '';
			  $this->Estado_tiempo= '';		
			  $this->Unidad 		= '';	
			  $this->Caracteristicas='';
			  $this->Comparador_dc 	='';
		  }	
	  }	
	  function LastMuestra($nro=0)
	  {
		  if ($nro==0){
			  return 0;
		  }
		  else{
			  $obj_muestra = new sQuery();
			  $result 	 = $obj_muestra->executeQuery("SELECT MAX(CN) AS Max FROM detalles_muestra WHERE Codigo_M=$nro");
			  $row 		 = mysql_fetch_array($result);
			  return $row["Max"];	
		  }
	  }

	  function LastMo()
	  {
		  $obj_muestra = new sQuery();
		  $result 	 = $obj_muestra->executeQuery("SELECT MAX(Id) AS Max FROM muestras");
		  $row 		 = mysql_fetch_array($result);
		  return $row["Max"];	
	  }
	  function Muestra($nro=0) // declara el constructor, si trae el numero de usuario lo busca , si no, trae todos los usuarios
	  {
		  if ($nro!=0)
		  {
			  $obj_muestra = new sQuery();
			  $result 	 = $obj_muestra->executeQuery("SELECT muestras.*, clientes.Empresa as Nombre_cliente 
				  FROM muestras JOIN clientes 
					  ON muestras.Id= $nro AND clientes.Id=muestras.Cliente ");
			  $row 		 = mysql_fetch_array($result);
				  
			  $this->Id		  	 = $row['Id'];
			  $this->Codigo	  	 = $row['Codigo'];
			  $this->Cliente	  	 = $row['Cliente'];
			  $this->Fecha_I    	 = $row['Fecha_Ingreso'];
			  $this->Fecha_R	  	 = $row['Fecha_Recoleccion'];
			  $this->Nombres	  	 = $row['Nombres'];
			  $this->Nombre_cliente= $row['Nombre_cliente'];
			  $this->Hora_ingreso  = $row['Hora_ingreso'];
			  $this->Sede  		 = $row['Sede'];
		  }
		  else
		  {
			  $this->Id		 	 = "";
			  $this->Codigo	 	 = "";
			  $this->Cliente	 	 = "";
			  $this->Fecha_I   	 = "";
			  $this->Fecha_R	 	 = "";
			  $this->Nombres	 	 = "|";
			  $this->Hora_ingreso	 = "";
			  $this->Sede  		 = "";
		  }			
	  }
	  
	  // metodos que devuelven valores
	  function getID()
	  { return $this->Id;}
		  // metodos que setean los valores
	      
	  function setId($val)
	  { $this->Id=$val;}
	  function setCodigo($val)
	  { $this->Codigo=$val;}
	  function setCliente($val)
	  { $this->Cliente=$val;}
	  function setFecha_I($val)
	  { $this->Fecha_I=$val;}
	  function setFecha_R($val)
	  { $this->Fecha_R=$val;}
	  function setNombres($val)
	  { $this->Nombres=$val;}
	  function setHoraI($val)
	  { $this->Hora_ingreso=$val;}
	  function setSede($val)
	  { $this->Sede=$val;}

	  function setParametro($val)
	  { $this->Parametro=$val;}
	  function setCodigo_M($val)
	  { $this->Codigo_M=$val;}
	  function setConsecutivo($val)
	  { $this->Consecutivo=$val;}
	  function setActa($val)
	  { $this->Acta=$val;}
	  function setHora_rec($val)
	  { $this->Hora_rec=$val;}
	  function setTemperatura($val)
	  { $this->Temperatura=$val;}
	  function setLote($val)
	  { $this->Lote=$val;}
	  function setObservacion($val)
	  { $this->Observaciones=$val;}
	  function setDescripcion($val)
	  { $this->Descripcion=$val;}
	  function setFechaProd($val)
	  { $this->Fecha_prod=$val;}
	  function setFechaVenc($val)
	  { $this->Fecha_venc=$val;}
	  function setCantidad($val)
	  { $this->Cantidad=$val;}
	  function setEmpaque($val)
	  { $this->Empaque=$val;}	
	  function setMedio($val)
	  { $this->Medio=$val;}	
	  function setEstado($val)
	  { $this->Estado_tiempo=$val;}	
	  function setCampo($val)
	  { $this->Datos_campo=$val;}	
	  function setComparador($val)
	  { $this->Comparador_dc=$val;}
	  function setLugar($val)
	  { $this->Lugar=$val;}
	  function setUnidad($val)
	  { $this->Unidad=$val;}
	  function setCaracteristicas($val)
	  { $this->Caracteristicas=$val;}
	  function updateEstado($val)
	  { $this->estado = $val;}

	  function insert_m()
	  {
		  $obj_muestra=new sQuery();
		  $query = "INSERT INTO `detalles_muestra`
		    (Codigo_M, 
			  CN,
			  Parametro,
			  Acta,
			  Hora_recoleccion,
			  Temperatura ) 
		  VALUES ( 
			  '$this->Codigo_M', 
			  '$this->Consecutivo', 
			  '$this->Parametro',
			  '$this->Acta',
			  '$this->Hora_rec',
			  '$this->Temperatura' )";
		  $obj_muestra->executeQuery($query); 	// ejecuta la consulta para traer al registro 
		  return $obj_muestra->getAffect(); 		// retorna todos los registros afectados
		  //return LastMuestra($this->Codigo_M);
	  }

	  function updatePrint()
	  {
		  $obj_muestra=new sQuery();
		  $query = "UPDATE muestras SET Print = '$this->estado' WHERE Id = $this->Id";
		  $obj_muestra->executeQuery($query);
		  return $obj_muestra->getAffect(); 
	  }

      function save_muestra()
      {
	  if($this->Id!=0)
		  {
			  return $data = $this->updateMuestra();
		  }
	  else
		  {	//return "Id:".$this->Id;
			  return $data = $this->insertMuestra();
		  }
      }
	  
	  private function updateMuestra()			// actualiza el usuario cargado en los atributos    
	  {
		  $obj_muestra=new sQuery();
		  $query= "UPDATE muestras SET 
					  Codigo			 = '$this->Codigo',
					  Cliente			 = '$this->Cliente',
					  Fecha_Ingreso	 = '$this->Fecha_I',	
					  Fecha_Recoleccion= '$this->Fecha_R',
					  Nombres		  	 = '$this->Nombres',
					  Hora_ingreso  	 = '$this->Hora_ingreso',
					  Sede 			 = '$this->Sede'
				  WHERE id = $this->Id";
		  
		  $obj_muestra->executeQuery($query); 	// ejecuta la consulta para traer al usuario 
		  return $obj_muestra->getAffect(); 		// retorna todos los registros afectados	
	  }
	  
	  function insertMuestra()			// inserta muestra cargado en los atributos
	  {
		  
		  $obj_muestra=new sQuery();
		  $query		="INSERT INTO muestras 
						  (Codigo,	
						  Cliente,
						  Fecha_Ingreso,
						  Fecha_Recoleccion,
						  Nombres,
						  Hora_ingreso,
						  Sede
						  )
					  VALUES 	 
						  ('$this->Codigo', 
						  '$this->Cliente',
						  '$this->Fecha_I',
						  '$this->Fecha_R',
						  '$this->Nombres',
						  '$this->Hora_ingreso',
						  '$this->Sede'
						  )";
		  $obj_muestra->executeQuery($query); 	// ejecuta la consulta para traer al registro 
		  $obj_muestra->getAffect(); 		// retorna todos los registros afectados
		  return mysql_insert_id();
	  }	

	  function updateDetMuestra()			// actualiza el usuario cargado en los atributos    
	  {
		  $obj_DetMuestra=new sQuery();
		  $query= "UPDATE detalles_muestra SET 
					  Parametro		 	= '$this->Parametro',
					  Descripcion		= '$this->Descripcion',
					  Acta			 	= '$this->Acta',
					  Hora_recoleccion 	= '$this->Hora_rec',
					  Temperatura		= '$this->Temperatura',
					  Lote_tubo		 	= '$this->Lote',	
					  Observaciones	 	= '$this->Observaciones',
					  fecha_produccion 	= '$this->Fecha_prod',
					  fecha_vencimiento	= '$this->Fecha_venc',
					  cantidad		 	= '$this->Cantidad',
					  empaque			= '$this->Empaque',
					  datos_campo		= '$this->Datos_campo',
					  Comparador		= '$this->Comparador_dc',
					  estado_tiempo	 	= '$this->Estado_tiempo',
					  lugar	 		 	= '$this->Lugar',
					  unidad	 		= '$this->Unidad'
				  WHERE Codigo_M = $this->Codigo_M AND CN = $this->Consecutivo";
		  
		  $obj_DetMuestra->executeQuery($query); 	// ejecuta la consulta para traer al usuario 
		  return $obj_DetMuestra->getAffect(); 		// retorna todos los registros afectados	
	  }
	  
	  function insertDetMuestra()			// inserta muestra cargado en los atributos
	  {
		  $obj_muestra=new sQuery();
		  $query = "INSERT INTO `detalles_muestra`
		    (Codigo_M, 
			  CN,
			  Parametro,
			  Descripcion,
			  Acta,
			  Hora_recoleccion,
			  Temperatura,
			  Lote_tubo,
			  Observaciones,
			  fecha_produccion,
			  fecha_vencimiento,
			  cantidad,
			  empaque,
			  datos_campo,
			  estado_tiempo,
			  lugar,
			  unidad,
			  Comparador)
			  
		  VALUES ( 
			  '$this->Codigo_M', 
			  '$this->Consecutivo', 
			  '$this->Parametro',
			  '$this->Descripcion',
			  '$this->Acta',
			  '$this->Hora_rec', 
			  '$this->Temperatura', 
			  '$this->Lote', 
			  '$this->Observaciones', 
			  '$this->Fecha_prod',
			  '$this->Fecha_venc', 
			  '$this->Cantidad', 
			  '$this->Empaque',
			  '$this->Datos_campo',
			  '$this->Estado_tiempo',
			  '$this->Lugar',
			  '$this->Unidad',
			  '$this->Comparador_dc')";
		  $obj_muestra->executeQuery($query); 	// ejecuta la consulta para traer al registro 
		  return $obj_muestra->getAffect(); 		// retorna todos los registros afectados
	  }	

	  function delete()							// elimina el registro
	  {
		  $obj_muestra= new sQuery();
		  $query 		= "UPDATE muestras SET Is_Deleted = '1'	WHERE Id = $this->Id";
		  
		  $obj_muestra->executeQuery($query); 	// ejecuta la consulta para traer al usuario 
		  return $obj_muestra->getAffect(); 		// retorna todos los registros afectados	
		  $obj_muestra->Clean();
	  }	

	  function getEmpaques() 
		  {
			  $obj_empaques=new sQuery();
			  $obj_empaques->executeQuery("select * from empaques"); // ejecuta la consulta para traer al usuario
			  return $obj_empaques->fetchAll(); // retorna todos los usuarios
		  }
  }

