<?php
echo "1";
require_once('class/Dao.php');
echo "2";
require_once('db/ClaseConexion.php');
echo "3";

	$miDao = new Dao;
	echo "4";
	//$result = $miDao->validaCredenciales($usuario,$password); 
	$result = $miDao->validaCredenciales("nmorales","nmorales"); 
	echo "5";
	echo $result;
	echo "16";
?>