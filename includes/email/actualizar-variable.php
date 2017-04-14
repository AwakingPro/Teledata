<?php include_once("../functions/Functions.php");
    QueryPHP_IncludeClasses("db");
    $db = new Db();

	$id = $_POST["id"];
	$nombre = $_POST["nombre"];
	$tabla = $_POST["tabla"];
	$tipo = $_POST["tipo"];
	$campos = $_POST["campos"];
	$operacion = $tipo == 'operacion' ? $_POST["operacion"] : '';

	$consultar = "SELECT id FROM Variables WHERE variable = '".$nombre."' AND id != '".$id."'";

	$existe = $db->select($consultar);

	if(count($existe) > 0){
		echo '3';
	} else {

		$query_guardar = "UPDATE Variables SET variable = '".$nombre."', tabla ='".$tabla."', campo = '".$campos."', operacion = '".$operacion."' WHERE id = '".$id."'";

		$guardar = $db->query($query_guardar);

		if($guardar == false){
			echo '2';
		} else {
			echo '1';
		}
	}