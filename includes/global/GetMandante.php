<?php
include("../../class/global/cedente.php");
include("../../class/db/DB.php");
include("../../db/db.php");
$objeto = new Cedente();
$mandantes = $objeto->getMandantes();
$ToReturn = "<option value='0'>Seleccione</option>";
foreach($mandantes as $mandante){
    $ToReturn .= "<option value='".$mandante["id"]."'>".$mandante["nombre"]."</option>";   
}
echo $ToReturn;
//echo json_encode($cedentes);
?>
