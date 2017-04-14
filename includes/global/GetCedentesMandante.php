<?php
include("../../class/global/cedente.php");
include("../../class/db/DB.php");
include("../../db/db.php");
$objeto = new Cedente();
$cedentes = $objeto->getCedentesMandante($_POST['mandante']);
$ToReturn = "<option value='0'>Seleccione</option>";
foreach($cedentes as $cedente){
    if($cedente["NombreCedente"] != ""){
        $ToReturn .= "<option value='".$cedente["idCedente"]."'>".$cedente["NombreCedente"]."</option>";
    }
}
echo $ToReturn;
//echo json_encode($cedentes);
?>
