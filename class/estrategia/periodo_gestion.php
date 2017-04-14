<?php
/*
** Clase para mantener los periodos de las gestiones
*/

class PeriodoGestion{
    /*
    ** Inserta en BD el periodo para cedente o para foco
    */
    public function creaPeriodo($fechaInicio, $fechaTermino, $idCedente){
        $db = new Db();
        if ($idCedente != ""){
            $SqlInsertPeriodo = "insert into Periodo_Gestion_Cedente (cedente, Fecha_Inicio, Fecha_Termino) values('".$idCedente."', '".$fechaInicio."', '".$fechaTermino."')";
        }else{
            $SqlInsertPeriodo = "insert into Periodo_Gestion_Foco (Fecha_Inicio, Fecha_Termino) values('".$fechaInicio."', '".$FechaTermino."')";
        }        
        $InsertPeriodo = $db -> query($SqlInsertPeriodo);        
    }   

    /*
    ** Elimina periodo de BD 
    ** $tipo puede tener dos valores: Foco o Cedente, pues este indica en que tabla eliminarel periodo
    */ 

    public function eliminaPeriodo($tipo, $idPeriodo){
        $db = new Db();
        if ($tipo == "Foco"){
            $tabla = "Periodo_Gestion_Foco"; 
            $id = "id_periodo_foco";      
        }else{
            $tabla = "Periodo_Gestion_Cedente";
            $id = "id_periodo_cedente";
        } 
        $ToReturn = false;
        $SqlEliminarPeriodo = "delete from ".$tabla." where ".$id." = ".$idPeriodo;
        $DeletePeriodo = $db -> query($SqlEliminarPeriodo);
        if($DeletePeriodo !== false){
            $ToReturn = true;
        }else{
            $ToReturn = false;
        }
        return $ToReturn;
    }  

    public function listaPeriodo($idCedente){
        $db = new Db();
        $periodosArray = array();
        /*
        if($idCedente == ""){
            $SqlPeriodo = "select * from Periodo_Gestion_Foco";
            $idPeriodo = "id_periodo_foco";
        }else{
            $SqlPeriodo = "select * from Periodo_Gestion_Cedente where Cedente = ".$idCedente;
            $idPeriodo = "id_periodo_cedente";
        }  */  
        $SqlPeriodo = "select * from Periodo_Gestion_Cedente where Cedente = ".$idCedente;
        $idPeriodo = "id_periodo_cedente";   
        
        $Periodos = $db->select($SqlPeriodo);
         if($Periodos !== false){
          foreach($Periodos as $Periodo){
            $Array = array();
            $Array['fechaInicio'] = $Periodo['Fecha_Inicio'];
            $Array['fechaTermino'] = $Periodo['Fecha_Termino'];
            $Array['Actions'] = $Periodo[$idPeriodo];            
            array_push($periodosArray,$Array);
          }
        }

        return $periodosArray;
    }  
}
?>