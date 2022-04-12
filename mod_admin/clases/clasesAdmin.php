<?php
header("Content-Type:text/html; charset=utf-8");
//include '../clases/serverconn.php';
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
			while($row=  mysqli_fecthy($this->consulta))
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

/**
* 
*/
class Administrador
{
	//se declaran los atributos de la clase
	var $Categoria;
	var $CLase;
	var $Parametro;
	var $CategoriaId;
	var $CLaseId;
	var $ParametroId;
	
	var $Firma1;
	var $Firma2;
	
	var $Id;
	var $Datos;
	var $Tabla;

	function getDatos($tabla)
	{
		$obj_dato = new sQuery();
		$obj_dato->executeQuery("SELECT * FROM $tabla");
	   	$this->Datos = $obj_dato->fetchAll();
	}
	function getFirmas()
	{
		$obj_dato = new sQuery();
		$obj_dato->executeQuery("SELECT * FROM firmas_informes WHERE Id=1");
	   	$this->Datos = $obj_dato->fetchAll()[0];
	}
	function saveFimas($RMB,$AMB,$RFQ,$AFQ,$F1,$F2,$F3)
	{
		$obj_dato = new sQuery();
		$obj_dato->executeQuery("UPDATE firmas_informes SET RMB = '$RMB', AMB = '$AMB', RFQ = '$RFQ', AFQ = '$AFQ', FIRMA1 = '$F1', FIRMA2 = '$F2', FIRMA3 = '$F3'  WHERE Id = 1");
	   	echo $obj_dato->getAffect();		
	}

	function getUsuarios()
	{
		$obj_user = new sQuery();
		$obj_user->executeQuery("SELECT Id, Nombre, Apellido FROM usuarios");
		$this->Datos  = $obj_user->fetchAll(); 
	}
	
	function saveDatos($tabla, $dato, $id)
	{
		switch ($tabla) {
			case 'categorias':
				$campo = 'Categoria';
				break;
			case 'lista_clases':
				$campo = 'Clase';
				break;
			case 'lista_parametros':
				$campo = 'Nombre';
				break;
			case 'equipos':
				$campo = 'Equipo';
				break;		
			case 'observaciones':
				$campo = 'Observacion';
				break;								
			default:
				break;
		}
		$obj_dato = new sQuery();
		$obj_dato->executeQuery("UPDATE $tabla SET $campo = '$dato' WHERE Id = $id");
	   	echo $obj_dato->getAffect();
	}
	
	function insertDatos($tabla, $dato, $id)
	{
		switch ($tabla) {
			case 'categorias':
				$campo = 'Categoria';
				break;
			case 'lista_clases':
				$campo = 'Clase';
				break;
			case 'lista_parametros':
				$campo = 'Nombre';
				break;
			case 'equipos':
				$campo = 'Equipo';
				break;
			default:
				break;
		}
		$obj_dato = new sQuery();
		$obj_dato->executeQuery("INSERT INTO $tabla ($campo) VALUES ('$dato')");
	   	echo $obj_dato->getAffect();
	}

	
	function deleteDatos($tabla, $dato, $id)
	{
		switch ($tabla) {
			case 'categorias':
				$campo = 'Categoria';
				break;

			default:
				break;
		}
		$obj_dato = new sQuery();
		$obj_dato->executeQuery("DELETE FROM $tabla WHERE Id = $id");
	   	echo $obj_dato->getAffect();	
	}

	function setId($val)
	{$this->Id=$val;}

	function setTabla($val)
	{$this->Tabla=$val;}

	function setCategoriaId($val)
	{}
	function setCategoria($val)
	{}
	function setClaseId($val)
	{}
	function setClase($val)
	{}
	function setParametroId($val)
	{}
	function setParametro($val)
	{}
}



