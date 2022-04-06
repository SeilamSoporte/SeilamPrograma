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

	function lastId()
	{return mysql_insert_id($this->coneccion->getConexion()) ;}

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

class Parametros
{
	var $Area;     //se declaran los atributos de la clase, que son los atributos del parametro
	var $Categoria;
	var $Codigo;
	var $Clase;
	var $Parametro;
	var $Norma;
	var $Comparador; 
	var $Limite;
	var $Metodo;
	var $Referencia;
	var $Tipo;
	var $Equipo;
	var $Solucion;
	var $ListaCateg;
	var $ListaClase;
	var $ListaParam;
	
    public static function getParametros() 
		{
			$obj_parametro=new sQuery();
			$obj_parametro->executeQuery("SELECT * FROM parametros WHERE Is_Deleted=False"); // ejecuta la consulta para traer al parametro

			return $obj_parametro->fetchAll(); // retorna todos los parametros
		}
	public function Lista_Clases(){
			$obj_clases = new sQuery();
			//$query = "SELECT * FROM lista_clases";
			$obj_clases ->executeQuery("SELECT * FROM lista_clases");
			return $obj_clases ->fetchAll();
	}
	function getClase($Id){
			$obj_clases = new sQuery();
			$result 	= $obj_clases ->executeQuery("SELECT * FROM lista_clases WHERE Id = $Id");
			$row 	    = mysql_fetch_array($result);	
			$this->ListaClase= $row['Clase'];
	}
	function Lista_Categoria(){
			$obj_categ = new sQuery();
			$obj_categ ->executeQuery("SELECT * FROM categorias");
			return $obj_categ ->fetchAll();
	}
	
	function getCategoria($Id){
			$obj_categ = new sQuery();
			$result    = $obj_categ ->executeQuery("SELECT * FROM categorias WHERE Id = $Id");
			//return $obj_categ ->fetchAll();
			$row 	   = mysql_fetch_array($result);	
			$this->ListaCateg = $row['Categoria'];
	}
	function getParametro($Id){
			$obj_param= new sQuery();
			$result    = $obj_param ->executeQuery("SELECT * FROM lista_parametros WHERE Id = $Id");
			$row 	   = mysql_fetch_array($result);	
			$this->ListaParam = $row['Nombre'];
	}
	function Lista_Parametros() 
	{
		$obj_param=new sQuery();
		$obj_param->executeQuery("SELECT * FROM lista_parametros"); 
		return $obj_param->fetchAll(); 
	}
	function Lista_Equipos() 
	{
		$obj_equipo=new sQuery();
		$obj_equipo->executeQuery("SELECT * FROM equipos ORDER BY Equipo ASC "); 
		return $obj_equipo->fetchAll(); 
	}
	
	function codParametro($id)
	{ 
		$obj_parametro	= new sQuery();
		$result			= $obj_parametro->executeQuery("SELECT * FROM parametros WHERE Id = '$id'"); // ejecuta la consulta para traer al parametro 
		$row 			=mysql_fetch_array($result);
		Parametros::getCategoria($row['Categoria']);
		Parametros::getClase($row['Clase']);	
		return $row['Area'].",".$this->ListaCateg.",".$this->ListaClase.",".$row['Parametros'].",".$row['Limite'].",".$row['Metodo'].",".$row['Comparador'].",".$row['Referencia'];
	}	
	function codParametro_full($id)
	{ 
		$obj_parametro	= new sQuery();
		$result			= $obj_parametro->executeQuery("SELECT * FROM parametros WHERE Id = '$id'"); // ejecuta la consulta para traer al parametro 
		$row 			= mysql_fetch_array($result);
		$IdCat 			= $row['Categoria'];
		$IdClas			= $row['Clase'];
		$result    		= $obj_parametro ->executeQuery("SELECT * FROM categorias WHERE Id = $IdCat");
		$row1 	   		= mysql_fetch_array($result);
		$Categoria 		= $row1['Categoria'];	
		$result    		= $obj_parametro ->executeQuery("SELECT * FROM lista_clases WHERE Id = $IdClas");
		$row2 	   		= mysql_fetch_array($result);	
		$Clase 			= $row2['Clase'];

		return $row['Area'].",".$Categoria.",".$Clase.",".$row['Parametros'].",".$row['Limite'].",".$row['Metodo'].",".$row['Comparador'].",".$row['Referencia'].",".$row['Tipo'];
	}	
	function Parametro($nro=0) // declara el constructor, si trae el numero de parametro lo busca , si no, trae todos los datos
	{
		if ($nro!=0)
		{
			$obj_parametro	 = new sQuery();
			$result			 = $obj_parametro->executeQuery("SELECT * FROM parametros WHERE Id = $nro"); // ejecuta la consulta para traer al parametro 
			$row 			 =mysql_fetch_array($result);
			
			$this->Id		 = $row['Id'];
			$this->Codigo	 = $row['Codigo'];
			$this->Area		 = $row['Area'];
			$this->Categoria = $row['Categoria'];
			$this->Clase	 = $row['Clase'];
			$this->Parametro = $row['Parametros'];
			$this->Norma	 = $row['Norma'];
			$this->Comparador= $row['Comparador'];
			$this->Limite	 = $row['Limite'];
			$this->Metodo	 = $row['Metodo'];
			$this->Referencia= $row['Referencia'];
			$this->Tipo 	 = $row['Tipo'];
			$this->Equipo 	 = $row['Equipo'];
			$this->Solucion  = $row['Solucion'];
		
		}
		else
		{
			$this->Id		 = "";
			$this->Codigo	 = "";
			$this->Area		 = "";
			$this->Categoria = "";
			$this->Clase	 = "";
			$this->Parametro = "";
			$this->Norma	 = "";
			$this->Comparador= "";
			$this->Limite	 = "";
			$this->Metodo	 = "";
			$this->Referencia= "";
			$this->Tipo 	 = "";
			$this->Equipo 	 = "";
		}			
	}
	
