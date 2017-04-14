<?php 
include("../../class/crm/crm.php");
$crm = new crm();
$crm->prevRut($_POST['rut'],$_POST['prefijo']);
?>    