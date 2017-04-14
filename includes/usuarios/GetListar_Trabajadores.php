<?php
    include_once("../../includes/functions/Functions.php");
    include_once("../../class/trabajador/trabajador.php");
    QueryPHP_IncludeClasses("db");
    $Trabajador = new Trabajador(); 
    $trabajadores = $Trabajador->getTrabajadores();
    $ToReturn = "<option value=''>Seleccione</option>";
    foreach($trabajadores as $trabajador){
        if($trabajador["Actions"] != ""){
            $ToReturn .= "<option value='".$trabajador["Actions"]."'>".$trabajador["nombre"]."</option>";
        }
    }
    echo $ToReturn;
?>