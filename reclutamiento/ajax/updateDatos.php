<?php
	include("../../class/db/DB.php");
	$operation = new Db();
	$result = $operation -> query('UPDATE datos_generales_reclutamiento SET Rut="'.$_POST['rut'].'", Apellidos="'.$_POST['apellidos'].'", Nombres="'.$_POST['nombres'].'", Telefono="'.$_POST['telefono'].'", FechaNacimiento= "'.$_POST['fechaNacimeinto'].'", Correo= "'.$_POST['correo'].'" WHERE IdUsuarioReclutamiento ='.$_POST['id']);
	$result = $operation -> query('UPDATE domicilio_reclutamiento SET Direccion="'.$_POST['direccion'].'", Region= "'.$_POST['region'].'", Ciudad= "'.$_POST['ciudad'].'", Comuna= "'.$_POST['comuna'].'", Telefono= "'.$_POST['telefonoFijo'].'" WHERE IdUsuarioReclutamiento='.$_POST['id']);
	$result = $operation -> query('UPDATE datos_personales_reclutamiento SET Afp="'.$_POST['afp'].'", SistemaSalud="'.$_POST['sistemaSalud'].'", UF="'.$_POST['uf'].'", Ges="'.$_POST['ges'].'", Pensionado="'.$_POST['pensionado'].'" WHERE IdUsuarioReclutamiento ='.$_POST['id']);
	$result = $operation -> query('DELETE FROM contactos_reclutamiento WHERE IdUsuarioReclutamiento = '.$_POST['id']);
	$result = $operation -> query('INSERT INTO contactos_reclutamiento (IdUsuarioReclutamiento, Nombre, Parentesco, Celular1, Celular2) VALUES ("'.$_SESSION['idUsuario_reclutamiento'].'", "'.$_POST['contactoNombre'].'", "'.$_POST['contactoParentesco'].'", "'.$_POST['contactoCelular1'].'", "'.$_POST['contactoCelular2'].'")');
	$result = $operation -> query('INSERT INTO contactos_reclutamiento (IdUsuarioReclutamiento, Nombre, Parentesco, Celular1, Celular2) VALUES ("'.$_SESSION['idUsuario_reclutamiento'].'", "'.$_POST['contacto2Nombre'].'", "'.$_POST['contacto2Parentesco'].'", "'.$_POST['contacto2Celular1'].'", "'.$_POST['contacto2Celular2'].'")');
 	echo $result;
 ?>