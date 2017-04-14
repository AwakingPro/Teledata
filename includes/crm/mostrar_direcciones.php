<?php 
include("../../class/crm/crm.php");
$crm = new crm();
$crm->mostrarDirecciones($_POST['rut']);
?>    