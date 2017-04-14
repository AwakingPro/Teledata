<?php include_once("../functions/Functions.php");
    QueryPHP_IncludeClasses("db");
    $db = new Db();

    $template_id = $_POST["id"];

    $query_select = "SELECT Id, Nombre, Template FROM EMAIL_Template WHERE Id = ".$template_id;

    $row_select = $db->select($query_select);

    if(count($row_select) > 0){

    	$row = $row_select[0];

    	$temp = array($row['Template'],$row['Nombre'],$row['Id']);

	} else {
		$temp = array('','','');
	}

    echo json_encode($temp);

?>