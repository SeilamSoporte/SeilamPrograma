<?php
date_default_timezone_set('America/Bogota');
header("Content-Type:text/html; charset=utf-8");
class Conexion  // se declara una clase para hacer la conexion con la base de datos
{
	var $con;
	function Conexion()
	{
		// se definen los datos del servidor de base de datos 
		$conection['server']="localhost";  //host
		$conection['user']="root";         //  usuario
		$conection['pass']="mugres74Root";             //password
		$conection['base']="DB_S";           //base de datos		
		// crea la conexion pasandole el servidor , usuario y clave
		$conect= mysqli_connect($conection['server'],$conection['user'],$conection['pass']);
		
		if ($conect) // si la conexion fue exitosa , selecciona la base
		{
			mysqli_select_db($conection['base']);		
			mysqli_query("SET NAMES 'utf8'");	
			$this->con=$conect;
		}
	}
	function getConexion() // devuelve la conexion
	{
		return $this->con;
	}
	function Close()  // cierra la conexion
	{
		mysqli_close($this->con);
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
		$this->consulta= mysqli_query($cons,$this->coneccion->getConexion());
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
	var $ClientesID;
	var $ClientesN;
	function getCLiente($id=0)
	{
		$obj_clientes = new sQuery();
		$obj_clientes-> executeQuery("SELECT Empresa FROM cLientes WHERE Id=$id");
		return $obj_clientes->fetchAll(); 
	}
}

class Muestras
{
	var $Id;     //se declaran los atributos de la clase, que son los atributos del usuario
	var $Codigo_M;
	var $Consecutivo;
 	var $Resultados;
 	var $Indicacion;
 	var $Categ;
 	var $Clase;
 	var $ResComparador;
 	var $fechaR; 	
 	var $Incertidumbres;

    public static function getResultados ($cod=0, $CN=0) 
	{
		$obj_resultados=new sQuery();
		$obj_resultados->executeQuery("SELECT * FROM resultados WHERE Codigo_M='$cod' AND CN='$CN'"); // ejecuta la consulta para traer al parametro
		return $obj_resultados->fetchAll();
	} 

