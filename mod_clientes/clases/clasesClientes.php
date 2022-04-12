<?php
//include_once("../common/class.php");

class Conexion  // se declara una clase para hacer la conexion con la base de datos
{
	var $con;
	function Conexion()
	{
		$conection['server']="localhost";  					//host
		$conection['user']="root";         //  usuario
		$conection['pass']="mugres74Root";             //password
		$conection['base']="DB_S";           //base de datos	
		// crea la conexion pasandole el servidor , usuario y clave
		
		$conect= mysqli_connect($conection['server'],$conection['user'],$conection['pass']);

		if ($conect) 										// si la conexion fue exitosa , selecciona la base
		{
			mysqli_select_db($conection['base']);		
			mysqli_query("SET NAMES 'utf8'");		
			$this->con=$conect;
		}
	}
	function getConexion() 									// devuelve la conexion
	{
		return $this->con;
	}
	function Close()  										// cierra la conexion
	{
		mysqli_close($this->con);
	}	
}
class sQuery   												// se declara una clase para poder ejecutar las consultas, esta clase llama a la clase anterior
{

	var $coneccion;
	var $consulta;
	var $resultados;
	function sQuery()  										// constructor, solo crea una conexion usando la clase "Conexion"
	{
		$this->coneccion= new Conexion();
	}
	function executeQuery($cons)  							// metodo que ejecuta una consulta y la guarda en el atributo $pconsulta
	{
		$this->consulta= mysql_query($cons,$this->coneccion->getConexion());
		return $this->consulta;
	}	
	function getResults()   								// retorna la consulta en forma de result.
	{return $this->consulta;}
	
	function Close()										// cierra la conexion
	{$this->coneccion->Close();}	
	
	function Clean() 										// libera la consulta
	{mysql_free_result($this->consulta);}
	
	function getResultados() 								// debuelve la cantidad de registros encontrados
	{return mysql_affected_rows($this->coneccion->getConexion()) ;}
	
	function getAffect() 									// devuelve las cantidad de filas afectadas
	{return mysql_affected_rows($this->coneccion->getConexion()) ;}
	function getLastId()
	{return mysql_insert_id();}
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
	function desencriptar($cadena){
		$key='';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
		$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
		return $decrypted;  //Devuelve el string desencriptado
	}
	function encriptar($cadena){
		$key='';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
		$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
		return $encrypted; //Devuelve el string encriptado
	}
	function filas(){
    	$mensaje ='';
    	$resultados="";
    	while($resultados = mysql_fetch_array($this->consulta)) {
			$ClienteId = $resultados['Id'];
			$mensaje .= '
				<tr>
					<td>'.$resultados['Id'].'</td>
					<td>'.$resultados['Empresa'].'</td>
					<td>'.$resultados['Telefono'].'</td>
					<td>'.$resultados['Ciudad'].'</td>
					<td>'.$resultados['Email'].'</td>
					<td data-hide="phone">
						<a class="editCliente" id="editarCliente" data-id="'.$ClienteId.'" > 
							<div class="btn btn-primary glyphicon glyphicon-pencil" data-toggle="modal" data-placement="top" title="Editar cliente" id="editCliente" data-target="#FormCliente" onClick="Editar();"></div>
						</a>
					</td>
					<td>
						<a class="delete" id="eliminarCliente" data-id="'.$ClienteId.'">
							<div data-toggle="modal"  data-target="#confirma" title="Eliminar cliente" class="btn btn-danger fa fa-times"></div>
						</a>
					</td>
				</tr>  ';

		};//Fin while $resultados
		return $mensaje;
    
    }
}

class Clientes
{
	var $Empresa;     //se declaran los atributos de la clase, que son los atributos del usuario
	var $Nit;
	var $Email;
	var $Telefono;
	var $Telefono2;
	var $Telefono3;
	var $Telefono4;
	var $Direccion;
	var $Regimen;
	var $Web;
	var $Ciudad;
	var $Id;
	
    public static function getClientes() 
		{
			$obj_clientes	= new sQuery();
			$obj_clientes->executeQuery("SELECT * FROM clientes"); 
			//echo $obj_clientes->filas(); // retorna todos los usuarios

			/*$obj_clientes	= new sQuery();
			$obj_clientes	->executeQuery("SELECT * FROM clientes"); // ejecuta la consulta para traer a lo clientes
			*/
			$obj_clientes->fetchAll(); // retorna todos los usuarios*/
			
		}
	
