<?php
include("../../class/usuarios/usuarios.php");
$objetoUsuario = new Usuarios();
$objetoUsuario->eliminarUsuarios($_POST['id_usuario']);
 ?>
