<?php
	require_once('../../class/methods_global/methods.php');
	$query = "DELETE FROM servicio_internet WHERE IdServInternet = ".$_POST['id'];
	$run = new Method;
	$data = $run->delete($query);
	echo $data;
 ?>