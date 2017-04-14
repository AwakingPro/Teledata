<?php
    include("../../class/session/session.php");
    include("../../class/global/cedente.php");
    
    include("../../class/db/DB.php");
    include("../../db/db.php");
    $objetoSession = new Session('1,2,3,4,5,6',false);
    $CedenteClass = new Cedente();
    $Array = array();
    $Array["isAdmin"] = false;
    switch($_SESSION['MM_UserGroup'])
    {
        case '1':
            $Array["isAdmin"] = true;
        break;
        case '5':
        break;
        default:
            include("../../class/calidad/calidad.php");
            $CalidadClass = new Calidad();
            $Array["id_cedente"] = $_SESSION['cedente'];
            $Array["nombre_cedente"] = $CedenteClass->getCedenteName($Array["id_cedente"]);
            $Array["id_mandante"] = $_SESSION['mandante'];
            $Array["nombre_mandante"] = $CedenteClass->getMandanteName($Array["id_mandante"]);
            $Array["isMandante"] = $CalidadClass->isUserMandante();
            $Array['Empiezo'] = $CalidadClass->Empiezo(); 
            if (isset($_SESSION['mandante'])){
                //echo "fdsfsd";
                $Array["id_mandante"] = $_SESSION['mandante'];
                $Array["id_cedente"] = $_SESSION['cedente'];
            }
        break;
    }
    
    $Array['isEjecutivo'] = isset($_SESSION['isEjecutivo']) ? true : false;
    $Array['id_personal'] = $_SESSION['personal'];
    $Array['personalName'] = $_SESSION['personalName'];
    $Array['username'] = $_SESSION['MM_Username'];
    $Array['idMenu'] = $_SESSION['idMenu'];

    $Array = ValidarVariablesDeAdministrador($Array);

    echo json_encode($Array);


    function ValidarVariablesDeAdministrador($Array){
        
        if ($Array["isAdmin"]){
            $arrMenu = explode(",", $_SESSION['idMenu']);
            $nomMenu = array_pop($arrMenu);
            if (($nomMenu !== 'config_tb') && ($nomMenu !== 'per_gestc')){
                unset($_SESSION['mandante']);
                unset($_SESSION['cedente']);
            }
            if (isset($_SESSION['mandante'])){
               //echo "fdsfsd";
                $Array["id_mandante"] = $_SESSION['mandante'];
                $Array["id_cedente"] = $_SESSION['cedente'];
            }
        }
        return $Array;
    }
?>