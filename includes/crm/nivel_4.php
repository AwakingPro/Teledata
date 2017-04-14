<?php 
include("../../class/crm/crm.php");
$crm = new crm();
$crm->nivel4($_POST['id_tipo'],$_POST['cortar_valor']);
?>    