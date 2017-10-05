<?php
	require_once('../../class/methods_global/methods.php');
	$query = "DELETE FROM mantenedor_tipo_facturacion WHERE id = ".$_POST['id'];
	$run = new Method;
	$data = $run->delete($query);
	echo $data;
 ?>