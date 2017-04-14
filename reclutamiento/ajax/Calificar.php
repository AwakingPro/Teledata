<?php
    include_once("../../includes/functions/Functions.php");
    require("../../includes/email/PHPMailer-master/class.phpmailer.php"); 
	require("../../includes/email/PHPMailer-master/class.smtp.php"); 
    QueryPHP_IncludeClasses("db");
    QueryPHP_IncludeClasses("email");
    QueryPHP_IncludeClasses("reclutamiento");
    $ReclutamientoClass = new Reclutamiento();
    $Preguntas = $_POST["Preguntas"];
    $Prueba = $ReclutamientoClass->getPruebaActiva();
    switch($Prueba['id_tipotest']){
        case '1':
            $ReclutamientoClass->insertCalificacion($Preguntas);
        break;
        case '2':
            $ReclutamientoClass->insertCalificacionCompetencias($Preguntas);
        break;
    }
?>