<?PHP 

include("../../class/estrategia/estrategia.php");

if(!isset($_SESSION)){
    session_start();
}

$EstrategiaClass = new Estrategia();
$EstrategiaClass->crearTablaExportable($_POST['id'],$_POST['lista'],$_SESSION['cedente']);


?>