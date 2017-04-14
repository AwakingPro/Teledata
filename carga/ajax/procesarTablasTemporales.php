<?php

    include_once("../../db/db.php");
    if(!isset($_SESSION)){
        session_start();
    }
    $Id_Cedente = $_SESSION['cedente'];
    $Fecha = date('Y-m-d');
    $IdCFecha = $Id_Cedente."_".$Fecha;

    
    $ArrayColumnsPersona = array();
    $QueryColPersona = mysql_query("SHOW COLUMNS FROM Persona_tmp");
    while($row = mysql_fetch_array($QueryColPersona)){
        if($row[0]=='id_persona'){

        }else{
        array_push($ArrayColumnsPersona,$row[0]);
        }
    }
    $ArrayImplodePersona = implode(',',$ArrayColumnsPersona);
    $QueryPersona = "INSERT INTO Persona($ArrayImplodePersona) SELECT * FROM Persona_tmp ON DUPLICATE KEY UPDATE Persona.Id_Cedente = CONCAT(Persona.Id_Cedente , ',' ,'$Id_Cedente')";
    mysql_query($QueryPersona);


    $ArrayColumnsDeuda = array();
    $QueryColDeuda = mysql_query("SHOW COLUMNS FROM Deuda_tmp");
    while($row = mysql_fetch_array($QueryColDeuda)){
        if($row[0]=='Id_deuda'){

        }else{
        array_push($ArrayColumnsDeuda,$row[0]);
        }
    }
    $ArrayImplodeDeuda = implode(',',$ArrayColumnsDeuda);
    $QueryDeuda = "INSERT INTO Deuda($ArrayImplodeDeuda) SELECT * FROM Deuda_tmp";
    mysql_query($QueryDeuda);
    mysql_query("INSERT INTO Deuda_Historico ($ArrayImplodeDeuda) SELECT $ArrayImplodeDeuda FROM Deuda WHERE Id_Cedente =  $Id_Cedente");


    
    $ArrayColumnsFono = array();
    $QueryColFono = mysql_query("SHOW COLUMNS FROM fono_cob_tmp");
    while($row = mysql_fetch_array($QueryColFono)){
         if($row[0]=='id_fono'){

        }elseif($row[0]=='Id_Cedente'){

        }else{
        array_push($ArrayColumnsFono,$row[0]);
        }
    }
    $ArrayImplodeFono = implode(',',$ArrayColumnsFono);
    $QueryFono= "INSERT INTO fono_cob($ArrayImplodeFono) SELECT $ArrayImplodeFono FROM fono_cob_tmp ON DUPLICATE KEY UPDATE fono_cob.cedente = CONCAT(fono_cob.cedente , ',' ,'$IdCFecha')";
    mysql_query($QueryFono);




    $ArrayColumnsMail = array();
    $QueryColMail = mysql_query("SHOW COLUMNS FROM Mail");
    while($row = mysql_fetch_array($QueryColMail)){
         if($row[0]=='id_mail'){

        }elseif($row[0]=='Id_Cedente'){

        }else{
        array_push($ArrayColumnsMail,$row[0]);
        }
    }
    $ArrayImplodeMail = implode(',',$ArrayColumnsMail);
    $QueryMail= "INSERT INTO Mail($ArrayImplodeMail) SELECT $ArrayImplodeMail FROM Mail_tmp ON DUPLICATE KEY UPDATE Mail.Origen = CONCAT(Mail.Origen , ',' ,'$IdCFecha')";
    mysql_query($QueryMail);


    $ArrayColumnsDir = array();
    $QueryColDir = mysql_query("SHOW COLUMNS FROM Direcciones");
    while($row = mysql_fetch_array($QueryColDir)){
         if($row[0]=='Id_Direccion'){

        }else{
        array_push($ArrayColumnsDir,$row[0]);
        }
    }
    $ArrayImplodeDir = implode(',',$ArrayColumnsDir);
    $QueryDir= "INSERT INTO Direcciones($ArrayImplodeDir) SELECT $ArrayImplodeDir FROM Direcciones_tmp ON DUPLICATE KEY UPDATE Direcciones.Origen = CONCAT(Direcciones.Origen , ',' ,'$IdCFecha')";
    mysql_query($QueryDir);
    


    $MontoDeuda = 0;
    $SqlMontoDeuda = mysql_query("SELECT SUM(Monto_Mora) FROM Deuda_tmp WHERE Id_Cedente =  $Id_Cedente");
    while($row = mysql_fetch_array($SqlMontoDeuda)){
        $MontoDeuda = $row[0];
    }

    $Registros = 0;
    $SqlRegistros = mysql_query("SELECT COUNT(Rut) FROM Persona_tmp WHERE Id_Cedente = $Id_Cedente");
    $Registros = mysql_num_rows($SqlRegistros);
    

    $sql = "INSERT INTO Historico_Carga (Id_Cedente,fecha,Cant_Ruts,Deuda_Total) values ('".$_SESSION['cedente']."',NOW(),'".$Registros."','$MontoDeuda')";
    $result = mysql_query($sql);
    $ToReturn = array();
    if($result){
        $ToReturn["Result"] = "1";
    }else{
        $ToReturn["Result"] = "0";
    }
    $ToReturn["Resume"] = array();
        $ToReturn["Resume"]["Registros"] = $Registros;
        $ToReturn["Resume"]["TotalDeuda"] = $MontoDeuda;
    echo json_encode($ToReturn);

    mysql_query("DELETE FROM Persona_tmp WHERE Id_Cedente = $Id_Cedente");
    mysql_query("DELETE FROM Deuda_tmp WHERE Id_Cedente =  $Id_Cedente");
    mysql_query("DELETE FROM Mail_tmp WHERE Id_Cedente =  $Id_Cedente");
    mysql_query("DELETE FROM fono_cob_tmp WHERE Id_Cedente =  $Id_Cedente");
    mysql_query("DELETE FROM Direcciones_tmp WHERE Id_Cedente =  $Id_Cedente");


?>