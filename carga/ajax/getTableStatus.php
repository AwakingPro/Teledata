<?php
	require_once('../../db/db.php');
	if(!isset($_SESSION)){
        session_start();
    }

    $Tables = array();
    $Tables["Persona"] = false;
    $Tables["Deuda"] = false;
    $Tables["FonoCob"] = false;
    $Tables["Direcciones"] = false;
    $Tables["Mail"] = false;
    
    $resultado = mysql_query("select count(*) as NumRows from Persona_tmp where Id_Cedente = '".$_SESSION['cedente']."'");
	if($resultado){
        while($row = mysql_fetch_assoc($resultado)){
            $NumRows = $row['NumRows'];
        }
    }else{
        $NumRows = 0;
    }
    if($NumRows > 0){
        $Tables["Persona"] = true;
    }

    $resultado = mysql_query("select count(*) as NumRows from Deuda_tmp where Id_Cedente = '".$_SESSION['cedente']."'");
	if($resultado){
        while($row = mysql_fetch_assoc($resultado)){
            $NumRows = $row['NumRows'];
        }
    }else{
        $NumRows = 0;
    }
    if($NumRows > 0){
        $Tables["Deuda"] = true;
    }

    $resultado = mysql_query("select count(*) as NumRows from fono_cob_tmp where Id_Cedente = '".$_SESSION['cedente']."'");
	if($resultado){
        while($row = mysql_fetch_assoc($resultado)){
            $NumRows = $row['NumRows'];
        }
    }else{
        $NumRows = 0;
    }
    if($NumRows > 0){
        $Tables["FonoCob"] = true;
    }

    $resultado = mysql_query("select count(*) as NumRows from Direcciones_tmp where Id_Cedente = '".$_SESSION['cedente']."'");
	if($resultado){
        while($row = mysql_fetch_assoc($resultado)){
            $NumRows = $row['NumRows'];
        }
    }else{
        $NumRows = 0;
    }
    if($NumRows > 0){
        $Tables["Direcciones"] = true;
    }

    $resultado = mysql_query("select count(*) as NumRows from Mail_tmp where Id_Cedente = '".$_SESSION['cedente']."'");
	if($resultado){
        while($row = mysql_fetch_assoc($resultado)){
            $NumRows = $row['NumRows'];
        }
    }else{
        $NumRows = 0;
    }
    if($NumRows > 0){
        $Tables["Mail"] = true;
    }

    echo json_encode($Tables);
 ?>