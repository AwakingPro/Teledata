<?php
	require_once('../../class/methods_global/methods.php');
	include("../../class/usuarios/UsuariosClass.php");

	$usuario = new Usuarios();
	$usuario->compruebaSesion();
 
 ?>