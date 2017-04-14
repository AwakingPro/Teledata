 
<?php
require_once "test3.php";
 
$db = new BaseDatos();
 
if($db->conectar())
{
    $db->pruebadb(1);
    $db->desconectar();
}
?>