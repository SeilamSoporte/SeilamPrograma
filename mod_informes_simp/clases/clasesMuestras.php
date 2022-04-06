<?php
header("Content-Type:text/html; charset=utf-8");
class Conexion  // se declara una clase para hacer la conexion con la base de datos
{
	var $con;
	function Conexion()
	{
		// se definen los datos del servidor de base de datos 
		$conection['server']="localhost";  //host
		$conection['user']="531L4M";         //  usuario
		$conection['pass']="OH0rXG7NOXS7Hsp2";             //password
		$conection['base']="DB_S";           //base de datos		
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
	var $ClientesID;
	var $ClientesN;
	function getCLiente($id=0)
	{
		$obj_clientes 	= new sQuery();
		$obj_clientes-> executeQuery("SELECT Empresa FROM clientes WHERE Id=$id");
		$this->ClientesN = $obj_clientes-> fetchRow();
	}
}

class Muestras
{
	var $Id;     //se declaran los atributos de la clase, que son los atributos del usuario
	var $Codigo_M;
	var $Consecutivo;
 	var $Resultados;
 	var $Indicacion;
 	var $Estados;
 	var $Orden;
 	var $Incertidumbres;
 	var $CI;
    public static function getResultadosM ($cod=0, $CN=0) 
	{
		$obj_resultados = new sQuery();
		$obj_resultados->executeQuery("SELECT * FROM resultados WHERE Codigo_M='$cod' AND CN='$CN'");
	    return $obj_resultados->fetchAll();
	} 
    public static function getOrden ($cod=0) 
	{
		$obj_resultados = new sQuery();
		$obj_resultados->executeQuery("SELECT * FROM orden_inf_simp WHERE Id_muestra ='$cod'");
	    return $obj_resultados->fetchAll();
	} 
	
 	/*
    public static function readResultados ($cod=0) 
	{
			$obj_resultados=new sQuery();
			$obj_resultados->executeQuery("SELECT * FROM resultados"); // ejecuta la consulta para traer al parametro
			return $obj_resultados->fetchAll();
	} */
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
	
	public static function getMuestraList($Fdesde, $Fhasta) 
	{
		$obj_muestra =new sQuery();
		$obj_muestra ->executeQuery("SELECT muestras.*, clientes.Empresa AS Nombre_cliente 
			FROM muestras JOIN clientes 
				ON muestras.Is_Deleted=False AND muestras.simp=True AND clientes.Id=muestras.Cliente 
					AND muestras.Fecha_Ingreso BETWEEN $Fdesde AND $Fhasta
						ORDER BY muestras.Id DESC");
		return $obj_muestra->fetchAll(); // retorna todos los datos
	}
    public static function getMuestra() 
		{
			$obj_muestra =new sQuery();
			$obj_muestra ->executeQuery("SELECT muestras.*, clientes.Empresa AS Nombre_cliente 
				FROM muestras JOIN clientes 
					ON muestras.Is_Deleted=False AND clientes.Id=muestras.Cliente ORDER BY muestras.Id DESC");
			/*$obj_muestra ->executeQuery("SELECT muestras.*, detalles_muestra.* , parametros.*
				FROM muestras JOIN detalles_muestra 
					ON detalles_muestra.Codigo_M=muestras.Codigo AND muestras.Is_Deleted=False 
						JOIN parametros 		 
							ON parametros.Codigo=detalles_muestra.Parametro"); // ejecuta la consulta para traer los datos*/
			return $obj_muestra->fetchAll(); // retorna todos los datos
		}

	function CNMuestras($nro=0) // declara el constructor, si trae el numero de usuario lo busca , si no, trae todos los datos
	{
		$obj_muestra = new sQuery();
		$obj_muestra->executeQuery("SELECT CN FROM detalles_muestra WHERE Codigo_M=$nro ORDER BY CN ASC");
		return $obj_muestra->fetchAll();
	
	}	
	function MuestraParametro($nro=0) // declara el constructor, si trae el numero de usuario lo busca , si no, trae todos los datos
	{
		$obj_parametro = new sQuery();
		$obj_parametro->executeQuery("SELECT detalles_muestra.* , parametros.* FROM detalles_muestra JOIN parametros ON detalles_muestra.Codigo_M=$nro  AND parametros.Id=detalles_muestra.Parametro ORDER BY CN ASC");
		return $obj_parametro->fetchAll();
	
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
			$this->CI		= $row['CI'];
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
			$this->Nombre_cliente=$row['Nombre_cliente'];
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
	function setCodigo_M($val)
	{ $this->Codigo_M=$val;}
	function setConsecutivo($val)
	{ $this->Consecutivo=$val;}

	function getEmpaques() 
		{
			$obj_empaques=new sQuery();
			$obj_empaques->executeQuery("select * from empaques"); // ejecuta la consulta para traer al usuario
			return $obj_empaques->fetchAll(); // retorna todos los usuarios
		}
}


/*
function cleanString($string)
{
    $string=trim($string);
    $string=mysql_escape_string($string);
	$string=htmlspecialchars($string);	
    return $string;
}*/