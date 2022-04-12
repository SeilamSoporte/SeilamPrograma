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
    function executeQuery($cons)                    // metodo que ejecuta una consulta y la guarda en el atributo $pconsulta
    {
        $this->consulta= mysql_query($cons,$this->coneccion->getConexion());
        return $this->consulta;
    }   
    function getResults()                           // retorna la consulta en forma de result.
    {return $this->consulta;}
     
    function Close()                                // cierra la conexion
    {$this->coneccion->Close();}  
     
    function Clean()                                // libera la consulta
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
 
class Usuarios
{
    var $Nombre;     //se declaran los atributos de la clase, que son los atributos del usuario
    var $Apellido;
    var $Email;
    var $Telefono;
    var $Celular;
    var $Password;
    var $Permisos;
    var $Direccion;
    var $Cargo;
    var $Identificacion;
    var $Username;
    var $Foto;
     
    public static function getUsuarios() 
        {
            $obj_usuarios=new sQuery();
            $obj_usuarios->executeQuery("SELECT * FROM usuarios ORDER BY usuarios.id ASC"); // ejecuta la consulta para traer al usuario
 
            return $obj_usuarios->fetchAll(); // retorna todos los usuarios
        }
 
    function Usuario($nro=0) // declara el constructor, si trae el numero de usuario lo busca , si no, trae todos los usuarios
    {
        if ($nro!=0)
        {
            $obj_usuario    = new sQuery();
            $result         = $obj_usuario->executeQuery("SELECT * FROM usuarios WHERE id = $nro"); // ejecuta la consulta para traer al usuario 
            $row=mysql_fetch_array($result);
             
            $this->Id        = $row['id'];
            $this->Nombre    = $row['Nombre'];
            $this->Apellido  = $row['Apellido'];
            $this->Email = $row['email'];
            $this->Telefono  = $row['Telefono'];
            $this->Celular   = $row['Celular'];
            $this->Password  = $row['password'];
            $this->Permisos  = $row['Permisos'];
            $this->Direccion= $row['Direccion'];
            $this->Cargo = $row['Cargo'];
            $this->Identificacion=$row['Identificacion'];
            $this->Username  = $row['username'];
            $this->Password  = $row['password'];//$obj_usuario->desencriptar($row['password']);
            $this->Foto      = $row['foto'];
        }
        else
        {
            $this->Id        = "";
            $this->Nombre    = "";
            $this->Apellido  = "";
            $this->Email = "";
            $this->Telefono  = "";
            $this->Celular   = "";
            $this->Password  = "";
            $this->Permisos  = "false,false,false,false,false,false,false,false,false,false,false,false";
            $this->Direccion= "";
            $this->Cargo = "";
            $this->Identificacion="";
            $this->Username  = "";
            $this->Password  = "";
            $this->Foto      = "";                       
        }           
    }
    function getFoto($nro)
    {
        $obj_usuario    = new sQuery();
        $result         = $obj_usuario->executeQuery("select foto from usuarios where id = $nro"); // ejecuta la consulta para traer al usuario 
        $row=mysql_fetch_array($result);
        echo $row[0]; 
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
    function getPassword()
     { return $this->Password;} 
    function getUsuarioF()
     { return $this->Foto;} 
        // metodos que setean los valores
     
    function setId($val)
    { $this->Id=$val;}
    function setNombre($val)
    { $this->Nombre=$val;}
    function setApellido($val)
    { $this->Apellido=$val;}
    function setTelefono($val)
    { $this->Telefono=$val;}
    function setCelular($val)
    { $this->Celular=$val;}
    function setDireccion($val)
    { $this->Direccion=$val;}
    function setEmail($val)
    { $this->Email=$val;}
    function setCargo($val)
    { $this->Cargo=$val;}
    function setPermiso($val)
    { $this->Permisos=implode(',',$val);}
    function setIdentificacion($val)
    { $this->Identificacion=$val;} 
    function setUsuario($val)
    { $this->Username=$val;}
    function setFoto($valf)
    { $this->Foto=$valf;}
    function setPassword($val)
    {
        $obj_usuario    = new sQuery();
            $this->Password = $val;
 
        //$this->Password =$obj_usuario->encriptar($val);     
    }
 
    function save()
    {
        if($this->Id!=0)
        {
            $data = $this->updateUsuario();
            if ($data==0)
            {return "No se ha realizado ningún cambio,0";}
            else
            {return "Los cambios se han guardado correctamente,1";}
        }
        else
        {   //echo "Insert,0";
            $data = $this->insertUsuario();
            //return $data.",0";
            if ($data==0)
            {return "No se ha realizado ningún cambio,0";}
            else
            {return "Los cambios se han guardado correctamente,1";}
         
        }
    }
     
    private function updateUsuario()            // actualiza el usuario cargado en los atributos    
    {
        $obj_usuario=new sQuery();
        $query= "UPDATE usuarios SET 
                    Nombre  = '$this->Nombre',
                    Apellido= '$this->Apellido',
                    Telefono= '$this->Telefono',
                    Celular = '$this->Celular', 
                    email   = '$this->Email',
                    Cargo   = '$this->Cargo', 
                    username= '$this->Username',
                    Permisos= '$this->Permisos', 
                    Password= '$this->Password',
                    foto    = '$this->Foto',
                    Direccion= '$this->Direccion',
                    Identificacion='$this->Identificacion'                                  
                WHERE id = $this->Id";
         
        $obj_usuario->executeQuery($query);  // ejecuta la consulta para traer al usuario 
        return $obj_usuario->getAffect();        // retorna todos los registros afectados    
    }
     
    private function insertUsuario()            // inserta el usuario cargado en los atributos
    {
        $obj_usuario=new sQuery();
        $query      ="INSERT INTO usuarios 
                        (Nombre,    
                         Apellido,
                         Telefono,
                         Celular,
                         email,
                         Cargo,
                         username,
                         Permisos,
                         Password,
                         foto,
                         Direccion,
                         Identificacion,
                         active
                         )
                    VALUES   
                        ('$this->Nombre', 
                         '$this->Apellido',
                         '$this->Telefono',
                         '$this->Celular',
                         '$this->Email',
                         '$this->Cargo',
                         '$this->Username',
                         '$this->Permisos',
                         '$this->Password',
                         '$this->Foto',
                         '$this->Direccion',
                         '$this->Identificacion',
                         '1'   
                         )";
                        //( nombre, apellido)values('$this->Nombre', '$this->Apellido')";
        $obj_usuario->executeQuery($query);  // ejecuta la consulta para traer al usuario 
        return $obj_usuario->getAffect();        // retorna todos los registros afectados
    }   
    function delete()                           // elimina el usuario
    {
        $obj_usuario=new sQuery();
        $query      ="DELETE FROM usuarios WHERE id='$this->Id'";
        $obj_usuario->executeQuery($query);  // ejecuta la consulta para  borrar el usuario
        return $obj_usuario->getAffect();    // retorna todos los registros afectados    
        $obj_usuario->Clean();
    }   
}
class cargos
{
    var $cargo;
    function getCargos() 
        {
            $obj_cargos=new sQuery();
            $obj_cargos->executeQuery("select * from cargos"); // ejecuta la consulta para traer al cliente
            return $obj_cargos->fetchAll(); // retorna todos los clientes
        }
}
 
function cleanString($string)
{
    $string=trim($string);
    $string=mysql_escape_string($string);
    $string=htmlspecialchars($string);  
    return $string;
}