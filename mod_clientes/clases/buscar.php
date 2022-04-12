<?php
//include_once("../common/class.php");

$mensaje = "";

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
						<a class="editCliente" id="editarCliente" data-id="'.$ClienteId.'" onClick="Editar('.$ClienteId.');"> 
							<div class="btn btn-primary glyphicon glyphicon-pencil" data-toggle="modal" data-placement="top" title="Editar cliente" id="editCliente" data-target="#FormCliente" ></div>
						</a>
					</td>
					<td class="hide">
						<a class="delete" id="eliminarCliente" data-id="'.$ClienteId.'" onClick="Eliminar('.$ClienteId.');">
							<div data-toggle="modal"  data-target="#confirma" title="Eliminar cliente" class="btn btn-danger fa fa-times"></div>
						</a>
					</td>
				</tr>  ';

		};//Fin while $resultados
		return $mensaje;
    }
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

$consultaBusqueda = $_POST['valorBusqueda'];
$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/", "*", "+", "?");
//$caracteres_buenos = array("&lt;", "&gt;", "&quot;", "&#x27;", "&#x2F;", "&#060;", "&#062;", "&#039;", "&#047;");
$caracteres_buenos = array("", "", "", "", "", "", "", "", "","", "", "");
$consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $consultaBusqueda);

$obj_clientes	= new sQuery();
if ($consultaBusqueda=='Todo'){
	$Query = "SELECT * FROM clientes";
}
else{
	$Query = "SELECT * FROM clientes WHERE CONCAT(Empresa,Ciudad) LIKE '%$consultaBusqueda%'";
}

$obj_clientes->executeQuery($Query); 
echo $obj_clientes->filas(); // retorna todos los usuarios

//$filas = mysqli_num_rows($consulta);
