<?php
	require_once('../../class/methods_global/methods.php');
	$query = "DELETE FROM facturas_pagos WHERE Id = ".$_POST['id'];
	$run = new Method;
	$data = $run->delete($query);
	echo $data;
 ?>