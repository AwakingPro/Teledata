<?php
include("../../db/db.php");

class Dte{

	public function LlenarDatos($Rut){
        $this->Rut=$Rut;
        $QueryLlenarDatos= mysql_query("SELECT giro,contacto,direccion FROM PersonaEmpresa WHERE rut = $this->Rut");
        while($row=mysql_fetch_array($QueryLlenarDatos)){
            $Giro = $row[0];
            $Contacto= $row[1];
            $Direccion= $row[2];
        }
        $array = array('giro' => "$Giro", 'contacto' => "$Contacto", 'direccion' => "$Direccion", 'rut' => "$this->Rut");
		echo json_encode($array);

	}
}
?>
