<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("db");
    QueryPHP_IncludeClasses("reclutamiento");
    $ReclutamientoClass = new Reclutamiento();
    $Username = $_POST["Username"];
    $Password = $_POST["Password"];

    $ReclutamientoClass->Username = $Username;
    $ReclutamientoClass->Password = $Password;
    $Login = $ReclutamientoClass->Login();
    if($Login[0]){
        echo json_encode($Login);
    }else{
        echo false;
    }
?>