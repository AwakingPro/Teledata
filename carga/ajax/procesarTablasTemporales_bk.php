<?php
    ini_set('memory_limit', '2000M');
    ini_set('max_execution_time', 300);
    include_once("../../db/db.php");
    if(!isset($_SESSION)){
        session_start();
    }

    $MontoDeudaTotal = getMontoDeuda();
    $CantidadRuts = getCantidadRuts();


    $Tablas = array();
    $Tablas["Persona"] = "Persona";
    $Tablas["Deuda"] = "Deuda";
    $Tablas["Fono_Cob"] = "fono_cob";
    $Tablas["Direcciones"] = "Direcciones";
    $Tablas["Mail"] = "Mail";

    $QueryPersona = "select * from ".$Tablas["Persona"]." order by Rut";
    $QueryDeuda = "select * from ".$Tablas["Deuda"]." where Id_Cedente = '".$_SESSION['cedente']."'";
    $QueryFonoCob = "select * from ".$Tablas['Fono_Cob']." order by Rut";
    $QueryDirecciones = "select * from ".$Tablas['Direcciones']." order by Rut";
    $QueryMail = "select * from ".$Tablas["Mail"]." order by Rut";

    $QueryPersonaTmp = "select * from Persona_tmp where Id_Cedente='".$_SESSION['cedente']."'";
    $QueryDeudaTmp = "select * from Deuda_tmp where Id_Cedente = '".$_SESSION['cedente']."'";
    $QueryFonoCobTmp = "select * from fono_cob_tmp where Id_Cedente = '".$_SESSION['cedente']."'";
    $QueryDireccionesTmp = "select * from Direcciones_tmp where Id_Cedente = '".$_SESSION['cedente']."'";
    $QueryMailTmp = "select * from Mail_tmp where Id_Cedente = '".$_SESSION['cedente']."'";

    $ColumnasPersona = getTableColumns("Persona");
    $ColumnasDeuda = getTableColumns("Deuda");
    $ColumnasFonoCob = getTableColumns("fono_cob");
    $ColumnasDirecciones = getTableColumns("Direcciones");
    $ColumnasMail = getTableColumns("Mail");


    $ResultPersona = mysql_query($QueryPersona);
    $ArrayPersona = array();

    $ResultPersonaTmp = mysql_query($QueryPersonaTmp);
    $ArrayPersonaTmp = array();
    

    $RutsToUpdate = array();
    $RutsToAdd = array();
    $QueryToAdd = "";


    while($RowResultPersona = mysql_fetch_assoc($ResultPersona)){
        $Rut = $RowResultPersona["Rut"];
        $Id_Cedente = $RowResultPersona["Id_Cedente"];

        $Array = array();
        $Array["Rut"] = $Rut;
        $Array["Id_Cedente"] = $Id_Cedente;
        array_push($ArrayPersona,$Array);
    }
    while($RowResultPersonaTmp = mysql_fetch_assoc($ResultPersonaTmp)){
        $RutTmp = $RowResultPersonaTmp["Rut"];
        $Id_CedenteTmp = $RowResultPersonaTmp["Id_Cedente"];
        
        $Array = array();
        $Array["Rut"] = $RutTmp;
        $Array["Id_Cedente"] = $Id_CedenteTmp;
        array_push($ArrayPersonaTmp,$Array);
    }
    foreach($ArrayPersonaTmp as $PersonaTmp){
        $ContRut = 0;
        foreach($ArrayPersona as $Persona){
            if($Persona["Rut"] == $PersonaTmp["Rut"]){
                $ContRut++;
                $ArrayCedentes = explode(",",$Persona["Id_Cedente"]);
                if(!in_array($PersonaTmp["Id_Cedente"], $ArrayCedentes)){
                    //echo "El rut: ".$PersonaTmp["Rut"]. " si existe con los cedentes: ".$Persona["Id_Cedente"]." y debe ser actualizado ya que no contiene el cedente: ".$PersonaTmp["Id_Cedente"]." <br>";
                    $Array = array();
                    $Array["Rut"] = $PersonaTmp["Rut"];
                    //$Array["Query"] = "update ".$Tablas["Persona"]." set Id_Cedente = CONCAT(Id_Cedente,',".$PersonaTmp["Id_Cedente"]."') where Rut = '".$Array["Rut"]."'";
                    array_push($RutsToUpdate,$Array);
                }
            }
        }
        if($ContRut == 0){
            //echo "El rut: ".$PersonaTmp["Rut"]. " no existe<br>";
            array_push($RutsToAdd,$PersonaTmp["Rut"]);
        }else{
            
        }
    }
    $QueryToAdd = "";
    if(count($RutsToAdd) > 0){
        $QueryToAdd = "insert into ".$Tablas["Persona"]." (".$ColumnasPersona.") select * from Persona_tmp where Rut in (".implode(",",$RutsToAdd).");";    
    }

    $RutsUpdate = "";
    if(count($RutsToUpdate) > 0){
        foreach($RutsToUpdate as $Row){
            $RutsUpdate .= $Row['Rut'].",";
        }
        $RutsUpdate = substr($RutsUpdate,0,strlen($RutsUpdate) - 1);
        $RutsUpdate = "update ".$Tablas["Persona"]." set Id_Cedente = CONCAT(Id_Cedente,',".$PersonaTmp["Id_Cedente"]."') where Rut in (".$RutsUpdate.");";
    }

    $DeleteQuery = "delete from Persona_tmp where Id_Cedente='".$_SESSION['cedente']."';";

    mysql_query($RutsUpdate);
    mysql_query($QueryToAdd);
    mysql_query($DeleteQuery);

    /////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////

    $DeudaTmp = mysql_query($QueryDeudaTmp);
    $NumDeudaTmp = mysql_num_rows($DeudaTmp);
    if($NumDeudaTmp > 0){
        //QUERIES PARA TABLA DEUDA
        $QueryHistorico = "insert into Deuda_Historico select * from Deuda where Id_Cedente = '".$_SESSION['cedente']."';";
        $QueryDeleteDeudas = "delete from ".$Tablas["Deuda"]." where Id_Cedente='".$_SESSION['cedente']."';";
        $QueryInsertDeudas = "insert into ".$Tablas["Deuda"]." (".$ColumnasDeuda.") select * from Deuda_tmp where Id_Cedente = '".$_SESSION['cedente']."';";
        $QueryDeleteDeudaTmp = "delete from Deuda_tmp where Id_Cedente='".$_SESSION['cedente']."';";

        mysql_query($QueryHistorico);
        mysql_query($QueryDeleteDeudas);
        mysql_query($QueryInsertDeudas);
        mysql_query($QueryDeleteDeudaTmp);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////

    //QUERIES PARA TABLA fono_cob

    $ResultFonoCobTmp = mysql_query($QueryFonoCobTmp);

    while($RowResultFonoCobTmp = mysql_fetch_assoc($ResultFonoCobTmp)){
        $IdFono = $RowResultFonoCobTmp["id_fono"];
        try{
            $QueryInsertFono = "insert into ".$Tablas["Fono_Cob"]." (".$ColumnasFonoCob.") select ".$ColumnasFonoCob." from fono_cob_tmp where Id_Cedente = '".$_SESSION['cedente']."' and id_fono = '".$IdFono."';";
            $Variable = mysql_query($QueryInsertFono);
        }catch(Exception $ex){
        }
    }
    $QueryDeleteTmp = "delete from fono_cob_tmp where Id_Cedente = '".$_SESSION['cedente']."' ";
    mysql_query($QueryDeleteTmp);

    /////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////

    //QUERIES PARA TABLA DIRECCIONES

    $ResultDireccionesTmp = mysql_query($QueryDireccionesTmp);

    while($RowResultDireccionesTmp = mysql_fetch_assoc($ResultDireccionesTmp)){
        $IdDireccion = $RowResultDireccionesTmp["Id_Direccion"];
        try{
            $QueryInsertDireccion = "insert into ".$Tablas["Direcciones"]." (".$ColumnasDirecciones.") select ".$ColumnasDirecciones." from Direcciones_tmp where Id_Cedente = '".$_SESSION['cedente']."' and Id_Direccion = '".$IdDireccion."';";
            $Variable = mysql_query($QueryInsertDireccion);
        }catch(Exception $ex){
        }
    }
    $QueryDeleteDeudaTmp = "delete from Direcciones_tmp where Id_Cedente='".$_SESSION['cedente']."';";
    mysql_query($QueryDeleteDeudaTmp);


    /////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////

    //QUERIES PARA TABLA MAILS

    $ResultMailTmp = mysql_query($QueryMailTmp);

    while($RowResultMailTmp = mysql_fetch_assoc($ResultMailTmp)){
        $IdMail = $RowResultMailTmp["id_mail"];
        try{
            $QueryInsertMail = "insert into ".$Tablas["Mail"]." (".$ColumnasMail.") select ".$ColumnasMail." from Mail_tmp where Id_Cedente = '".$_SESSION['cedente']."' and id_mail = '".$IdMail."';";
            $Variable = mysql_query($QueryInsertMail);
        }catch(Exception $ex){
        }
    }
    $QueryDeleteMailTmp = "delete from Mail_tmp where Id_Cedente='".$_SESSION['cedente']."';";
    mysql_query($QueryDeleteMailTmp);


    //////////////////////////////////////////////////////////////////////////

    $Tables = array();
    $Tables["Persona"] = false;
    $Tables["Deuda"] = false;
    $Tables["FonoCob"] = false;
    $Tables["Direcciones"] = false;
    $Tables["Mail"] = false;
    
    $resultado = mysql_query("select count(*) as NumRows from Persona_tmp where Id_Cedente = '".$_SESSION['cedente']."'");
	while($row = mysql_fetch_assoc($resultado)){
        $NumRows = $row['NumRows'];
    }
    if($NumRows > 0){
        $Tables["Persona"] = true;
    }

    $resultado = mysql_query("select count(*) as NumRows from Deuda_tmp where Id_Cedente = '".$_SESSION['cedente']."'");
	while($row = mysql_fetch_assoc($resultado)){
        $NumRows = $row['NumRows'];
    }
    if($NumRows > 0){
        $Tables["Deuda"] = true;
    }

    $resultado = mysql_query("select count(*) as NumRows from fono_cob_tmp where Id_Cedente = '".$_SESSION['cedente']."'");
	while($row = mysql_fetch_assoc($resultado)){
        $NumRows = $row['NumRows'];
    }
    if($NumRows > 0){
        $Tables["FonoCob"] = true;
    }

    $resultado = mysql_query("select count(*) as NumRows from Direcciones_tmp where Id_Cedente = '".$_SESSION['cedente']."'");
	while($row = mysql_fetch_assoc($resultado)){
        $NumRows = $row['NumRows'];
    }
    if($NumRows > 0){
        $Tables["Direcciones"] = true;
    }

    $resultado = mysql_query("select count(*) as NumRows from Mail_tmp where Id_Cedente = '".$_SESSION['cedente']."'");
	while($row = mysql_fetch_assoc($resultado)){
        $NumRows = $row['NumRows'];
    }
    if($NumRows > 0){
        $Tables["Mail"] = true;
    }
    if(($Tables["Persona"] == false) && ($Tables["Deuda"] == false) && ($Tables["FonoCob"] == false) && ($Tables["Direcciones"] == false) && ($Tables["Mail"] == false)){
        //$MontoDeudaTotal
        //$CantidadRuts
        $sql = "insert into Historico_Carga (Id_Cedente,fecha,Cant_Ruts,Deuda_Total) values ('".$_SESSION['cedente']."',NOW(),'".$CantidadRuts."','$MontoDeudaTotal')";
        $result = mysql_query($sql);
        $ToReturn = array();
        if($result){
            $ToReturn["Result"] = "1";
        }else{
            $ToReturn["Result"] = "0";
        }
        $ToReturn["Resume"] = array();
            $ToReturn["Resume"]["Registros"] = $CantidadRuts;
            $ToReturn["Resume"]["TotalDeuda"] = $MontoDeudaTotal;
        echo json_encode($ToReturn);
    }

    function getMontoDeuda(){
        $ToReturn = 0;
        $sql = "select sum(Monto_Mora) as Monto from Deuda_tmp where Id_Cedente = '".$_SESSION['cedente']."'";
        $result = mysql_query($sql);
        if($result){
            while($row = mysql_fetch_assoc($result)){
                $ToReturn = $row['Monto'];
            }
        }
        return $ToReturn;
    }
    function getCantidadRuts(){
        $ToReturn = 0;
        $sql = "select count(*) as NumRuts from Persona_tmp where Id_Cedente = '".$_SESSION['cedente']."'";
        $result = mysql_query($sql);
        if($result){
            while($row = mysql_fetch_assoc($result)){
                $ToReturn = $row['NumRuts'];
            }
        }
        return $ToReturn;
    }
    function getTableColumns($Table){
        $ToReturn = array();
        $Sql = "show columns from ".$Table;
        $SqlReturned = mysql_query($Sql);
        if($SqlReturned){
            while($row = mysql_fetch_assoc($SqlReturned)){
                $Field = $row["Field"];
                $Extra = $row["Extra"];
                if($Extra != "auto_increment"){
                    array_push($ToReturn,$Field);
                }
            }
        }
        $ToReturn = implode(",",$ToReturn);
        return $ToReturn;
    }
?>