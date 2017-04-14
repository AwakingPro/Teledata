<?php
include("../../class/usuarios/usuarios.php");
include("../../class/usuarios/hash.php");
include("../../db/db.php");
$objetoHash = new Hash();
$passwordUsu = $objetoHash->convertirHash($_POST['passwordUsu']);
$objetoUsuario = new Usuarios();
$objetoUsuario->crearUsuarios($_POST['usuario'],$_POST['nombreUsu'],$passwordUsu,$_POST['nivelUsu'],$_POST['cargoUsu'],$_POST['idMandante'],$_POST['usuarioDialUsu'],$_POST['passwordDialUsu'],$_POST['emailUsu'],$_POST['idCedente'],$_POST['idTrabajador'],$_POST['idEmpresa']);
?>
