<?php
class Cedente
{
	public $Id_Cedente;
	function __construct(){

	}
  public function formCedente($cedente, $mandante)
	{
      echo '<div class="row">';
			echo '<div class="col-md-12">';
			echo '<form class="form-horizontal">';
			echo '<div class="form-group">';
			echo '<label class="col-md-4 control-label" for="name">Cedente</label>';
			echo '<div class="col-md-4 ">';
			echo "<select class='select1 col-md-4 lateral' id='cedenteSeleccionado' name='cedenteSeleccionado'>";
	        $q=mysql_query("SELECT Cedente.Nombre_Cedente,Cedente.Id_Cedente FROM Cedente inner join mandante_cedente on mandante_cedente.Id_Cedente = Cedente.Id_Cedente inner join mandante on mandante.id = mandante_cedente.Id_Mandante WHERE NOT Cedente.Id_Cedente = $cedente and mandante.id = '".$mandante."' ORDER BY Cedente.Nombre_Cedente ASC");
	       	echo "<option value='0'>Seleccione</option>";
	        while($row=mysql_fetch_array($q))
	        {
	        	echo "<option value='$row[1]'>"; echo utf8_encode($row[0]); echo "</option>";
	        }
	        echo "</select>";
  		echo '</div>';
			echo '</div>';
			echo '</form>';
			echo '</div>';
			echo '</div>';
	}
	function getCedenteName($cedente){
		$ToReturn = "";
		$db = new Db();
		$cedentes = $db -> select("SELECT Cedente.Nombre_Cedente as Nombre FROM Cedente WHERE Cedente.Id_Cedente = '".$cedente."'");
		foreach($cedentes as $cedente){
			$ToReturn = $cedente["Nombre"];
		}
		return $ToReturn;
	}
	function getMandanteName($mandante){
		$ToReturn = "";
		$db = new Db();
		$mandantes = $db -> select("SELECT mandante.nombre as Nombre FROM mandante WHERE mandante.id = '".$mandante."'");
		foreach($mandantes as $mandante){
			$ToReturn = $mandante["Nombre"];
		}
		return $ToReturn;
	}
	function getCedentesMandante($mandante){
		$db = new Db();
	    $cedentes = $db -> select("SELECT m.id_cedente as idCedente, c.Nombre_Cedente as NombreCedente FROM mandante_cedente as m, Cedente as c WHERE m.id_mandante = '".$mandante."' AND c.id_cedente = m.Id_Cedente");
	    return $cedentes;
	}
	function getMandantes(){
		$db = new Db();
	    $mandantes = $db -> select("SELECT id, nombre FROM mandante");
	    return $mandantes;
	}
	function getCedentes(){
		$db = new Db();
        $CedentesArray = array();
        $Sql = "select * from Cedente";
        $cedentes = $db -> select($Sql);
        foreach($cedentes as $cedente){
        	$Array = array();
            $Array['nombre'] = utf8_encode($cedente["Nombre_Cedente"]);
            $Array['Actions'] = $cedente["Id_Cedente"];
            array_push($CedentesArray,$Array);
         }
         return $CedentesArray;  
	}
	function creaCedente($nombreCedente, $fechaIngreso){
        $db = new Db();
        $SqlInsertCedente = "insert into Cedente (Nombre_Cedente, Fecha_Ingreso) values('".$nombreCedente."', '".$fechaIngreso."')";               
        $InsertCedente = $db -> query($SqlInsertCedente);   
        return $db->getLastID();     
	}
	public function eliminaCedente($idCedente){
        $db = new Db();
        $SqlEliminarCedente = "delete from Cedente where Id_Cedente = '".$idCedente."'";
        $db -> query($SqlEliminarCedente);        
    }  
}
?>