	function D_Cliente($nro=0) // declara el constructor, si trae el numero de usuario lo busca , si no, trae todos los usuarios
	{
		if ($nro!=0)
		{
			$obj_cliente	= new sQuery();
			$result			= $obj_cliente->executeQuery("SELECT * FROM clientes WHERE Id = $nro"); // ejecuta la consulta para traer al usuario 
			$row			= mysql_fetch_array($result);
			
			$this->Id		= $row['Id'];
			$this->Empresa	= $row['Empresa'];
			$this->Nit		= $row['Nit'];
			$this->Email	= $row['Email'];
			$this->Telefono	= $row['Telefono'];
#			$this->Telefono2= $row['Telefono2'];
#			$this->Telefono3= $row['Telefono3'];
#			$this->Telefono4= $row['Telefono4'];
			$this->Web		= $row['Web'];
			$this->Regimen	= $row['Regimen'];
			$this->Direccion= $row['Direccion'];
			$this->Ciudad	= $row['Ciudad'];
		}			
	}
		
	function setId($val)
	{ $this->Id=cleanString($val);}
	function setEmpresa($val)
	{ $this->Empresa=cleanString($val);}
	function setNit($val)
	{ $this->Nit=$val;}
	function setTelefono($val)
	{ $this->Telefono=$val;}
	function setTelefono2($val)
	{ $this->Telefono2=$val;}
	function setTelefono3($val)
	{ $this->Telefono3=$val;}
	function setTelefono4($val)
	{ $this->Telefono4=$val;}
	function setDireccion($val)
	{ $this->Direccion=$val;}
	function setEmail($val)
	{ $this->Email=$val;}
	function setRegimen($val)
	{ $this->Regimen=$val;}
	function setWeb($val)
	{ $this->Web=$val;}
	function setCiudad($val)
	{ $this->Ciudad=$val;}

	
	function save()
	{
		if($this->Id!=0)
		{
			$data = $this->updateCliente();
			if ($data==0)
			{return "No se ha realizado ningún cambio,".$data;}
			else 
			{return "Los cambios se han guardado correctamente,".$data;}
		}
	    else
		{	
			$data = $this->insertCliente();
			
			if ($data[0]==0)
			{return "No se ha realizado ningún cambio,0";}
			else 
			{
				return $data[0].",1,".$data[1];
				//return $data.",1";
			}	
			//echo $data.",0";
		}
	}
	
	private function updateCliente()			// actualiza el usuario cargado en los atributos
	{
		$obj_cliente=new sQuery();
		$query= "UPDATE clientes SET 
					Empresa		= '$this->Empresa', 
					Nit			= '$this->Nit', 
					Telefono	= '$this->Telefono', 
					Web 		= '$this->Web', 
					Email		= '$this->Email',
					Direccion	= '$this->Direccion',  
					Ciudad		= '$this->Ciudad', 
					Regimen		= '$this->Regimen' 						
				WHERE Id = '$this->Id'";
		$obj_cliente->executeQuery($query); 	// ejecuta la consulta para traer al usuario 
		return $obj_cliente->getAffect(); 		// retorna todos los registros afectados	
		$obj_cliente->Clean();
		$obj_cliente->Close();
	}
		
	private function insertCliente()			// inserta el usuario cargado en los atributos
	{
		$obj_cliente=new sQuery();
		$query		="INSERT INTO clientes 
						(Empresa,
  						 Nit, 
						 Telefono,
						 Web,
						 Email,
						 Direccion,
						 Ciudad,
						 Regimen
						 )
					VALUES 	 
						('$this->Empresa', 
						 '$this->Nit',
						 '$this->Telefono',
						 '$this->Web',
						 '$this->Email',
						 '$this->Direccion',
						 '$this->Ciudad',
						 '$this->Regimen'
						 )";
						
		$obj_cliente->executeQuery($query); 	// ejecuta la consulta para traer al usuario 
		//$data= Array(3);
		return $data =[$obj_cliente->getAffect(), $obj_cliente->getLastId()];
		
		$obj_cliente->Clean();
		$obj_cliente->Close();
	/*
		$obj_contacto	=new sQuery();
		$query			="INSERT INTO contacto (Id_Cliente) VALUES ('$this->Empresa')";
		$obj_contacto->executeQuery($query); 	// ejecuta la consulta para traer al usuario 
	*/
	}
	
