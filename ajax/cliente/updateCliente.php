<?php
	require_once('../../class/methods_global/methods.php');
	$query = "UPDATE personaempresa SET rut='".$_POST['Rut_update']."', dv='".$_POST['Dv_update']."', nombre='".$_POST['Nombre_update']."', giro='".$_POST['Giro_update']."', direccion='".$_POST['DireccionComercial_update']."', correo='".$_POST['Correo_update']."', contacto='".$_POST['Contacto_update']."', comentario='".$_POST['Comentario_update']."', telefono='".$_POST['Telefono_update']."', tipo_cliente='".$_POST['TipoCliente_update']."' WHERE id = ".$_POST['IdCliente'];
	$run = new Method;
	$data = $run->update($query);
	echo $data;
 ?>