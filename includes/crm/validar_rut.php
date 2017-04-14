<?php 
include("../../class/crm/crm.php");
$crm = new crm();
$crm->validarRut($_POST['rut'],$_POST['cedente']);
?>    