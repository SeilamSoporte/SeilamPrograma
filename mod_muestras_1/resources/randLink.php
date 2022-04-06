<?php 
	function RamdonChar($leng){
		return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0,$leng);	
	} 

	$token 	= rand(765000,9999999);
	$token2	= rand(255,765000);
	$idArray= getdate();
	$idSend	= $idArray['hours'].$idArray['wday'].$idArray['mon'];
	//$idSend	= $idArray['mon'];
	//$id= ($muestra['Id']*$token)+$token2;
	$id 	= isset($_POST['id']) ? $_POST['id'] : 0;
	$id 	= $id;//($id*$token)+$token2;
	$link  	= "editMuestra.php?i-t=".$id.RamdonChar(5)."&t-ram=".$token.RamdonChar(5)."&t-s=".$token2.RamdonChar(10)."&s=".$idSend;
	echo $link;
?>