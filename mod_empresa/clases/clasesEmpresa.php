<?php
//include_once("././common/class.php");

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
		
}
class logo
{
		 public static function get_Logo() 
		{
			$obj_logo	= new sQuery();
			$result		= $obj_logo->executeQuery("SELECT Logo FROM empresa WHERE Id = 1"); // ejecuta la consulta para traer al usuario 
			$row		= mysql_fetch_array($result);
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
			$obj_empresa	->executeQuery("SELECT * FROM empresa"); // ejecuta la consulta para traer al usuario

			return $obj_empresa->fetchAll(); // retorna todos los usuarios
		}

	function D_Empresa($nro=0) // declara el constructor, si trae el numero de usuario lo busca , si no, trae todos los usuarios
	{
		if ($nro!=0)
		{
			$obj_empresa	= new sQuery();
			$result			= $obj_empresa->executeQuery("SELECT * FROM empresa WHERE Id = 1"); // ejecuta la consulta para traer al usuario 
			$row			= mysql_fetch_array($result);
			
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
	// metodos que devuelven valores
	/*
	function getID()
	 { return $this->Id;}
	function getNombre()
	 { return $this->Nombre;}
	function getApellido()
	 { return $this->Apellido;}
	function getEmail()
	 { return $this->email;}
	function getCargo()
	 { return $this->Cargo;}
	function getUsuario()
	 { return $this->username;}
	 */
		
	function setId($val)
	{ $this->Id=1;}
	function setEmpresa($val)
	{ $this->Empresa=$val;}
	function setNit($val)
	{ $this->Nit=$val;}
	function setTelefono($val)
	{ $this->Telefono=$val;}
	function setDireccion($val)
	{ $this->Direccion=$val;}
	function setEmail($val)
	{ $this->Email=$val;}
	function setRegimen($val)
	{ $this->Regimen=$val;}
	function setWeb($val)
	{ $this->Web=$val;}
	function setLogo($val)
	{
		if(!empty($val)){
			$this->Logo=$val;
		}
		else{
			$obj_Logo= new logo();
			$this->Logo = $obj_Logo -> get_Logo();			
		}
	}
	
    function save()
    {
        $data = $this->updateEmpresa();
		if ($data==0)
		{return "No se ha realizado ningún cambio,0";}
		else 
		{return "Los cambios se han guardado correctamente,1";}	
    }
	
	private function updateEmpresa()			// actualiza el usuario cargado en los atributos
	{
		$obj_usuario=new sQuery();
		$query= "UPDATE empresa SET 
					Empresa		= '$this->Empresa',
					Nit			= '$this->Nit', 
					Telefono	= '$this->Telefono',
					Web 		= '$this->Web', 
					Email		= '$this->Email',
					Direccion	= '$this->Direccion', 
					Regimen		= '$this->Regimen',
					Logo		= '$this->Logo'			
				WHERE Id = 1";
		$obj_usuario->executeQuery($query); 	// ejecuta la consulta para traer al usuario 
		return $obj_usuario->getAffect(); 		// retorna todos los registros afectados	
	}
}

function cleanString($string)
{
    $string=trim($string);
    $string=mysql_escape_string($string);
	$string=htmlspecialchars($string);	
    return $string;
}