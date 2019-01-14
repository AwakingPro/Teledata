<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
		p.rut,
		p.dv,
		p.nombre,
		mt.nombre as tipo_cliente
	FROM
		personaempresa p
	INNER JOIN 
		mantenedor_tipo_cliente mt 
	ON 
		p.tipo_cliente = mt.id
	WHERE 
		mt.id != 3
	ORDER BY
		p.nombre";
	$run = new Method;
	$clientes = $run->select($query);
	if (count($clientes) > 0) {
		$list ='<option value="">Seleccione...</option>';
		foreach($clientes as $cliente){
			$list.= '<option data-rut="'.$cliente['rut'].'-'.$cliente['dv'].'" data-nombre-cliente="'.$cliente['nombre'].'" value="'.$cliente['rut'].'">'.$cliente['rut'].'-'.$cliente['dv'].'  '.$cliente['nombre'].' - '.$cliente['tipo_cliente'].'</option>';
		}
		echo $list;
	}else{
		echo '<option value="">Seleccione...</option>';
	}
 ?>