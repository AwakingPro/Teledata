<?php
    include_once("../includes/functions/Functions.php");
    if(!isset($_SESSION)){
        session_start();
    }
    Main_IncludeClasses("calidad");
    Main_IncludeClasses("db");
    $CalidadClass = new Calidad();
    $CalidadClass->InsertRecordsToDataBase();
?>