<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("personal");
    QueryPHP_IncludeClasses("db");
    $PersonalClass = new Personal();
    $PersonalClass->Cartera = $_POST['Cartera'];
    $Personals = $PersonalClass->getPersonalListEvaluadas();
    $ToReturn = "";
    foreach($Personals as $Personal){
        if($Personal["Nombre_Usuario"] != ""){
            $SelectedAndDisabled = "";
            if(isset($_SESSION['isEjecutivo'])){
                if($_SESSION['personal'] == $Personal['Id_Personal']){
                    $SelectedAndDisabled = "selected disabled='disabled'";
                }
            }
            $ToReturn .= "<option ".$SelectedAndDisabled." value='".$Personal["Nombre_Usuario"]."'>".$Personal["Nombre"]."</option>";
        }
    }
    echo $ToReturn;
?>