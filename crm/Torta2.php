<?php
    include_once("Charts.php");
    $ChartClass = new Charts();
  	echo $ChartClass->mostrarTorta2($_POST['tabla'],$_POST['cedente'],$_POST['lista'],$_POST['id']);
?>