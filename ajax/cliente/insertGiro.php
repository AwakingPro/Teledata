<?php
	require_once('../../class/methods_global/methods.php');
	session_start();
    $run = new Method;
    $array = array();
    $array['status'] = 0;

	$nombreGiro = isset($_POST['nombreGiro']) ? trim($_POST['nombreGiro']) : "";
    if($nombreGiro){
        $query = "INSERT INTO giros (nombre) VALUES ('".$nombreGiro."')";
        $id = $run->insert($query);

        if($id){
            $array['status'] = 1;
            $array['nombre'] = $nombreGiro;
        }
    }else{
        $array['status'] = 2;
    }

    echo json_encode($array);
 ?>