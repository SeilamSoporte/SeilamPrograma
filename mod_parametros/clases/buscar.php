<?php
//include_once("../common/class.php");
include_once '../templates/func_limites.php';
include_once ("clasesParametros.php");	// incluyo las clases a ser usadas

function ListaCategoria($Id){
	$Det_Parametros= new Parametros();
	$Det_Parametros->getCategoria($Id);
	echo $Det_Parametros->ListaCateg;
}
function ListaClase($Id){
	$Det_Clase= new Parametros();
	$Det_Clase->getClase($Id);
	echo $Det_Clase->ListaClase;
}

$mensaje = "";

class ConexionP  // se declara una clase para hacer la conexion con la base de datos
{
	var $con;
	function ConexionP()
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
class sQueryP   												// se declara una clase para poder ejecutar las consultas, esta clase llama a la clase anterior
{
	var $coneccion;
	var $consulta;
	var $resultados;
	var $Categoria;
	var $ListaParams;
	function sQueryP()  										// constructor, solo crea una conexion usando la clase "Conexion"
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

	function Categorias($id){
		$obj_parametro= new sQueryP();
		$result    	  = $obj_parametro ->executeQuery("SELECT * FROM categorias WHERE Id = $id");
		$row 	   	  = mysqli_fecth_array($result);
		return $row['Categoria'];	
	}
	function Clases($id){
		$obj_parametro  = new sQueryP();
		$result    		= $obj_parametro ->executeQuery("SELECT * FROM lista_clases WHERE Id = $id");
		$row 	   		= mysqli_fecth_array($result);	
		return $row['Clase'];

	}
	function getParametros($id){
			$obj_param= new sQueryP();
			$result    = $obj_param ->executeQuery("SELECT * FROM lista_parametros WHERE Id = '$id'");
			$row 	   = mysqli_fecth_array($result);	
			//$this->ListaParams = $row['Nombre'];
			return $row['Nombre'];
	}

	function getConsulta($tabla, $campo, $id){
			$obj_consulta = new sQueryP();
			$result       = $obj_consulta->executeQuery("SELECT * FROM $tabla WHERE Id = '$id'");
			$row 	      = mysqli_fecth_array($result);	
			return $row[$campo];
	}

    function filas(){
    	$mensaje ='';
    	$resultados="";
    	while($resultados = mysqli_fecth_array($this->consulta)) {
			$ParametroId  = $resultados['Id'];
			$IdCat		  = ($resultados['Categoria']);
			$Categoria 	  = $this->Categorias($resultados['Categoria']);
			$Clase 	 	  = $this->Clases($resultados['Clase']);
			$DatosParametros='';
			$Normas 	    = '';
			$Limites 		= '';
			$Metodos 		= '';
			$Np=0;
			$Nl=0;
			$parametros 	= split("\|", $resultados['Parametros']);
			$normas		 	= split("\|", $resultados['Norma']);
			$comparadores	= split("\|", $resultados['Comparador']);
			$limites	 	= split("\|", $resultados['Limite']);
			$metodos		= split("\|", $resultados['Metodo']);
			$referencias	= split("\|", $resultados['Referencia']);	

			foreach ($parametros as $param){
				$DatosParametros .= '<div class="row fila">'.$this->getConsulta('lista_parametros', 'Nombre', $param).'</div>'; 
				$Normas 		 .= '<div class="row fila">'.$normas[$Np].'</div>'; 
				$Metodos 		 .= '<div class="row fila">'.$metodos[$Np].'</div>'; 
				if ($comparadores[$Np]==10) {
				 	$Limites 	 .= '<div class="row fila">'.LoadLimite($comparadores[$Np], $limites[$Nl+1],$limites[$Nl+2]).'</div>'; }
				else{
					$Limites 	 .= '<div class="row fila">'.LoadLimite($comparadores[$Np], $limites[$Nl],'').'</div>';
				}

				$Np++;
				$Nl=$Np*3;
		
			}#Foreach
			$Npp=0;

			$mensaje .= '
			<tr>
				<td>'.$resultados['Codigo'].'</td>
				<td>'.$resultados['Area'].'</td>
				<td>'.$Categoria.'</td>
				<td>'.$Clase.'</td>

				<td style="width:40px;  padding-left:1px; padding-right:1px" >
					<a role="button" data-toggle="collapse" href="#collapsed'.$ParametroId.' " aria-expanded="false" aria-controls="#collapsed'.$ParametroId.'">
						<div class="btn btn-success glyphicon glyphicon-chevron-down" data-placement="top" title="Expandir" id="expandir" data-toggle="modal">
						</div>		
					</a>							
				</td>					
				<td style="width:40px; padding-left:1px padding-right:1px">
					<a class="editParametro" id="editarParametro" data-id="'.$ParametroId.'" onClick="EditarParam('.$ParametroId.');"> 
						<div class="btn btn-primary glyphicon glyphicon-pencil" data-toggle="modal" data-placement="top" title="Editar parámetro" id="editParametro" data-target="#FormParametro"></div>
					</a>
				</td>
				<tr>
					<td colspan="8" style="padding:0px; background-color: #f5f5f5;">
						<div class="collapse" id="collapsed'.$ParametroId.'">
							<div class="collap">
								<div class="col col-xs-6 col-sm-3 col-md-4" >
									<div><strong>Parámetros</strong></div>
									'.$DatosParametros.'
								</div>

								<div class="col col-xs-6 col-sm-3 col-md-2" >
									<div><strong>Norma</strong></div>
									'.$Normas.'
								</div>
								<div class="clearfix visible-xs-block"> </div>

								<div class="col col-xs-6 col-sm-3 col-md-2">
									<div><strong>Límite</strong></div>
									'.$Limites.'
								</div>

								<div class="col col-xs-6 col-sm-3 col-md-2">
									<div><strong>Método</strong></div>
									'.$Metodos.'
								</div>
							</div>
						</div>
					</td>
				</tr>
			</tr>';
		};//Fin while $resultados
		return $mensaje;
    }
    function fetchAll()
    {
        $rows=array();
		if ($this->consulta)
		{
			while($row=  mysqli_fecth_array($this->consulta))
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

$obj_parametrosP	= new sQueryP();
if ($consultaBusqueda=='Todo'){
	$Query = "SELECT * FROM parametros";
}
else{
	$Query = "SELECT * FROM parametros WHERE CONCAT(Codigo, Area) LIKE '%$consultaBusqueda%'";
}

$obj_parametrosP->executeQuery($Query); 
echo $obj_parametrosP->filas(); // retorna todos los usuarios
//$filas = mysqli_num_rows($consulta);
