<?php 

class Conexion  // se declara una clase para hacer la conexion con la base de datos
{
	var $con;
	function Conexion()
	{
		$conection['server']="localhost";  					//host
		$conection['user']="531L4M";         //  usuario
		$conection['pass']="OH0rXG7NOXS7Hsp2";             //password
		$conection['base']="DB_S";           //base de datos	
		// crea la conexion pasandole el servidor , usuario y clave
		
		$conect= mysql_connect($conection['server'],$conection['user'],$conection['pass']);

		if ($conect) 										// si la conexion fue exitosa , selecciona la base
		{
			mysql_select_db($conection['base']);		
			mysql_query("SET NAMES 'utf8'");		
			$this->con=$conect;
		}
	}
	function getConexion() 									// devuelve la conexion
	{
		return $this->con;
	}
	function Close()  										// cierra la conexion
	{
		mysql_close($this->con);
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
	
	function insertSede($count)					// inserta el usuario cargado en los atributos
	{
		$obj_sede=new sQuery();
		$query		="INSERT INTO sedes
						( Id_Cliente )
					VALUES 	 
						( $count )";
		$obj_sede->executeQuery($query); 			// ejecuta la consulta para traer al usuario 
		return $obj_sede->getAffect();	 		 	// retorna todos los registros afectados	
		//$obj_sede->Clean();
		//$obj_sede->Close();

	}	
}

function cleanString($string)
{
    $string=trim($string);
    $string=mysql_escape_string($string);
	$string=htmlspecialchars($string);	
    return $string;
}

$insertar = new Sedes();

for ( $cont=6; $cont < 1096; $cont++ )
{
print "ID:". $cont;
print "<br>";
	$insertar->insertSede($cont);
}
?>