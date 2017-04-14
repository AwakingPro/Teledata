<?php
class Gestion{
    public function prueba($IdCedente){
        $db = new Db();
        $EstrategiaArray = array();
        $Sql = "SELECT nombre FROM SIS_Estrategias WHERE Id_Cedente = 45";
		    $Estrategias = $db -> select($Sql);
            foreach($Estrategias as $Estrategia){
                array_push($EstrategiaArray,$Estrategia["nombre"]);
            }
            header('Content-type: application/json; charset=utf-8');
            return $EstrategiaArray;
            exit();

   } 
}
?>