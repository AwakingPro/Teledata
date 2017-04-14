<?php
include_once("../../includes/functions/Functions.php");
include_once("../../class/estrategia/config_tablas.php");
QueryPHP_IncludeClasses("db");
$ConfigTablas = new ConfigTablas();
$Columns = json_decode($_POST['columns']);
foreach($Columns as $Column){
    $idColumn = $Column[0];
    $BoolColumn = $Column[1];
    if($BoolColumn){
        // Agregar Cedente
        $Cedentes = $ConfigTablas->GetCedentesColumna($idColumn);
        $Cedentes = $Cedentes[0]["Id_Cedente"];
        $Cedentes = explode(",",$Cedentes);
        if(!in_array($_SESSION['cedente'],$Cedentes)){
            array_push($Cedentes,$_SESSION['cedente']);
        }
        if($Cedentes[0] == ""){
            unset($Cedentes[0]);
        }
        $Cedentes = implode(",",$Cedentes);
        $ConfigTablas->updateCedenteColumnas($Cedentes,$idColumn);
    }else{
        // Eliminar Cedente
        $Cedentes = $ConfigTablas->GetCedentesColumna($idColumn);
        $Cedentes = $Cedentes[0]["Id_Cedente"];
        $Cedentes = explode(",",$Cedentes);
        if(in_array($_SESSION['cedente'],$Cedentes)){
            $index = array_search($_SESSION['cedente'],$Cedentes);
            unset($Cedentes[$index]);
            $Cedentes = implode(",",$Cedentes);
            $ConfigTablas->updateCedenteColumnas($Cedentes,$idColumn);
        }
    }
}
echo "1";
//$ConfigTablas->registrartablaCampos($_POST['idTabla'],$_POST['campos'],$_POST['idCedente']);
?>