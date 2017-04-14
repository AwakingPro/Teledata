<?php 
include("../../class/crm/crm.php");
$crm = new crm();
$crm->cantRegistros($_POST['rut'],$_POST['prefijo']);
?>    