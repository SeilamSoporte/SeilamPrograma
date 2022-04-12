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
		$conection['base']="zeuss_db2";           //base de datos		
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
			while($row=  mysqli_fetch_array($this->consulta))
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
	var $Direccion;
	var $Telefono;
	var $Sede;

	function getCliente($id=0)
	{
		$obj_clientes 	= new sQuery();
		$result 	 	= $obj_clientes-> executeQuery("SELECT * FROM clientes WHERE Id=$id");
		$row 		    = mysqli_fetch_array($result);
		if(count($row)!=1){
			$this->Direccion 	=$row['Direccion'];
			$this->Telefono  	=$row['Telefono'];
			$this->Sede 		=$row['Sede'];
		}
		else{
			$this->Direccion 	='';
			$this->Telefono  	='';
			$this->Sede 		='';
		}
	}
}

class Muestras
{
	var $Id;     //se declaran los atributos de la clase, que son los atributos del usuario
	var $Codigo_M;
	var $Consecutivo;
 	var $Resultados;
 	var $Indicacion;
	var $Parametro;
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
	var $Empaque_name;
	var $Lugar;
	var $Medio;
	var $Datos_campo;
	var $Estado_tiempo;
	var $Unidad;
	var $Fecha_result;
	var $Obs_cumplimiento;
	var $Categ;
	var $Clase;
	var $Caracteristicas;
	var $FirmaRMB;
	var $FirmaRFQ;
	var $FirmaAMB;
	var $FirmaAFQ;
	var $Sede;
	var $ResComparador;
	var $Estado;
	var $N_sede;
	var $Firma1;
	var $Firma2;
	var $Firma3;
    function getResultados ($cod=0, $CN=0) 
	{
		$obj_resultados = new sQuery();
		$result =  $obj_resultados->executeQuery("SELECT * FROM `resultados` WHERE Codigo_M=$cod AND CN=$CN");
	    $row = mysqli_fetch_array($result);	
	    if(count($row)!=1){
			$this->Resultados    = $row['Resultados'];
			$this->Fecha_result	 = $row['Fecha'];
			$this->ResComparador = $row['ResComparador'];
			$this->Estado 		 = $row['Estado'];
		}	
		else{
			$this->Resultados    = '';
			$this->Fecha_result	 = '';
			$this->ResComparador = $row['ResComparador'];
			$this->Estado 		 = '';
		}
	} 
 	public static function updateOrden ($datos, $id) 
	{
		$obj_resultados = new sQuery();
		$result= $obj_resultados->executeQuery("SELECT * FROM orden_inf_simp WHERE Id_muestra =$id");
	    $row = mysqli_fetch_array($result);
	    if(count($row)!=1){
	     	return $obj_resultados->executeQuery("UPDATE `orden_inf_simp` SET `Orden`= '$datos' WHERE Id_muestra = $id");
	    }
	    else{
	     	
	     	$query = "INSERT INTO `orden_inf_simp` (Id_muestra, Orden) VALUES ( '$id', '$datos' )" ;
	     	$obj_resultados->executeQuery($query); 	// ejecuta la consulta para traer al registro 
			return $obj_resultados->getAffect();  		
	    }
	    //return count($row);
	} 
 	public static function updateDetalles ($datos, $id, $ninf) 
	{
		$obj_resultados = new sQuery();
		$result= $obj_resultados->executeQuery("SELECT * FROM orden_inf_simp WHERE Id_muestra =$id AND NInf = $ninf");
	    $row = mysqli_fetch_array($result);
	    if(count($row)!=1){
	     	return $obj_resultados->executeQuery("UPDATE `orden_inf_simp` SET `Detalles`= '$datos' WHERE Id_muestra = $id AND NInf = $ninf");
	    }
	    else{
	     	
	     	$query = "INSERT INTO `orden_inf_simp` (Id_muestra, NInf, Detalles) VALUES ( '$id', $ninf,'$datos' )" ;
	     	$obj_resultados->executeQuery($query); 	// ejecuta la consulta para traer al registro 
			return $obj_resultados->getAffect();  		
	    }
	} 
	public static function 	updateObservaciones ($datos, $id, $ninf) 
	{
		$obj_resultados = new sQuery();
		$result= $obj_resultados->executeQuery("SELECT * FROM orden_inf_simp WHERE Id_muestra =$id AND NInf = $ninf");
	    $row = mysqli_fetch_array($result);
	    if(count($row)!=1){
	     	return $obj_resultados->executeQuery("UPDATE `orden_inf_simp` SET `Observaciones`= '$datos' WHERE Id_muestra = $id AND NInf = $ninf");
	    }
	    else{
	     	
	     	$query = "INSERT INTO `orden_inf_simp` (Id_muestra, NInf, Observaciones) VALUES ( '$id', $ninf,'$datos' )" ;
	     	$obj_resultados->executeQuery($query); 	// ejecuta la consulta para traer al registro 
			return $obj_resultados->getAffect();  		
	    }
	} 
	public static function loadOrden ($cod=0) 
	{
		$obj_resultados = new sQuery();
		$obj_resultados->executeQuery("SELECT * FROM orden_inf_simp WHERE Id_muestra ='$cod' AND NInf = 0");
	    return $obj_resultados->fetchAll();
	} 
	public static function loadDetalles ($cod=0, $ninf) 
	{
		$obj_resultados = new sQuery();
		$obj_resultados->executeQuery("SELECT Detalles, Observaciones, Anotaciones FROM orden_inf_simp WHERE Id_muestra ='$cod' AND NInf = $ninf");
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
	function getFirmas(){
		$obj_firma  = new sQuery();
		$result     = $obj_firma-> executeQuery("SELECT * FROM firmas_informes WHERE Id=1");
		$row 	 	= mysqli_fetch_array($result);
		
		$this->FirmaAFQ = ($row['AFQ']>0) ? $this->Usuarios($row['AFQ'])[0]: Array('Nombre'=>'&nbsp;', 'Apellido'=>'&nbsp;', 'Cargo'=>'&nbsp;');
		$this->FirmaRFQ = ($row['RFQ']>0) ? $this->Usuarios($row['RFQ'])[0]: Array('Nombre'=>'&nbsp;', 'Apellido'=>'&nbsp;', 'Cargo'=>'&nbsp;');
		$this->FirmaAMB = ($row['AMB']>0) ? $this->Usuarios($row['AMB'])[0]: Array('Nombre'=>'&nbsp;', 'Apellido'=>'&nbsp;', 'Cargo'=>'&nbsp;');
		$this->FirmaRMB = ($row['RMB']>0) ? $this->Usuarios($row['RMB'])[0]: Array('Nombre'=>'&nbsp;', 'Apellido'=>'&nbsp;', 'Cargo'=>'&nbsp;');
		$this->Firma1 = ($row['FIRMA1']>0) ? $this->Usuarios($row['FIRMA1'])[0]: Array('Nombre'=>'&nbsp;', 'Apellido'=>'&nbsp;', 'Cargo'=>'&nbsp;');		
		$this->Firma2 = ($row['FIRMA2']>0) ? $this->Usuarios($row['FIRMA2'])[0]: Array('Nombre'=>'&nbsp;', 'Apellido'=>'&nbsp;', 'Cargo'=>'&nbsp;');		
		$this->Firma3 = ($row['FIRMA3']>0) ? $this->Usuarios($row['FIRMA3'])[0]: Array('Nombre'=>'&nbsp;', 'Apellido'=>'&nbsp;', 'Cargo'=>'&nbsp;');						
	}
	function getCategoria($Id){
		$obj_cat  	= new sQuery();
		$result 	= $obj_cat->executeQuery("SELECT * FROM categorias WHERE Id=$Id ");
	    $row 		= mysqli_fetch_array($result);
		if(count($row)!=1){
			$this->Categ = $row['Categoria'];
		}	
		else{
			$this->Categ ="";
		}
	}
		function getClase($Id){
		$obj_clase  = new sQuery();
		$result 	 = $obj_clase->executeQuery("SELECT * FROM lista_clases WHERE Id=$Id ");
	    $row 		 = mysqli_fetch_array($result);
		if(count($row)!=1){
			$this->Clase = $row['Clase'];
		}
		else{
			$this->Clase ="";	
		}
	}
	function getSedes($id)
	{
		$obj_clientes = new sQuery();
		$obj_clientes-> executeQuery("SELECT Id,Sede FROM `sedes` WHERE Id_Cliente=$id ");
		return $obj_clientes->fetchAll();	
	}
	function getCodigosPar()
	{
		$obj_parametro=new sQuery();
		$obj_parametro->executeQuery("SELECT Id, Codigo FROM parametros WHERE Is_Deleted=False"); // ejecuta la consulta para traer al parametro
		return $obj_parametro->fetchAll();
	}
	function getParametros($Id=0){
		$obj_parametro=new sQuery();
		$result = $obj_parametro->executeQuery("SELECT * FROM lista_parametros WHERE Id=$Id"); 
		$row    = mysqli_fetch_array($result);
		return $row['Nombre'];
		//return $obj_parametro->fetchAll(); // retorna todos los parametros
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
				ON muestras.Is_Deleted=False AND clientes.Id=muestras.Cliente 
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
	
	function Usuarios($id=0) // declara el constructor, si trae el numero de usuario lo busca , si no, trae todos los datos
	{
		$obj_user = new sQuery();
		$obj_user ->executeQuery("SELECT Nombre, Apellido, Cargo FROM usuarios WHERE Id=$id");
		return $obj_user->fetchAll();
	}	
	function MuestraParametro($nro=0) // declara el constructor, si trae el numero de usuario lo busca , si no, trae todos los datos
	{
		$obj_parametro = new sQuery();
		$obj_parametro->executeQuery("SELECT detalles_muestra.* , parametros.* FROM detalles_muestra JOIN parametros ON detalles_muestra.Codigo_M=$nro  AND parametros.Id=detalles_muestra.Parametro ORDER BY CN ASC");
		return $obj_parametro->fetchAll();
	
	}
	
	function Observaciones($Clase, $Cumpl)
	{
		$obj_observac= new sQuery();
		$result 	 = $obj_observac->executeQuery("SELECT * FROM observaciones WHERE Clase='$Clase' AND Cump='$Cumpl'");
	    $row 		 = mysqli_fetch_array($result);
		if(count($row)!=1){	
			$this->Obs_cumplimiento = $row['Observacion'];
		}
		else{
			$this->Obs_cumplimiento = '';	
		}
	}
	
	function DetallesMuestras($Id=0, $Nro=0) // declara el constructor, si trae el numero de usuario lo busca , si no, trae todos los datos
	{
		$obj_muestra = new sQuery();
		$result 	 = $obj_muestra->executeQuery("SELECT * FROM detalles_muestra WHERE Codigo_M=$Id AND CN=$Nro ORDER BY CN ASC");
	    $row 		 = mysqli_fetch_array($result);
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
			$this->Lugar 		= $row['lugar'];
			$this->Medio 		= $row['medio'];
			$this->Datos_campo 	= $row['datos_campo'];
			$this->Estado_tiempo= $row['estado_tiempo'];
			$this->Unidad		= $row['unidad'];
			//$this->Empaque 		= $row['empaque'];
			$this->Empaque 		= $row['empaque'];
			$this->Caracteristicas= $row['Caracteristicas'];
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
			$this->Unidad		= '';
			$this->Empaque 		= '';
			$this->Caracteristicas='';	
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
			$row 		 = mysqli_fetch_array($result);
			return $row["Max"];	
		}
	}

	function LastMo()
	{
		$obj_muestra = new sQuery();
		$result 	 = $obj_muestra->executeQuery("SELECT MAX(Id) AS Max FROM muestras");
		$row 		 = mysqli_fetch_array($result);
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
			$row 		 = mysqli_fetch_array($result);
				
			$this->Id		  	= $row['Id'];
			$this->Codigo	  	= $row['Codigo'];
			$this->Cliente	  	= $row['Cliente'];
			$this->Fecha_I    	= $row['Fecha_Ingreso'];
			$this->Hora_I    	= $row['Hora_ingreso'];
			$this->Fecha_R	  	= $row['Fecha_Recoleccion'];
			$this->Nombres	  	= $row['Nombres'];
			$this->Nombre_cliente=$row['Nombre_cliente'];
			$this->Sede 		= $row['Sede'];
		}
		else
		{
			$this->Id		 	= "";
			$this->Codigo	 	= "";
			$this->Cliente	 	= "";
			$this->Fecha_I   	= "";
			$this->Hora_I   	= "";
			$this->Fecha_R	 	= "";
			$this->Nombres	 	= "|";
			$this->Nombre_cliente="";
			$this->Sede 		="";
		}			
	}
	
