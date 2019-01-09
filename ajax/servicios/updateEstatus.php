<?php
	require_once('../../class/methods_global/methods.php');
	
    $run = new Method;
    $Id = isset($_POST['Id']) ? trim($_POST['Id']) : "";
    $Activo = isset($_POST['Activo']) ? trim($_POST['Activo']) : "";
    $FechaInicioDesactivacion = isset($_POST['FechaInicioDesactivacion']) ? trim($_POST['FechaInicioDesactivacion']) : "";
    $FechaFinalDesactivacion = isset($_POST['FechaFinalDesactivacion']) ? trim($_POST['FechaFinalDesactivacion']) : "";
    //Cortado 0, suspendido 2, activo 1
    if(!$Activo || $Activo == 2){
        if($FechaInicioDesactivacion && $FechaFinalDesactivacion){
            $FechaInicioDesactivacion = DateTime::createFromFormat('Y/m/d', $FechaInicioDesactivacion);
            $FechaFinalDesactivacion = DateTime::createFromFormat('Y/m/d', $FechaFinalDesactivacion);
            $Hoy = new DateTime();
            if($FechaFinalDesactivacion < $Hoy){
                echo 2;
                return;
            }else{
                $FechaInicioDesactivacion = "'".$FechaInicioDesactivacion->format('Y-m-d')."'";
                $FechaFinalDesactivacion = "'".$FechaFinalDesactivacion->format('Y-m-d')."'";
            }
        }else{
            echo 3;
            return;
        }
    }else{
        $FechaInicioDesactivacion = 'NULL';
        $FechaFinalDesactivacion = 'NULL';
    }

	$query = "UPDATE servicios SET FechaInicioDesactivacion = $FechaInicioDesactivacion, 
              FechaFinalDesactivacion = $FechaFinalDesactivacion, EstatusServicio = $Activo
              WHERE Id = '".$Id."'";
	$update = $run->update($query);

	echo 1;


 ?>