    public static function getParametrizacion ($cod=0) 
	{
		$consulta="Id_p= 0";
		if ($cod!=0){$consulta="Id_p= 'p".$cod."'";}		
		$obj_parametro=new sQuery();
		$obj_parametro->executeQuery("SELECT * FROM parametros WHERE Is_Deleted=False AND $consulta");  
		return $obj_parametro->fetchAll(); 
	} 
	function getClase($Id){
		$obj_clase  = new sQuery();
		$result 	 = $obj_clase->executeQuery("SELECT * FROM lista_clases WHERE Id=$Id ");
	    $row 		 = mysql_fetch_array($result);
		if(count($row)!=1){
			$this->Clase = $row['Clase'];
		}
		else{
			$this->Clase = '-';
		}
	}
	function getCategoria($Id){
		$obj_cat  	 = new sQuery();
		$result 	 = $obj_cat->executeQuery("SELECT * FROM categorias WHERE Id=$Id ");
	    $row 		 = mysql_fetch_array($result);
		if(count($row)!=1){
			$this->Categ = $row['Categoria'];
		}	
		else{
			$this->Categ = '-';	
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
   public static function getMuestraList($Fdesde, $Fhasta) 
		{
			$obj_muestra =new sQuery();
			$obj_muestra->executeQuery("SELECT DISTINCT muestras.Id as codigo, muestras.*, detalles_muestra.Codigo_M, detalles_muestra.Parametro FROM muestras, detalles_muestra WHERE muestras.Id = detalles_muestra.Codigo_M AND muestras.Fecha_Ingreso BETWEEN $Fdesde AND $Fhasta AND detalles_muestra.Parametro IN (SELECT Id FROM parametros WHERE Area = 'Fisicoquímico') GROUP BY detalles_muestra.Codigo_M ORDER BY detalles_muestra.Codigo_M DESC") ;
			return $obj_muestra->fetchAll(); // retorna todos los datos
		}
    public static function getMuestra() 
		{
			$obj_muestra =new sQuery();
			$obj_muestra->executeQuery("SELECT DISTINCT muestras.Id as codigo, muestras.*, detalles_muestra.Codigo_M, detalles_muestra.Parametro FROM muestras, detalles_muestra WHERE muestras.Id = detalles_muestra.Codigo_M AND detalles_muestra.Parametro IN (SELECT Id FROM parametros WHERE Area = 'Fisicoquímico') GROUP BY detalles_muestra.Codigo_M ORDER BY detalles_muestra.Codigo_M DESC") ;
			return $obj_muestra->fetchAll(); // retorna todos los datos
		}

	function CNMuestras($nro=0) // declara el constructor, si trae el numero de usuario lo busca , si no, trae todos los datos
	{
		$obj_muestra = new sQuery();
		$obj_muestra->executeQuery("SELECT CN FROM detalles_muestra WHERE Codigo_M=$nro ORDER BY CN ASC");
		return $obj_muestra->fetchAll();
	
	}	
	function MuestraPrametro($nro=0) // declara el constructor, si trae el numero de usuario lo busca , si no, trae todos los datos
	{
		$obj_parametro = new sQuery();
		$obj_parametro->executeQuery("SELECT detalles_muestra.* , parametros.* FROM detalles_muestra JOIN parametros ON detalles_muestra.Codigo_M=$nro  AND parametros.Id=detalles_muestra.Parametro AND parametros.Area='Fisicoquímico' ORDER BY CN ASC");
		return $obj_parametro->fetchAll();
	
	}
	function getCaracteristicas($Id=0, $Nro=0){
		$obj_caract  = new sQuery();
		$result 	 = $obj_caract->executeQuery("SELECT Caracteristicas FROM detalles_muestra WHERE Codigo_M=$Id AND CN=$Nro");
	    $row 		 = mysql_fetch_array($result);
	    return $row['Caracteristicas'];
	}
	function DetallesMuestras($Id=0, $Nro=0) // declara el constructor, si trae el numero de usuario lo busca , si no, trae todos los datos
	{
		$obj_muestra = new sQuery();
		$result 	 = $obj_muestra->executeQuery("SELECT * FROM detalles_muestra WHERE Codigo_M=$Id AND CN=$Nro ORDER BY CN ASC");
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
			$this->Estado_tiempo= $row['estado_tiempo'];
			$this->Unidad		= $row['unidad'];
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
				
			$this->Id		  	= $row['Id'];
			$this->Codigo	  	= $row['Codigo'];
			$this->Cliente	  	= $row['Cliente'];
			$this->Fecha_I    	= $row['Fecha_Ingreso'];
			$this->Fecha_R	  	= $row['Fecha_Recoleccion'];
			$this->Nombres	  	= $row['Nombres'];
			//$this->Nombre_cliente=$row['Nombre_cliente'];
		}
		else
		{
			$this->Id		 	= "";
			$this->Codigo	 	= "";
			$this->Cliente	 	= "";
			$this->Fecha_I   	= "";
			$this->Fecha_R	 	= "";
			$this->Nombres	 	= "|";
		}			
	}
	
	// metodos que devuelven valores
	function getID()
	 { return $this->Id;}
		// metodos que setean los valores
	    
	function setId($val)
	{ $this->Id=$val;}
	function setResultados($val)
	{ $this->Resultados=$val;}
	function setIncertidumbres($val)
	{ $this->Incertidumbres=$val;}	
	function setResComparador($val)
	{$this->ResComparador=$val;}
	function setCodigo_M($val)
	{ $this->Codigo_M=$val;}
	function setConsecutivo($val)
	{ $this->Consecutivo=$val;}
	function setCaracteristicas($val)
	{$this->Caracteristicas=$val;}	
	function setFechaR($val)
	{$this->fechaR=$val;}

	function insert_r()
	{
		$Estado = "Modificado/Actualizado";
		$Fecha  	 = date('Y-m-d');
		$obj_results = new sQuery();
		$query  	 = "INSERT INTO `resultados`
		   (Codigo_M, 
			CN,
			Resultados, 
			Estado,
			Fecha, 
			ResComparador,
			Incertidumbres ) 
		VALUES ( 
			'$this->Codigo_M', 
			'$this->Consecutivo', 
			'$this->Resultados',
			'$Estado',
			'$Fecha',
			'$this->ResComparador',
			'$this->Incertidumbres' )";
		$obj_results->executeQuery($query); 	// ejecuta la consulta para traer al registro 
		$this->updateResult();
		return $obj_results->getAffect(); 		// retorna todos los registros afectados
	}

    function save_muestra()
    {
        if($this->Id!=0)
		{
			return $data = $this->updateResult();
		}
        else
		{	//return "Id:".$this->Id;
			return $data = $this->insertMuestra();
		}
    }
	
	function updateResult()			// actualiza el usuario cargado en los atributos    
	{
		
		$obj_muestra=new sQuery();
		#$Estado = "Modificado/Actualizado";
		$result 	 = $obj_muestra->executeQuery("SELECT * FROM Resultados WHERE Codigo_M = '$this->Codigo_M' AND CN = '$this->Consecutivo'");
	    $row 		 = mysql_fetch_array($result);
		$Estado 	 = $row['Estado'];

		#$Fecha  = date('Y-m-d');
		$query  = "UPDATE detalles_muestra SET Caracteristicas = '$this->Caracteristicas' WHERE Codigo_M = '$this->Codigo_M' AND CN = '$this->Consecutivo'";
		$obj_muestra->executeQuery($query);

		$query  = "UPDATE resultados SET Resultados = '$this->Resultados', Estado = '$Estado', Fecha='$this->fechaR' , ResComparador = '$this->ResComparador',  Incertidumbres = '$this->Incertidumbres' WHERE Codigo_M = '$this->Codigo_M' AND CN = '$this->Consecutivo'";		
		$obj_muestra->executeQuery($query); 	// ejecuta la consulta para traer al usuario 
		return $obj_muestra->getAffect(); 		// retorna todos los registros afectados	
		#return $query;
	}
	
	function Reportar($id,$cn)			// actualiza el usuario cargado en los atributos    
	{
		$obj_muestra=new sQuery();
		$Estado = "Reportado";
		#$Fecha  = date('Y-m-d');
		$query  = "UPDATE resultados SET Estado = '$Estado', Fecha='$this->fechaR' WHERE Codigo_M = '$id' AND CN = '$cn'";
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
						 Nombres
						 )
					VALUES 	 
						('$this->Codigo', 
						 '$this->Cliente',
						 '$this->Fecha_I',
						 '$this->Fecha_R',
						 '$this->Nombres'
						)";
		$obj_muestra->executeQuery($query); 	// ejecuta la consulta para traer al registro 
		$obj_muestra->getAffect(); 		// retorna todos los registros afectados
		return mysql_insert_id();
	}	

