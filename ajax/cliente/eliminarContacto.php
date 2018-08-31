<?php
	require_once('../../class/methods_global/methods.php');
	$query = "DELETE FROM contactos WHERE Id = ".$_POST['id'];
	$run = new Method;
	$data = $run->delete($query);
	echo $data;
 ?>