<?php
include("../../class/session/session.php");
$objetoSession = new Session('1',false); // 1,4
//Para Id de Menu Actual (Menu Padre, Menu hijo)
$idCedente = $_POST['idCedenteMandante'];
$idMandanteAdmin = $_POST['idMandanteAdmin'];
echo $objetoSession->crearVariableSession($array = array("cedente" => $idCedente,"mandante" => $idMandanteAdmin));
?>