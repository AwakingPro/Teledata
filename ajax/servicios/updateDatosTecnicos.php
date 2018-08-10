<?php
    require_once('../../class/methods_global/methods.php');
    $Tipo = $_POST['Tipo'];
    $Id = $_POST['idServicio'];
    $Velocidad = $_POST['velocidad'];
    $Plan = $_POST['plan'];
    if($Tipo == 1){
        $query = "UPDATE arriendo_equipos_datos SET Velocidad = '".$Velocidad."', Plan = '".$Plan."' WHERE IdArriendoEquiposDatos = '".$Id."'";
    }else{
        $query = "UPDATE servicio_internet SET Velocidad = '".$Velocidad."', Plan = '".$Plan."' WHERE IdServInternet = '".$Id."'";
    }
    $run = new Method;
	$update = $run->update($query);

	echo 1;
 ?>