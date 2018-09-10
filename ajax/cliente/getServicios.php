<?php
$query_servicios = "SELECT
Estatus
FROM servicios
WHERE Rut = $Rut ";

$servicios = $run->select($query_servicios);
$total_servicios =  count($servicios);
$activos = 0;
$vencidos = 0;

if($total_servicios > 0) {
    foreach($servicios as $servicio) {
        if($servicio['Estatus'] == 1) {
            $activos+= 1;
        } else {
            $vencidos+=1;
        }
    }
}
// echo 'Rut '. $Rut;
// echo ' activos '.$activos;
// echo ' Vencidos '.$vencidos;

?>