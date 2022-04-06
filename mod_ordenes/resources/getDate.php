<?php 
	$idArray = getdate();
	$id      = $idArray['minutes'].$idArray['hours'].$idArray['wday'].$idArray['mon'].$idArray['yday'];
	echo $id;
	exit;
?>