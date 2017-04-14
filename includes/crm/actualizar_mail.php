<?php 
include("../../class/crm/crm.php");
$crm = new crm();
$crm->actualizarCorreo($_POST['id_mail'],$_POST['mail'],$_POST['nombre'],$_POST['cargo'],$_POST['obs']);
?>    