	function eliminarC()							// elimina el usuario
	{
		$obj_cliente =new sQuery();
		$obj_contacto=new sQuery();
		
		$query		 ="DELETE FROM clientes WHERE id='$this->Id'";
		$query2		 ="DELETE FROM contactos WHERE Id_Cliente='$this->Id'";
		
		$obj_cliente ->executeQuery($query); 	// ejecuta la consulta para  borrar el usuario
		$obj_contacto->executeQuery($query2); 	// ejecuta la consulta para  borrar el usuario
		
		return $obj_cliente ->getAffect();   	// retorna todos los registros afectados	
		//$r2= $obj_contacto->getAffect();
		//$obj_contacto->getAffect();
		//$obj_cliente ->Clean();
		/*/$obj_contacto->Clean();
		$obj_contacto->Close();
		$obj_cliente ->Close();
		*///return ($r1.$r2);
	}	
}

////////////////////////////// ****************************************************************************************///////////////////////
//	 CONTACTOS DEL CLIENTE
////////////////////////////// ****************************************************************************************///////////////////////
class Contactos
{
	var $Nombre;     													//se declaran los atributos de la clase, que son los atributos del contacto
	var $Cargo;
	var $Email;
	var $Telefono;
	var $Celular;
	var $Id_C;
	var $Id;
	
    public static function getContactos($id) 
	{
		$obj_contactos	= new sQuery();
		$obj_contactos	->executeQuery("SELECT * FROM contactos WHERE Id_Cliente=$id"); 	// ejecuta la consulta para traer al contacto
		//return count(mysql_fetch_array($result)); 
		return $obj_contactos->fetchAll();								// retorna todos los contactos
	}

	function D_Contactos($nro=0) 										// declara el constructor, si trae el numero de contacto lo busca , si no, trae todos los contacto
	{
		if ($nro!=0)
		{
			$obj_contacto= new sQuery();
			$result			= $obj_contacto->executeQuery("SELECT * FROM contactos WHERE Id_Cliente = $nro"); // ejecuta la consulta para traer al contacto 
			$row			= mysql_fetch_array($result);
			
			//$this->Id 		= $row['Id'];
			$this->Id_C		= $row['Id'];
			$this->Nombre 	= $row['Nombre'];
			$this->Cargo	= $row['Cargo'];
			$this->Email	= $row['Email'];
			$this->Celular	= $row['Celular'];
			}
	}

	function setId($val)
	{ $this->Id=cleanString($val);}		
	function setId_C($val)
	{ $this->Id_C=cleanString($val);}
	function setContacto($val)
	{ $this->Nombre=$val;}
	function setCargo($val)
	{ $this->Cargo=$val;}
	function setCelular($val)
	{ $this->Celular=($val) ;}
	function setEmail($val)
	{ $this->Email=$val;}

	function save()
	{
		if($this->Id_C!=0)
		{
			$data = $this->updateContacto();
		}
	    else
		{	
			$data = $this->insertContacto();
		/*	if ($data==0)
			{return "No se ha realizado ningún cambio,0";}
			else 
			{return "Los cambios se han guardado correctamente,1";}	
			*///echo $data.",0";
		}
		if ($data==0)
		{return $data;}	 //"No se ha realizado ningún cambio,0";}
		else 
		{return $data;} //"Los cambios se han guardado correctamente,1";}	
	}
	
	private function updateContacto()				// actualiza el usuario cargado en los atributos
	{
		$obj_contacto=new sQuery();
		
		$query= "UPDATE contactos SET 
					Nombre	= '$this->Nombre', 
					Cargo	= '$this->Cargo', 
					Email	= '$this->Email', 
					Celular = '$this->Celular' 
				WHERE Id_Cliente= '$this->Id_C'";
		$obj_contacto->executeQuery($query); 		// ejecuta la consulta para traer al usuario 
		return $obj_contacto->getAffect();	 		// retorna todos los registros afectados	
		//return $query;
	}
	
