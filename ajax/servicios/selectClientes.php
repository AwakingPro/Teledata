<?php
	require_once('../../class/methods_global/methods.php');
	$query = 'SELECT
		rut,
		nombre,
		tipo_cliente
	FROM
		personaempresa';
	$run = new Method;
	$clientes = $run->select($query);
	if (count($clientes) > 0) {
		$list ='<option value="">Seleccione...</option>';
		foreach($clientes as $cliente){
			$list.= '<option value="'.$cliente['rut'].'">'.$cliente['rut'].' - '.$cliente['nombre'].' - '.$cliente['tipo_cliente'].'</option>';
		}
		echo $list;
	}else{
		echo '<option value="">Seleccione...</option>';
	}
 ?>