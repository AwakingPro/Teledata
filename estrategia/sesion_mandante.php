<?php
require_once('../db/db.php');
include('../class/session/session.php');
$objetoSession = new Session('1,2,3,4,5,6',false);
// ** Logout the current user. **
$objetoSession->creaLogoutAction();
if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true"))
{
  //to fully log out a visitor we need to clear the session varialbles
    $objetoSession->borrarVariablesSession();
    //$objetoSession->logoutGoTo("../index.php");
}
$objetoSession->creaMM_restrictGoTo();
$id_cedentes = "";
$sql = mysql_query("SELECT Id_Cedente FROM mandante where id='".$_POST['mandante']."'");
while($row=mysql_fetch_array($sql)){
  $id_cedentes = $row[0];
}
$array = array("mandante" => $_POST['mandante'], "mandante_cedentes" => $id_cedentes);
$objetoSession->crearVariableSession($array);
header('Location: ../cedente.php');
?>
