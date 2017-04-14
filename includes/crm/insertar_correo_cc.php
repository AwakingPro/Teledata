<?php 
include("../../class/crm/crm.php");
$crm = new crm();
$crm->insertarCorreocc($_POST['rut'],$_POST['correo_nuevo'],$_POST['cargo'],$_POST['uso'],$_POST['nombre']);
?>    