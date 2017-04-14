<?php 
include("../../class/crm/crm.php");
$crm = new crm();
$crm->marcarFactura($_POST['rut'],$_POST['cedente'],$_POST['id_deuda'],$_POST['id']);
?>    