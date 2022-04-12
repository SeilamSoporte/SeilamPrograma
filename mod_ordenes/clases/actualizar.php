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

 	function getParametrizacion ($cod=0) 
	{
		$obj_parametro=new sQuery();
		$obj_parametro->executeQuery("SELECT Parametros FROM parametros WHERE Id=$cod");  
		$Dato = $obj_parametro->fetchAll(); 
		return $Dato [0]['Parametros'];
	} 
	function actualizar($NC, $cod=0)
	{
		$obj_parametro=new sQuery();
		$obj_parametro->executeQuery("UPDATE parametros SET Solucion = '$NC' WHERE Id = $cod");
		return $obj_parametro->fetchAll(); 		
	}

	$N=0;
	$C=0;
	
	for($N=1 ; $N<308 ; $N++){
		#echo $N;
		$NC = '';
		$ND=count(explode('|',getParametrizacion($N) ) );
		//echo getParametrizacion($N).'->'.$ND;
		
		for ($C=0;$C<$ND; $C++){

			if($C>0){
				$NC=$NC.'|';
			}
			else{
				$NC = '';
			}
		}
		
		actualizar($NC,$N);
		echo $ND.'=>'.$NC;
		echo '<br>';
	}


