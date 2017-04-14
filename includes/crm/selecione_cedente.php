<?php 
include('../../db/conexion_foco.php');
include ('../../class/crm/dial.php');
$dial = new Dial();
$dial->insertarGestion($_POST['nivel1'],$_POST['record'],$_POST['monto'],$_POST['id_personal'],$_POST['observacion'],$_POST['hora'],$_POST['rut'],$_POST['fono'],$_POST['fecha_agendamiento']);

?>    