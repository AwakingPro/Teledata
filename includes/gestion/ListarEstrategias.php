<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("gestion");
    QueryPHP_IncludeClasses("db");
    $GestionClass= new Gestion();
    echo json_encode($GestionClass->prueba($_POST['IdCedente']));
?>