<?php
if (!isset($_SESSION))
{
    session_start();
}
include_once("../../includes/functions/Functions.php");
QueryPHP_IncludeClasses("usuarios");
QueryPHP_IncludeClasses("db");
//include("../../class/usuarios/usuarios.php");
$listarUsuarios = new Usuarios();
$listarUsuarios->listarUsuarios($_SESSION['MM_UserGroup']);
?>
