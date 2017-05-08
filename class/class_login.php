<?php
session_start();
require_once("db/db.php");
class Sesion
{
//esta función será la encargada de comprobar si existe el usuario en la base de datos
	public function nueva_sesion()
	{
		$user= mysql_real_escape_string($_POST['user']);
		$pass = mysql_real_escape_string($_POST['pass']);

	    $query = "SELECT * FROM Usuarios WHERE usuario='$user' AND password='$pass'";
		$resultado = mysql_query($query);
		if($reg=mysql_fetch_array($resultado))
		{
			$_SESSION['user'] = $reg['username'];
			header("Location:estrategia/estrategias.php");
		}
		else
		{
			header("Location:index.php?error=1");
		}

	}
}
?>