	// metodos que devuelven valores
	function getID()
	 { return $this->Id;}

	function setId($val)
	{ $this->Id=$val;}
	function setResultados($val)
	{ $this->Resultados=$val;}
	function setCodigo_M($val)
	{ $this->Codigo_M=$val;}
	function setConsecutivo($val)
	{ $this->Consecutivo=$val;}
	function updateEstado($val)
	{ $this->estado = $val;}
	
	function updatePrint()
	{
		$obj_muestra=new sQuery();
		$query = "UPDATE muestras SET Print = '$this->estado' WHERE Id = $this->Id";
		$obj_muestra->executeQuery($query);
		return $obj_muestra->getAffect(); 
	}
	function getEmpaque($id=0) 
		{
			$obj_empaques=new sQuery();
			$result 	 = $obj_empaques->executeQuery("SELECT Empaque FROM empaques WHERE Id = '$id'"); // ejecuta la consulta para traer al usuario
			$row		 = mysqli_fetch_array($result);
			if(count($row)!=1){
				$this->Empaque_name	=$row['Empaque'];
			}
			else{
				$this->Empaque_name	='NR';
			}
			
		}
}

class logo
{
		 public static function get_Logo() 
		{
			$obj_logo	= new sQuery();
			$result		= $obj_logo->executeQuery("SELECT Logo FROM empresa WHERE Id = 1"); // ejecuta la consulta para traer al usuario 
			$row		= mysqli_fetch_array($result);
			$obj_logo	= $row['Logo'];
			return $obj_logo;
		}
}