	function updateDetMuestra()			// actualiza el usuario cargado en los atributos    
	{
		$obj_DetMuestra=new sQuery();
		$query= "UPDATE detalles_muestra SET 
					Parametro		 = '$this->Parametro',
					Descripcion		 = '$this->Descripcion',
					Acta			 = '$this->Acta',
					Hora_recoleccion = '$this->Hora_rec',
					Temperatura		 = '$this->Temperatura',
					Lote_tubo		 = '$this->Lote',	
					Observaciones	 = '$this->Observaciones',
					fecha_produccion = '$this->Fecha_prod',
					fecha_vencimiento= '$this->Fecha_venc',
					cantidad		 = '$this->Cantidad',
					empaque			 = '$this->Empaque',
					datos_campo		 = '$this->Datos_campo',
					estado_tiempo	 = '$this->Estado_tiempo',
					lugar	 		 = '$this->Lugar'
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
			empaque ) 
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
			'$this->Empaque' )";
		$obj_muestra->executeQuery($query); 	// ejecuta la consulta para traer al registro 
		return $obj_muestra->getAffect(); 		// retorna todos los registros afectados
	}	

	function delete()							// elimina el registro
	{
		$obj_muestra= new sQuery();
		$query 		= "UPDATE muestras SET Is_Deleted = '1'	WHERE id = $this->Id";
		
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
