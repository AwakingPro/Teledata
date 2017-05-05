<?php
	// $host_name = '192.168.1.8';
	// $pass_word = 's9q7l5.,777';

	/* ----- conexion local alvaro ----- */
	$host_name = 'localhost';
	$pass_word = '';
	/* -------------------------------------------------*/

	$user_name = 'root';
	$database_name = 'teledata';
	$conn = mysql_connect($host_name, $user_name, $pass_word) or die ('Error connecting to mysql');
	mysql_select_db($database_name);
?>

