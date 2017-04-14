<?php
include("../../class/db/DB.php");
$db = new Db();
$arrMenu = explode(",", $_POST['idMenu']);
$nomMenu = array_pop($arrMenu);
$Sql = "select adminCedente from menu where nombre = '".$nomMenu."'";
$result = $db -> select($Sql);
echo $result[0]['adminCedente'];    
?>
