<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
    $run = new Method;
    $Id = isset($_POST['Id']) ? trim($_POST['Id']) : "";
	$Activo = isset($_POST['Activo']) ? trim($_POST['Activo']) : "";
	$FechaActivacion = isset($_POST['FechaActivacion']) ? trim($_POST['FechaActivacion']) : "";
    if(!$Activo || $Activo == 2){
        if($FechaActivacion){
            $FechaActivacion = DateTime::createFromFormat('d-m-Y', $FechaActivacion);
            $Hoy = new DateTime();
            if($FechaActivacion < $Hoy){
                echo 2;
                return;
            }else{
                $FechaActivacion = "'".$FechaActivacion->format('Y-m-d')."'";
            }
        }else{
            echo 3;
            return;
        }
    }else{
        $FechaActivacion = 'NULL';
    }

	$query = "UPDATE servicios SET FechaActivacion = $FechaActivacion WHERE Id = '".$Id."'";
	$update = $run->update($query);

	echo 1;


 ?>



