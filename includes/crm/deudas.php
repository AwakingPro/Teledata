<?php 
include("../../class/crm/crm.php");
include_once("../../includes/functions/Functions.php");
QueryPHP_IncludeClasses("db");
$crm = new crm();
$crm->mostrarDeudas($_POST['rut'],$_POST['cedente']);
?>    