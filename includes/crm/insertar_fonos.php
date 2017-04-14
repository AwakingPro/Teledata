<?php 
include("../../class/crm/crm.php");
$crm = new crm();
$crm->insertarFonos($_POST['rut'],$_POST['fono_discado_nuevo']);
?>    