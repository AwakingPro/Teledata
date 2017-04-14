<?php
class Empresa{
    public function creaEmpresaExterna($nombre, $email, $telefono, $direccion){
        $db = new Db();
        $SqlInsert = "INSERT INTO EE_empresa_externa(nombre, email, telefono, direccion) values('".$nombre."', '".$email."', '".$telefono."', '".$direccion."')";        
        $db -> query($SqlInsert);
    }

    public function getEmpresas(){
		$db = new Db();
        $EmpresasArray = array();
        $Sql = "SELECT * FROM EE_empresa_externa";
        $empresas = $db -> select($Sql);
        foreach($empresas as $empresa){
        	$Array = array();
            $Array['nombre'] = utf8_encode($empresa["nombre"]);
            $Array['Actions'] = $empresa["idEmpresaExterna"];
            array_push($EmpresasArray,$Array);
         }
         return $EmpresasArray;  
	}

    public function eliminaEmpresa($idEmpresa){
        $db = new Db();
        $SqlEliminar = "delete from EE_empresa_externa where idEmpresaExterna = '".$idEmpresa."'";
        $db -> query($SqlEliminar);        
    } 

    public function muestraDatosEmpresa($idEmpresa){
        $db = new Db();
        $datosArray = array();
        $SqlDatos = "SELECT * FROM EE_empresa_externa WHERE idEmpresaExterna = '".$idEmpresa."'";
        $Datos = $db -> select($SqlDatos);
        return $Datos;
    } 

    public function modificaEmpresaExterna($nombre, $email, $telefono, $direccion, $idEmpresa){
        $db = new Db();
        $SqlUpdate = "UPDATE EE_empresa_externa set nombre = '".$nombre."', email = '".$email."', telefono = '".$telefono."', direccion = '".$direccion."' WHERE idEmpresaExterna='".$idEmpresa."' ";
        $db -> query($SqlUpdate);
    }
}
?>