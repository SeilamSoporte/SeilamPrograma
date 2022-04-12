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

class Muestras
{
	var $Id;     //se declaran los atributos de la clase, que son los atributos del usuario
	var $Codigo;
	var $Nombres;
	var $Fecha_I;
	
	var $Parametro;
	var $Codigo_M;
	var $Consecutivo;
	var $Lote;

    public static function getParametrizacion ($cod=0) 
	{
		$consulta="Id_p= 0";
		if ($cod!=0){$consulta="Id_p= 'p".$cod."'";}		
		$obj_parametro=new sQuery();
		$obj_parametro->executeQuery("SELECT * FROM parametros WHERE Is_Deleted=False AND $consulta");  
		return $obj_parametro->fetchAll(); 
	} 

	function getCodigosPar()
	{
			$obj_parametro=new sQuery();
			$obj_parametro->executeQuery("SELECT Id, Codigo FROM parametros WHERE Is_Deleted=False"); // ejecuta la consulta para traer al parametro
			return $obj_parametro->fetchAll();
	}
	function getParametros($Id=0){
			$obj_parametro=new sQuery();
			$obj_parametro->executeQuery("SELECT * FROM parametros WHERE Id=$Id"); 
			//echo ("SELECT * FROM lista_parametros WHERE Id=$Id");// 
			return $obj_parametro->fetchAll(); // retorna todos los parametros
	}
	function getParametrosA($Id=0){
			$obj_parametro=new sQuery();
			$obj_parametro->executeQuery("SELECT * FROM parametros WHERE Id=$Id AND "); 
			return $obj_parametro->fetchAll(); // retorna todos los parametros
	}
	function getParametrosN($Id=0){
			$obj_parametro=new sQuery();
			$obj_parametro->executeQuery("SELECT Nombre FROM lista_parametros WHERE Id=$Id"); 
			return $obj_parametro->fetchRow(); // retorna todos los parametros
	}	
	function getEquiposN($Id){
			$obj_parametro=new sQuery();
			$obj_parametro->executeQuery("SELECT Equipo FROM equipos WHERE Id=$Id"); 
			return $obj_parametro->fetchRow(); // retorna todos los parametros
	}
	function getDatosx($Id){
			$obj_datos=new sQuery();
			$obj_datos->executeQuery("SELECT * FROM muestras WHERE Id=$Id"); 
			return $obj_datos->fetchAll(); // retorna todos los parametros
	}
	function getDatosCampo($Code,$Cn){
			$obj_datos=new sQuery();
			$obj_datos->executeQuery("SELECT datos_campo FROM detalles_muestra WHERE Codigo_M=$Code AND CN = $Cn"); 
			return $obj_datos->fetchAll(); // retorna todos los parametros
	}
    public static function getMuestrax() 
	{
		$obj_muestra =new sQuery();
		$obj_muestra->executeQuery("SELECT DISTINCT muestras.Id as codigo, muestras.*, detalles_muestra.Codigo_M, detalles_muestra.CN,detalles_muestra.Parametro FROM muestras, detalles_muestra WHERE muestras.Id = detalles_muestra.Codigo_M AND detalles_muestra.Parametro IN (SELECT Id FROM parametros WHERE Area = 'Microbiológico')") ;
			return $obj_muestra->fetchAll(); // retorna todos los datos
	}
	public static function getMuestra($desde,$hasta) 
	{
		$obj_muestra =new sQuery();
		$obj_muestra->executeQuery("SELECT DISTINCT muestras.Id as codigo, muestras.Fecha_Ingreso, muestras.Codigo, muestras.Fecha_Recoleccion,muestras.Nombres, detalles_muestra.Codigo_M, detalles_muestra.CN,detalles_muestra.Parametro FROM muestras, detalles_muestra WHERE muestras.Id = detalles_muestra.Codigo_M AND muestras.Fecha_Ingreso BETWEEN '$desde' AND '$hasta' AND muestras.Is_Deleted='0'") ;
			return $obj_muestra->fetchAll(); // retorna todos los datos
	}
	public static function getMuestraDC($desde,$hasta) 
	{
		$obj_muestra =new sQuery();
		$obj_muestra->executeQuery("SELECT DISTINCT muestras.Id as codigo, muestras.Fecha_Ingreso, muestras.Codigo, muestras.Fecha_Recoleccion,muestras.Nombres, detalles_muestra.Codigo_M, detalles_muestra.CN,detalles_muestra.Parametro FROM muestras, detalles_muestra WHERE muestras.Id = detalles_muestra.Codigo_M AND muestras.Fecha_Ingreso BETWEEN '$desde' AND '$hasta' AND muestras.Is_Deleted='0' AND detalles_muestra.Parametro IN (SELECT Id FROM parametros WHERE Area = 'Fisicoquímico')") ;
			return $obj_muestra->fetchAll(); // retorna todos los datos
	}
	public static function getLogo() 
	{
		$obj_logo =new sQuery();
		$obj_logo->executeQuery("SELECT empresa.Logo as logo FROM empresa WHERE Id =1") ;
		return $obj_logo->fetchAll(); // retorna todos los datos
	}
	function CNMuestras($nro=0) // declara el constructor, si trae el numero de usuario lo busca , si no, trae todos los datos
	{
		$obj_muestra = new sQuery();
		$obj_muestra->executeQuery("SELECT CN FROM detalles_muestra WHERE Codigo_M=$nro ORDER BY CN ASC");
		return $obj_muestra->fetchAll();
	
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
			$result 	 = $obj_muestra->executeQuery("SELECT * FROM muestras WHERE Id= $nro");
			$row 		 = mysql_fetch_array($result);
				
			$this->Id		  	 = $row['Id'];
			$this->Codigo	  	 = $row['Codigo'];
			$this->Fecha_I    	 = $row['Fecha_Ingreso'];
		}
		else
		{
			$this->Id		 	 = "";
			$this->Codigo	 	 = "";
			$this->Fecha_I   	 = "";
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
	function setLugar($val)
	{ $this->Lugar=$val;}
	function setUnidad($val)
	{ $this->Unidad=$val;}
	 function setCaracteristicas($val)
	 { $this->Caracteristicas=$val;}
}


/*
function cleanString($string)
{
    $string=trim($string);
    $string=mysql_escape_string($string);
	$string=htmlspecialchars($string);	
    return $string;
}*/