<?php 
include("../../class/crm/crm.php");
$crm = new crm();
$crm->insertar1($_POST['nivel1'],$_POST['nivel2'],$_POST['nivel3'],$_POST['comentario'],$_POST['fecha_gestion'],$_POST['hora_gestion'],$_POST['rut'],$_POST['fono_discado'],$_POST['tipo_gestion'],$_POST['cedente'],$_POST['usuario_foco'],$_POST['lista']);
?>    