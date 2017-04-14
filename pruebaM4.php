<?php
include('pruebaM.php');
$objeto2 = new Session();
echo $_SESSION['SS_Username']."<br />";
echo $_SESSION['SS_UserGroup']."<br />";
echo "Las muestro estan creadas <br />";
echo session_status();
$objeto2->borrarVariablesSession();
//echo $_SESSION['SS_Username']."<br />";
//echo $_SESSION['SS_UserGroup']."<br />";
echo session_status();
$objeto2->destruirSession();
echo session_status();
if (!isset($_SESSION))
{
	  echo "no tengo session";
}

/*
_DISABLED = 0
_NONE = 1
_ACTIVE = 2 */

?>
