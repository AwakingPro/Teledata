<?php include_once("../functions/Functions.php");
    QueryPHP_IncludeClasses("db");
    $db = new Db();

    $title = $_POST["tname"];  
    $template = $_POST["template"];  
    $id = $_POST["templateid"];     

    $query_update = "UPDATE EMAIL_Template SET Nombre = '".$title."', Template='".$template."' WHERE Id=".$id;

    $update = $db->query($query_update);

    if($update !== false){
        echo '1';
    } else{
        echo '2';
    }

?>