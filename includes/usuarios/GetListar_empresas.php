<?php
    include_once("../../includes/functions/Functions.php");
    include_once("../../class/empresaExterna/empresaExterna.php");
    QueryPHP_IncludeClasses("db");
    $empresa = new Empresa(); 
    $empresas = $empresa->getEmpresas();
    $ToReturn = "<option value=''>Seleccione</option>";
    foreach($empresas as $empresa){
        if($empresa["nombre"] != ""){
            $ToReturn .= "<option value='".$empresa["Actions"]."'>".$empresa["nombre"]."</option>";
        }
    }
    echo $ToReturn;
?>