<?php include_once("../functions/Functions.php");
    QueryPHP_IncludeClasses("db");
    $db = new Db();

    $id = $_POST["vid"];     

    $query_delete = "DELETE FROM Variables WHERE Id=".$id;
    $return = false;

    $delete = $db->query($query_delete);

    if($delete !== false){

        echo '1';

    } else {
        echo '2';
    }

?>