class Empresa
{
	var $Empresa;     //se declaran los atributos de la clase, que son los atributos del usuario
	var $Nit;
	Var $Email;
	Var $Telefono;
	Var $Direccion;
	Var $Regimen;
	Var $Web;
	Var $Logo;
	Var $Id;
	
    public static function getEmpresa() 
		{
			$obj_empresa	= new sQuery();
			$obj_empresa	->executeQuery("SELECT * FROM empresa");

			return $obj_empresa->fetchAll(); // retorna todos los usuarios
		}

	function D_Empresa($nro=0) // declara el constructor, si trae el numero de usuario lo busca , si no, trae todos los datos
	{
		if ($nro!=0)
		{
			$obj_empresa	= new sQuery();
			$result			= $obj_empresa->executeQuery("SELECT * FROM empresa WHERE Id = 1"); // ejecuta la consulta para traer al usuario 
			$row			= mysqli_fetch_array($result);
			
			$this->Id		= 1;//$row['Id'];
			$this->Empresa	= $row['Empresa'];
			$this->Nit		= $row['Nit'];
			$this->Email	= $row['Email'];
			$this->Telefono	= $row['Telefono'];
			$this->Logo		= $row['Logo'];
			$this->Web		= $row['Web'];
			$this->Regimen	= $row['Regimen'];
			$this->Direccion= $row['Direccion'];
		}			
	}	
}


