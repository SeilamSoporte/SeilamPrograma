<?php

include_once("clasesParametros.php");

function Load_parametro($Id){
	$Det_Parametros= new Parametros();
	$Det_Parametros->getParametro($Id);
	echo $Det_Parametros->ListaParam;
}

function Load_limite($comparador,$limite){
	switch($comparador)
	{
		case '1':
			return "<".$limite;
		break;
		case '2':
			return ">".$limite;
		break;	
		case '3':
			return "<=".$limite;
		break;
		case '4':
			return ">=".$limite;
		break;
		case '5':
			return "=".$limite;
		break;
		case '6':
			return $limite."/100mL";
		break;
		case '7':
			return $limite."/250mL";
		break;
		case '8':
			return "Ausencia";
		break;
		case '9':
			return "Negativo";
		break;	
		case '10':
			return "Rango";
		case '11':
			return "No específica";
		break;	
	}
}

include_once '../templates/func_limites.php';
include_once ("clasesParametros.php");	// incluyo las clases a ser usadas
/*
function ListaCategoria($Id){
	$Det_Parametros= new Parametros();
	$Det_Parametros->getCategoria($Id);
	echo $Det_Parametros->ListaCateg;
}*/
function ListaClase($Id){
	$Det_Clase= new Parametros();
	$Det_Clase->getClase($Id);
	echo $Det_Clase->ListaClase;
}

$mensaje = "";
/*
class Conexion  // se declara una clase para hacer la conexion con la base de datos
{
	var $con;
	function Conexion()
	{
		$conection['server']="localhost";  					//host
		$conection['user']="root";         					//  usuario
		$conection['pass']="mugres74Root";             	//password
		$conection['base']="zeuss_db";           			//base de datos		
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
class sQueryP   												// se declara una clase para poder ejecutar las consultas, esta clase llama a la clase anterior
{

	var $coneccion;
	var $consulta;
	var $resultados;
	function sQuery()  										// constructor, solo crea una conexion usando la clase "Conexion"
	{
		$this->coneccion= new ConexionP();
	}
	function executeQuery($cons)  							// metodo que ejecuta una consulta y la guarda en el atributo $pconsulta
	{
		$this->consulta= mysqli_query($cons,$this->coneccion->getConexion());
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
    	while($resultados = mysqli_fecthy($this->consulta)) {
			$ParametroId = $resultados['Id'];
			$mensaje .= '
				<tr>
					
					<td>'.$resultados['Codigo'].'</td>
					<td>'.$resultados['Area'].'</td>
					<td>'.$resultados['Categoria'].'</td>
					<td>'.$resultados['Clase'].'</td>
					<td><'.ListaCategoria($resultados['Categoria']).'></td>
					

							<td style="width:40px;  padding-left:1px; padding-right:1px" >
								<a role="button" data-toggle="collapse" href="#collapsed'.$ParametroId.' " aria-expanded="false" aria-controls="#collapsed'.$ParametroId.'">
										<div class="btn btn-success glyphicon glyphicon-chevron-down" data-placement="top" title="Expandir" id="expandir" data-toggle="modal"></div>		
								</a>							
							</td>
							<td style="width:40px; padding-left:1px padding-right:1px">
								<a class="editParametro" id="editarParametro" data-id="'.$ParametroId.'" > 
									<div class="btn btn-primary glyphicon glyphicon-pencil" data-toggle="modal_xxx" data-placement="top" title="Editar parámetro" id="editParametro" data-target="#FormParametro"></div>
								</a>
							</td>
							<td style="padding-left:1px; padding-right:1px">
								<a class="delete" id="eliminarParametro" data-id="'.$ParametroId.'">
									<div data-toggle="modal"  data-target="#confirma" title="Eliminar parametro" class="btn btn-danger fa fa-times">
									</div>
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
			while($row=  mysqli_fecthy($this->consulta))
			{
				$rows[]=$row;
			}
		}
        return $rows;
    }	
	
}
*/
$consultaBusqueda = $_POST['valorBusqueda'];
$caracteres_malos = array("<", ">", "\"", "'", "/", "<", ">", "'", "/", "*", "+", "?");
//$caracteres_buenos = array("&lt;", "&gt;", "&quot;", "&#x27;", "&#x2F;", "&#060;", "&#062;", "&#039;", "&#047;");
$caracteres_buenos = array("", "", "", "", "", "", "", "", "","", "", "");
$consultaBusqueda = str_replace($caracteres_malos, $caracteres_buenos, $consultaBusqueda);

$obj_parametrosP	= new sQuery();
if ($consultaBusqueda=='Todo'){
	$Query = "SELECT * FROM parametros";
}
else{
	$Query = "SELECT * FROM parametros WHERE CONCAT(Empresa,Ciudad) LIKE '%$consultaBusqueda%'";
}

$obj_parametrosP->executeQuery($Query); 
echo $obj_parametrosP->filas(); // retorna todos los usuarios

//$filas = mysqli_num_rows($consulta);
