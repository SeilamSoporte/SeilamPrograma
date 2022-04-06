<?php
if (isset($_FILES["file"]))
{
	
    $file = $_FILES["file"];
	
	if ($file["size"]!=0)
	{   	
		$nombre = $file["name"];
		$tipo = $file["type"];
		$ruta_provisional = $file["tmp_name"];
		$size = $file["size"];
		$dimensiones = getimagesize($ruta_provisional);
		$width = $dimensiones[0];
		$height = $dimensiones[1];
		$carpeta = "../imgs/";
	
        $src = $carpeta.$nombre;
        move_uploaded_file($ruta_provisional, $src);
        //echo "Ok";
		//echo "<img src='$src'>";
	}
}
?>