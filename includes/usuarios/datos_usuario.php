<?php
include("../class/usuarios/usuarios.php");
include("../class/global/cedente.php");
include("../class/db/DB.php");
$objetoCedente = new Cedente();
$objetoUsuario = new Usuarios();
if (isset($_POST['id_usuario']))
{
  $creaModificaUsua = "modificarUsuario";
  $dato = $_POST['id_usuario'];
  $id_usu = $_POST['id_usuario'];
  $tituloVentana = "Modificar Usuario";
  $password_usu = "*.8//";
}
else
{
  $creaModificaUsua = "crearUsuario";
  $id_usu = "";
  $dato = "";
  $tituloVentana = "Nuevo Usuario";
  $password_usu = "";
}

$datos = $objetoUsuario->datosUsuario($dato);
$nombre_usu = $datos['nombre'];
$cargo_usu = $datos['cargo'];
$email_usu = $datos['email'];
$usuario_usu = $datos['usuario'];
$usuarioDial_usu = $datos['user_dial'];
$nombreNivel = $datos['nombreNivel'];
$nivelusu = $datos['nivel'];
$passworDial_usu = $datos['pass_dial'];
$idCedenteUsu = $datos['id_cedente'];
$idMandanteUsu = $datos['id_mandante'];
$cargoTelefono = $datos['cargoTelefono'];
$email = $datos['email'];
$nombre = $datos['nombre'];
$tipoUsuario = $datos['tipoUsuario']; 
$nomCedenteUsu = $objetoCedente->getCedenteName($idCedenteUsu);
$nomMandanteUsu = $objetoCedente->getMandanteName($idMandanteUsu);
?>
