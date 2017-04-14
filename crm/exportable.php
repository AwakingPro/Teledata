<?PHP 

include("graficoTabla.php");

$tabla_exportable = new Grafico();
$tabla_exportable->crearTablaExportable($_POST['id'],$_POST['lista'],$_POST['cedente']);


?>