<?php 
include("../../class/crm/crm.php");
$crm = new crm();
$crm->mostrarFonos($_POST['rut'],$_POST['prefijo']);
?>    