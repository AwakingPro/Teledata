<?php include_once("../functions/Functions.php");
    QueryPHP_IncludeClasses("db");
    $db = new Db();

	$template_name = $_POST["tname"];
	$template = $_POST["template"];

	$query_guardar = "INSERT INTO EMAIL_Template (Nombre, Template) VALUES('". $template_name ."', '". $template ."')";

	$guardar = $db->query($query_guardar);

	if($guardar == false){
		echo '2';
	} else {
		echo '1';
	}

		/* $id_template = mysqli_insert_id($con);		

	    $templates_row = '<tr><td class="ttitle">Template '.$id_template.': '.$template_name.'</td><td><button type="button" data-id="'.$id_template.'" class="use-template btn btn-default">Use</button> <button data-id="'.$id_template.'" class="delete-template btn btn-default" type="button">Delete</button></td></tr>';

        $return = array();

        $return[] =  $templates_row;
        $return[] =  $id_template;

	    echo json_encode($return);
	}*/

?>