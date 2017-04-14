<?php

    include_once("../../db/db.php");
    if(!isset($_SESSION)){
        session_start();
    }
    $Id_Cedente = $_SESSION['cedente'];

    $ArrayColumnsPersona = array();
    $QueryColPersona = mysql_query("SHOW COLUMNS FROM Persona_tmp");
    while($row = mysql_fetch_array($QueryColPersona)){
        if($row[0]=='id_persona'){

        }else{
        array_push($ArrayColumnsPersona,$row[0]);
        }
    }
    $ArrayImplodePersona = implode(',',$ArrayColumnsPersona);
    $QueryPersona = "INSERT INTO Persona($ArrayImplodePersona) SELECT * FROM Persona_tmp ON DUPLICATE KEY UPDATE Persona_LP.Id_Cedente = CONCAT(Persona_LP.Id_Cedente , ',' ,'$Id_Cedente')";
    mysql_query("DELETE FROM  Persona_tmp WHERE Id_Cedente = $Id_Cedente");
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
    $QueryDeuda = "INSERT INTO Deuda_LP($ArrayImplodeDeuda) SELECT * FROM Deuda_tmp";
    mysql_query($QueryDeuda);
    mysql_query("DELETE FROM Deuda_tmp WHERE Id_Cedente =  $Id_Cedente");

    
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
    echo $QueryFono= "INSERT INTO fono_cob($ArrayImplodeFono) SELECT $ArrayImplodeFono FROM fono_cob_tmp ON DUPLICATE KEY UPDATE fono_cob.cedente = CONCAT(fono_cob.cedente , ',' ,'$Id_Cedente')";
    mysql_query($QueryFono);
    mysql_query("DELETE FROM fono_cob_tmp WHERE Id_Cedente =  $Id_Cedente");
    






?>