<?php
    include_once("Charts.php");
    $ChartClass = new Charts();
    if($_POST['tipo']==1)
    {	
  		echo $ChartClass->mostrarTorta($_POST['tabla'],$_POST['cedente'],$_POST['lista']);
  	}
  	elseif($_POST['tipo']==2)
  	{
  		echo $ChartClass->mostrarTorta2($_POST['tabla'],$_POST['cedente'],$_POST['lista'],$_POST['id_gestion']);
  	}
  	elseif($_POST['tipo']==3)
  	{
  		echo $ChartClass->mostrarTorta3($_POST['tabla'],$_POST['cedente'],$_POST['lista'],$_POST['id_gestion']);
  	}	
?>