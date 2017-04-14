<?php
class Trabajador{

  public function muestraDatosGeneralesTrabajador($idTrabajador){
    $db = new Db();
    $Array = array();
    // datos generales del trabajador
    $SqlDatosTrabajador = "SELECT * FROM Personal WHERE Id_Personal = '".$idTrabajador."'";
    $Datos = $db -> select($SqlDatosTrabajador);    
    foreach($Datos as $dato){      
      $Array['email'] = $dato["email"];
      $Array['nombre'] = $dato["Nombre"];
      $Array['telefonoMovil'] = $dato["fono_movil"];
      $Array['direccion'] = $dato["direccion"];
    }    

    // busco el nombre del cargo del trabajador
    $SqlDatosCargo = "SELECT cargo FROM RH_cargo WHERE id_cargo = '".$Datos[0]['id_cargo']."'";
    $Cargo = $db -> select($SqlDatosCargo);  
    $Array['cargo'] = $Cargo[0]['cargo'];     
     
    return $Array;
  }

  public function getTrabajadores(){
		$db = new Db();
    $trabajadoresArray = array();
    $Sql = "SELECT * FROM Personal ORDER BY Nombre ASC";
    $trabajadores = $db -> select($Sql);
    foreach($trabajadores as $trabajador){
      $Array = array();
      $Array['nombre'] = utf8_encode($trabajador["Nombre"]);
      $Array['usuario'] = $trabajador["Nombre_Usuario"];
      $Array['email'] = $trabajador["email"];
      $Array['Actions'] = $trabajador["Id_Personal"];
      array_push($trabajadoresArray,$Array);
    }
    return $trabajadoresArray;  
	}


  public function crearTrabajador($nombre, $email, $telefono, $direccion){
    $db = new Db();    
    $SqlInsert = "INSERT INTO Personal(Nombre, email, fono_movil, direccion) values('".$nombre."', '".$email."', '".$telefono."', '".$direccion."')";        
    $db -> query($SqlInsert);
  }

  public function eliminaTrabajador($idTrabajador){
    $db = new Db();
    $SqlEliminar = "DELETE FROM Personal WHERE Id_Personal = '".$idTrabajador."'";
    $db -> query($SqlEliminar);
  }

  public function modificaTrabajador($nombre, $email, $telefono, $direccion, $idTrabajador){
    $db = new Db();
    $SqlUpdate = "UPDATE Personal set Nombre = '".$nombre."', email = '".$email."', fono_movil = '".$telefono."', direccion = '".$direccion."' WHERE Id_Personal='".$idTrabajador."' ";
    $db -> query($SqlUpdate);
  }

  public function getListarCargos(){
    $db = new Db();
    $cargosArray = array();
    $Sql = "SELECT * FROM RH_cargo ORDER BY cargo ASC";
    $cargos = $db -> select($Sql);
    foreach($cargos as $cargo){
      $Array = array();
      $Array['cargo'] = utf8_encode($cargo["cargo"]);
      $Array['id_cargo'] = $cargo["id_cargo"];
      array_push($cargosArray,$Array);
    }
    return $cargosArray;
  }

  public function getListarRegiones(){
    $db = new Db();
    $regionesArray = array();
    $Sql = "SELECT * FROM RH_region ORDER BY region ASC";
    $regiones = $db -> select($Sql);
    foreach($regiones as $region){
      $Array = array();
      $Array['region'] = utf8_encode($region["region"]);
      $Array['id_region'] = $region["id_region"];
      array_push($regionesArray,$Array);
    }
    return $regionesArray;
  }


  public function getListarProvincias($idRegion){
    $db = new Db();
    $provinciasArray = array();
    $Sql = "SELECT * FROM RH_provincia WHERE id_region = '".$idRegion."' ORDER BY provincia ASC";
    $provincias = $db -> select($Sql);
    foreach($provincias as $provincia){
      $Array = array();
      $Array['provincia'] = utf8_encode($provincia["provincia"]);
      $Array['id_provincia'] = $provincia["id_provincia"];
      array_push($provinciasArray,$Array);
    }
    return $provinciasArray;
  }

  public function getListarComunas($idProvincia){
    $db = new Db();
    $comunasArray = array();
    $Sql = "SELECT * FROM RH_comuna WHERE id_provincia = '".$idProvincia."' ORDER BY comuna ASC";
    $comunas = $db -> select($Sql);
    foreach($comunas as $comuna){
      $Array = array();
      $Array['comuna'] = utf8_encode($comuna["comuna"]);
      $Array['id_comuna'] = $comuna["id_comuna"];
      array_push($comunasArray,$Array);
    }
    return $comunasArray;
  }


   public function getListarNacionalidad(){
    $db = new Db();
    $nacionalidadesArray = array();
    $Sql = "SELECT * FROM RH_nacionalidad ORDER BY nacionalidad ASC";
    $nacionalidades = $db -> select($Sql);
    foreach($nacionalidades as $nacionalidad){
      $Array = array();
      $Array['nacionalidad'] = utf8_encode($nacionalidad["nacionalidad"]);
      $Array['id_nacionalidad'] = $nacionalidad["id_nacionalidad"];
      array_push($nacionalidadesArray,$Array);
    }
    return $nacionalidadesArray;
  }

}
?>