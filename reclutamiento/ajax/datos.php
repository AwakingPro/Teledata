<?php
	include("../../class/db/DB.php");
	$operation = new Db();
	$result = $operation -> query('INSERT INTO datos_generales_reclutamiento (IdUsuarioReclutamiento, Rut, Apellidos, Nombres, Telefono, FechaNacimiento, Correo) VALUES ("'.$_SESSION['idUsuario_reclutamiento'].'", "'.$_POST['rut'].'", "'.$_POST['apellidos'].'", "'.$_POST['nombres'].'", "'.$_POST['telefono'].'", "'.$_POST['fechaNacimeinto'].'", "'.$_POST['correo'].'");');
	$result = $operation -> query('INSERT INTO domicilio_reclutamiento (IdUsuarioReclutamiento, Direccion, Region, Ciudad, Comuna, Telefono) VALUES ("'.$_SESSION['idUsuario_reclutamiento'].'", "'.$_POST['direccion'].'", "'.$_POST['region'].'", "'.$_POST['ciudad'].'", "'.$_POST['comuna'].'", "'.$_POST['telefonoFijo'].'");');
	$result = $operation -> query('INSERT INTO datos_personales_reclutamiento (IdUsuarioReclutamiento, Afp, SistemaSalud, UF, Ges) VALUES ("'.$_SESSION['idUsuario_reclutamiento'].'", "'.$_POST['afp'].'", "'.$_POST['sistemaSalud'].'", "'.$_POST['uf'].'", "'.$_POST['ges'].'");');
	$result = $operation -> query('INSERT INTO contactos_reclutamiento (IdUsuarioReclutamiento, Nombre, Parentesco, Celular1, Celular2) VALUES ("'.$_SESSION['idUsuario_reclutamiento'].'", "'.$_POST['contactoNombre'].'", "'.$_POST['contactoParentesco'].'", "'.$_POST['contactoCelular1'].'", "'.$_POST['contactoCelular2'].'")');
	$result = $operation -> query('INSERT INTO contactos_reclutamiento (IdUsuarioReclutamiento, Nombre, Parentesco, Celular1, Celular2) VALUES ("'.$_SESSION['idUsuario_reclutamiento'].'", "'.$_POST['contacto2Nombre'].'", "'.$_POST['contacto2Parentesco'].'", "'.$_POST['contacto2Celular1'].'", "'.$_POST['contacto2Celular2'].'")');
 	echo $result;
 ?>