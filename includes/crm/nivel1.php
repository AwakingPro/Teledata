<?php 
include('../../db/conexion_foco.php');
include ('../../class/crm/dial.php');
$dial = new Dial();
$dial->nivelB($_POST['id_nivel1']);
?>
