<?php
include_once("../../includes/functions/Functions.php");
include_once("../../class/estrategia/config_campos.php");
QueryPHP_IncludeClasses("db");
$ConfigCampos = new ConfigCampos(); 
$campos = $ConfigCampos->getListar_camposNoConfig($_POST['nombreTabla'], $_POST['camposArray']);

$ToReturn = "<option value='0'>Seleccione</option>";
foreach($campos as $campo){
    if($campo != ""){
        $ToReturn .= "<option value='".$campo."'>".$campo."</option>";
    }
}
echo $ToReturn; 
?>