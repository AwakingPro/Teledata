<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("db");
    QueryPHP_IncludeClasses("global");
    $CedenteClass = new Cedente();
    $Cedentes = $CedenteClass->getCedentesMandante($_SESSION['mandante']);
    $ToReturn = "";
    foreach($Cedentes as $Cedente){
        $ToReturn .= "<option value='".$Cedente["idCedente"]."'>".$Cedente["NombreCedente"]."</option>";
    }
    echo $ToReturn;
?>