	private function insertContacto()				// inserta el usuario cargado en los atributos
	{
		$obj_cliente=new sQuery();
		$query		="INSERT INTO contactos
						(Nombre, 
  						 Cargo, 
						 Email, 
						 Celular,
						 Id_Cliente
						 )
					VALUES 	 
						('$this->Nombre',
						 '$this->Cargo',
						 '$this->Email',
						 '$this->Celular',
						 '$this->Id'
						 )";
						
		$obj_cliente->executeQuery($query); 	// ejecuta la consulta para traer al usuario 
		return $obj_cliente->getAffect(); 		// retorna todos los registros afectados
		$obj_cliente->Clean();
	}	
}

////////////////////////////// ****************************************************************************************///////////////////////
//	 SEDES DEL CLIENTE
////////////////////////////// ****************************************************************************************///////////////////////
class Sedes
{
	var $Sede;     													//se declaran los atributos de la clase, que son los atributos del sedes
	var $Direccion;
	var $Ciudad;
	var $Telefono;
	var $Id_C;
	var $Id;
	
    public static function getSedes($id) 
	{
		$obj_contactos	= new sQuery();
		$obj_contactos	->executeQuery("SELECT * FROM sedes WHERE Id_Cliente=$id"); 	// ejecuta la consulta para traer al contacto
		//return count(mysql_fetch_array($result)); 
		return $obj_contactos->fetchAll();								// retorna todos los contactos
	}

	function D_Sedes($nro=0) 										// declara el constructor, si trae el numero de contacto lo busca , si no, trae todos los contacto
	{
		if ($nro!=0)
		{
			$obj_contacto= new sQuery();
			$result			= $obj_contacto->executeQuery("SELECT * FROM sedes WHERE Id_Cliente = $nro"); // ejecuta la consulta para traer al contacto 
			$row			= mysql_fetch_array($result);
			
			$this->Id_C		= $row['Id'];
			$this->Sede 	= $row['Sede'];
			$this->Ciudad	= $row['Ciudad'];
			$this->Direccion= $row['Direccion'];
			$this->Telefono	= $row['Telefono'];
			}
	}

	function setId($val)
	{ $this->Id=cleanString($val);}		
	function setId_C($val)
	{ $this->Id_C=cleanString($val);}
	function setSede($val)
	{ $this->Sede=($val);}
	function setCiudad($val)
	{ $this->Ciudad=$val;}
	function setTelefono($val)
	{ $this->Telefono=($val) ;}
	function setDireccion($val)
	{ $this->Direccion=$val;}

	function save()
	{
		if($this->Id_C!=0)
		{
			$data = $this->updateSede();
		}
	    else
		{	
			$data = $this->insertSede();
		}
		if ($data==0)
		{return $data;}	 //"No se ha realizado ningún cambio,0";}
		else 
		{return $data;}  //"Los cambios se han guardado correctamente,1";}	
	}
	
	private function updateSede()					// actualiza el usuario cargado en los atributos
	{
		$obj_sede=new sQuery();
		$query= "UPDATE sedes SET 
					Sede	 = '$this->Sede', 
					Ciudad	 = '$this->Ciudad', 
					Telefono = '$this->Telefono', 
					Direccion= '$this->Direccion' 
				WHERE Id_Cliente= '$this->Id_C'";
		$obj_sede->executeQuery($query); 			
		return $obj_sede->getAffect();	 			// retorna todos los registros afectados	
	}
	
	private function insertSede()					// inserta el usuario cargado en los atributos
	{
		$obj_sede=new sQuery();
		$query		="INSERT INTO sedes
						(
						 Sede, 
  						 Ciudad, 
						 Direccion, 
						 Telefono,
						 Id_Cliente
						 )
					VALUES 	 
						('$this->Sede',
						 '$this->Ciudad',
						 '$this->Direccion',
						 '$this->Telefono',
						 '$this->Id'
						 )";
						
		$obj_sede->executeQuery($query); 			// ejecuta la consulta para traer al usuario 
		return $obj_sede->getAffect();	 		 	// retorna todos los registros afectados	
		$obj_sede->Clean();
	}	
}

function cleanString($string)
{
    $string=trim($string);
    $string=mysql_escape_string($string);
	$string=htmlspecialchars($string);	
    return $string;
}