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

    function filas(){
    	$mensaje ='';
    	$resultados="";
    	while($resultados = mysql_fetch_array($this->consulta)) {
			$Id = $resultados['Id'];
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
				</tr> ';

		};//Fin while $resultados
		return $mensaje;
    }

}

class Clientes
{
	var $ClientesID;
	var $ClientesN;
	function getCLientes()
	{
		$obj_clientes = new sQuery();
		$obj_clientes-> executeQuery("SELECT Id,Empresa FROM cLientes");
		return $obj_clientes->fetchAll(); 
	}
}

class Muestras
{
	var $Id;   
	var $Factura;
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
	function getFacturas($Id) 
	{
		$obj_muestra =new sQuery();
		$result = $obj_muestra ->executeQuery("SELECT rel_facturas.N_Factura FROM rel_facturas WHERE Id_muestra=$Id");
		$row 	=  mysql_fetch_array($result);
		return $row['N_Factura'];
	}
	
	function setId($val)
	{ $this->Id=$val;}
	function setFactura($val)
	{ $this->Factura=$val;}

    function update_f($Id)
    {
    	$obj_factura 	= new sQuery();
    	$query 		 	= "SELECT * FROM rel_facturas WHERE Id_muestra = $Id";
    	$result 	 	= $obj_factura->executeQuery($query);
    	$row 		 	= mysql_fetch_array($result);

    	if (count($row)>1){
			$query 		= "UPDATE rel_facturas SET N_Factura = '$this->Factura' WHERE Id_muestra = $this->Id";
			$result 	= $obj_factura->executeQuery($query);
			$obj_factura->getAffect();
		}
    	else{
    		$query 		= "INSERT INTO rel_facturas (Id_muestra, N_Factura) VALUES ('$this->Id', '$this->Factura')";
    		$result 	= $obj_factura->executeQuery($query);
			$obj_factura->getAffect();	
    	}
    }

function buscar($valorBusqueda){
	$consultaBusqueda = $valorBusqueda;//$_POST['valorBusqueda'];
	$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/", "*", "+", "?");
	$caracteres_buenos= array("", "", "", "", "", "", "", "", "","", "", "");
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
  }
}