	// metodos que devuelven valores
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
	function getUsuarioF()
	 { return $this->Foto;} 
		// metodos que setean los valores
	    
	function setId($val)
	{ $this->Id=$val;}
	function setCodigo($val)
	{ $this->Codigo=$val;}
	function setArea($val)
	{ $this->Area=$val;}
	function setCategoria($val)
	{ $this->Categoria=$val;}
	function setClase($val)
	{ $this->Clase=$val;}
	function setParams($val)
	{ $this->Params=implode('|',$val);}
	function setNorma($val)
	{ $this->Norma=implode('|',$val);}
	function setComparador($val)
	{ $this->Comparador=implode('|',$val);}
	function setLimite($val)
	{ 
		$this->Limite=implode('|',$val);
	}
	function setMetodo($val)
	{ $this->Metodo=implode('|',$val);}
	function setReferencia($val)
	{ $this->Referencia=implode('|',$val);}
	function setTipo($val)
	{ $this->Tipo=implode('|',$val);}
	function setEquipo($val)
	{ $this->Equipo=implode('|',$val);}
	function setSolucion($val)
	{ $this->Solucion=implode('|',$val);}

    function save()
    {
        if($this->Id!=0)
		{
			$data = $this->updateParametro();
			if ($data==0)
			{return "No se ha realizado ningún cambio,0";}
			else 
			{return "Los cambios se han guardado correctamente,1";}
		}
        else
		{	//echo "Insert,0";
			$data = $this->insertParametro();
			return $data;
			/*if ($data==0)
			{return "No se ha realizado ningún cambio,0";}
			else 
			{return "Los cambios se han guardado correctamente,1";}
		*/
		}
    }
	
	private function updateParametro()			// actualiza el usuario cargado en los atributos    
	{
		$obj_parametro=new sQuery();
		$query= "UPDATE parametros SET 
					Codigo		= '$this->Codigo',
					Area		= '$this->Area',
					Categoria	= '$this->Categoria',	
					Clase		= '$this->Clase',
					Parametros	= '$this->Params',
					Norma		= '$this->Norma',
					Comparador	= '$this->Comparador',
					Limite		= '$this->Limite',
					Metodo		= '$this->Metodo',
					Referencia	= '$this->Referencia',
					Tipo		= '$this->Tipo',
					Equipo 		= '$this->Equipo',
					Solucion 	= '$this->Solucion'					
					
				WHERE id = $this->Id";
		echo $query;
		$obj_parametro->executeQuery($query); 	// ejecuta la consulta para traer al usuario 
		return $obj_parametro->getAffect(); 		// retorna todos los registros afectados	
	}
	
	private function insertParametro()			// inserta el usuario cargado en los atributos
	{
		
		$obj_parametro=new sQuery();
		$query		="INSERT INTO parametros 
						(Codigo,	
  						 Area,
						 Categoria,
						 Clase,
						 Parametros,
						 Norma,
						 Comparador,
						 Limite,
						 Metodo,
						 Referencia,
						 Tipo,
						 Equipo,
						 Solucion
						 )
					VALUES 	 
						('$this->Codigo', 
						 '$this->Area',
						 '$this->Categoria',
						 '$this->Clase',
						 '$this->Params',
						 '$this->Norma',
						 '$this->Comparador',
						 '$this->Limite',
						 '$this->Metodo',
						 '$this->Referencia',
						 '$this->Tipo',
						 '$this->Equipo',
						 '$this->Solucion'
						 )";
		$obj_parametro->executeQuery($query); 	// ejecuta la consulta para traer al parametro 
		$LastId = $obj_parametro->lastId();
		$IdP = "p".$LastId;
		$query= "UPDATE parametros SET Id_p='$IdP' WHERE id=$LastId";
		$obj_parametro->executeQuery($query);
		return $obj_parametro->getAffect();
	}	

	function delete()							// elimina el usuario
	{
	/*	$obj_parametro  =new sQuery();
		$query			="DELETE FROM parametros WHERE id='$this->Id'";
		$obj_parametro->executeQuery($query); 	// ejecuta la consulta para  borrar el parametro
		return $obj_parametro->getAffect();   	// retorna todos los registros afectados	
		$obj_parametro->Clean();
*/
		$obj_parametro=new sQuery();
		$query= "UPDATE parametros SET Is_Deleted = '1'	WHERE id = $this->Id";
		
		$obj_parametro->executeQuery($query); 	// ejecuta la consulta para traer al usuario 
		return $obj_parametro->getAffect(); 		// retorna todos los registros afectados	
		$obj_parametro->Clean();
	}	
}


function cleanString($string)
{
    $string=trim($string);
    $string=mysql_escape_string($string);
	$string=htmlspecialchars($string);	
    return $string;
}