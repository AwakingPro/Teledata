 
<?php
require_once "test3.php";
 
$db = new BaseDatos();
 
if($db->conectar())
{
    $db->pruebadb(2);
    $db->desconectar();
}
?>