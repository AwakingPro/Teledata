<?php
    include_once("../../includes/functions/Functions.php");
    QueryPHP_IncludeClasses("calidad");
    QueryPHP_IncludeClasses("db");
    $CalidadClass = new Calidad();
    $ArrayGeneral = array();
    $ArrayGeneral["GeneralItems"] = array();
    $ArrayGeneral["GeneralItems"][0]["General"] = array();
    ///////////////////////////////////////////////////////////////////////////////////////
    ////                            INICIO GRAFICA GENERAL                            ////
    //////////////////////////////////////////////////////////////////////////////////////
    $ArrayGeneral["General"][0][0] = $CalidadClass->getGeneralGraphDataByUserType("1");
    $ArrayGeneral["General"][0][1] = $CalidadClass->getGeneralGraphDataByUserType("3");
    $ArrayGeneral["General"][0][2] = $CalidadClass->getGeneralGraphDataByUserType("2");
    ///////////////////////////////////////////////////////////////////////////////////////
    ////                            FIN GRAFICA GENERAL                               ////
    //////////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////////
    ////                     INICIO GRAFICA GENERAL POR ITEMS                         ////
    //////////////////////////////////////////////////////////////////////////////////////
    $ArrayGeneralItems[0][0] = $CalidadClass->getGeneralByEvaluationGraphDataByUserType("1");
    $ArrayGeneralItems[0][1] = $CalidadClass->getGeneralByEvaluationGraphDataByUserType("3");
    $ArrayGeneralItems[0][2] = $CalidadClass->getGeneralByEvaluationGraphDataByUserType("2");
    $conttemp = 0;
    foreach($ArrayGeneralItems[0][0] as $Item){
        $ArrayGeneral["GeneralItems"][0]["General"][$conttemp]["evaluacion"] = $ArrayGeneralItems[0][0][$conttemp]["Evaluacion"];
        $ArrayGeneral["GeneralItems"][0]["General"][$conttemp][$ArrayGeneralItems[0][0][0]["UserTypeName"]] = $ArrayGeneralItems[0][0][$conttemp]["Nota"];
        $ArrayGeneral["GeneralItems"][0]["General"][$conttemp][$ArrayGeneralItems[0][1][0]["UserTypeName"]] = $ArrayGeneralItems[0][1][$conttemp]["Nota"];
        $ArrayGeneral["GeneralItems"][0]["General"][$conttemp][$ArrayGeneralItems[0][2][0]["UserTypeName"]] = $ArrayGeneralItems[0][2][$conttemp]["Nota"];
        $conttemp++;
    }
    
    ///////////////////////////////////////////////////////////////////////////////////////
    ////                     FIN GRAFICA GENERAL POR ITEMS                            ////
    //////////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////////
    ////                         INICIO GRAFICA POR ITEMS                             ////
    //////////////////////////////////////////////////////////////////////////////////////
    $Evaluations = $CalidadClass->getEvaluationTemplate();
    $ArrayItems[0][0] = $CalidadClass->getByEvaluationGraphDataByUserType("1");
    $ArrayItems[0][1] = $CalidadClass->getByEvaluationGraphDataByUserType("3");
    $ArrayItems[0][2] = $CalidadClass->getByEvaluationGraphDataByUserType("2");

    $ArrayEvaluation = array();
    $Cont = 0;
    foreach($Evaluations as $Evaluation){
        $Array = array();

        array_push($Array,$ArrayItems[0][0][$Evaluation["Nombre"]]);
        array_push($Array,$ArrayItems[0][1][$Evaluation["Nombre"]]);
        array_push($Array,$ArrayItems[0][2][$Evaluation["Nombre"]]);
        
        /*echo "<pre>";
        print_r($ArrayItems[0][0][$Evaluation["Nombre"]]);
        echo "</pre>";*/
        
        array_push($ArrayEvaluation,$Array);
        $Cont++;
    }

    /*echo "<pre>";
    print_r($ArrayGeneral["GeneralItems"][0]);
    echo "</pre>";*/

    //echo json_encode($ArrayGeneral["GeneralItems"]);
    array_push($ArrayGeneral["GeneralItems"][0],$ArrayEvaluation);
    ///////////////////////////////////////////////////////////////////////////////////////
    ////                         FIN GRAFICA POR ITEMS                                 ////
    //////////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////////
    ////                         INICIO NOMBRE DE ITEMS                               ////
    //////////////////////////////////////////////////////////////////////////////////////
    $Evaluations = $CalidadClass->getEvaluationTemplate();
    $ArrayEvaluationNames = array();
    $ContEvaluationNames = 0;
    $Cont = 0;
    foreach($Evaluations as $Evaluation){
        $Array = array();
        $Array[0] = $Cont;
        $Array[1] = $Evaluation["Nombre"];
        $ArrayEvaluationNames[$ContEvaluationNames] = $Array;
        $ContEvaluationNames++;
        $Cont++;
    }
    $ArrayGeneral["ItemsName"] = $ArrayEvaluationNames;
    ///////////////////////////////////////////////////////////////////////////////////////
    ////                         INICIO NOMBRE DE ITEMS                               ////
    //////////////////////////////////////////////////////////////////////////////////////
    echo json_encode($ArrayGeneral);
    /*echo "<pre>";
        print_r($ArrayGeneral["GeneralItems"][0]);
    echo "</pre>";*/







?>