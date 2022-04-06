
<?php 

	include("../mpdf/mpdf.php");
	$mpdf=new mPDF();
	$html = 'ordendeservicioMB.php';
	//$mpdf->load_html_file($html);
	//$mpdf->render();

	$html=utf8_encode($html);
	/*if($_REQUEST['html']){
		echo $html; 
		exit;
	}*/
	$mpdf->WriteHTML($html);
	$mpdf->Output('orden.pdf','I');
	exit;

 ?>