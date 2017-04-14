<?php
require_once('../db/db.php');
?>
<table id="demo-dt-selection" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead>
    <tr>
        <th>Nombre Ejecutivo</th>
        <th>Cantidad de Gestiones</th>
        <th>Compromisos</th>
        <th>Titular</th>
        <th>Tercero</th>
        <th>No Contesta</th>
        <th>Inubicable</th>
        <th>Otro</th>
    
    
    </tr>
</thead>
<tbody>
<?php
    $QueryReportes = mysql_query("SELECT COUNT(rut_cliente) AS Cantidad, nombre_ejecutivo FROM gestion_ult_trimestre WHERE fecha_gestion = CURDATE() GROUP BY nombre_ejecutivo");
    while($row = mysql_fetch_array($QueryReportes)){
    $Cantidad = $row[0];
    $Ejecutivo = $row[1];
    echo "<tr>";
    echo "<td>".$Ejecutivo."</td>";
    echo "<td>".$Cantidad."</td>";
    $QueryTipo5 = mysql_query("SELECT COUNT(rut_cliente) AS Cantidad FROM gestion_ult_trimestre WHERE fecha_gestion = CURDATE() AND Id_TipoGestion = 5 AND nombre_ejecutivo = '$Ejecutivo'");
    while($row = mysql_fetch_array($QueryTipo5)){
        $Compromiso = $row[0];
    }
    $QueryTipo1 = mysql_query("SELECT COUNT(rut_cliente) AS Cantidad FROM gestion_ult_trimestre WHERE fecha_gestion = CURDATE() AND Id_TipoGestion = 1 AND nombre_ejecutivo = '$Ejecutivo'");
    while($row = mysql_fetch_array($QueryTipo1)){
        $Titular = $row[0];
    }
    $QueryTipo2 = mysql_query("SELECT COUNT(rut_cliente) AS Cantidad FROM gestion_ult_trimestre WHERE fecha_gestion = CURDATE() AND Id_TipoGestion = 2 AND nombre_ejecutivo = '$Ejecutivo'");
    while($row = mysql_fetch_array($QueryTipo2)){
        $Tercero = $row[0];
    }
    $QueryTipo3 = mysql_query("SELECT COUNT(rut_cliente) AS Cantidad FROM gestion_ult_trimestre WHERE fecha_gestion = CURDATE() AND Id_TipoGestion = 3 AND nombre_ejecutivo = '$Ejecutivo'");
    while($row = mysql_fetch_array($QueryTipo3)){
        $NoContesta = $row[0];
    }
    $QueryTipo4 = mysql_query("SELECT COUNT(rut_cliente) AS Cantidad FROM gestion_ult_trimestre WHERE fecha_gestion = CURDATE() AND Id_TipoGestion = 4 AND nombre_ejecutivo = '$Ejecutivo'");
    while($row = mysql_fetch_array($QueryTipo4)){
        $Inubicable = $row[0];
    }
    $QueryTipo = mysql_query("SELECT COUNT(rut_cliente) AS Cantidad FROM gestion_ult_trimestre WHERE fecha_gestion = CURDATE() AND Id_TipoGestion = 4 AND nombre_ejecutivo = '$Ejecutivo'");
    while($row = mysql_fetch_array($QueryTipo)){
        $Otro = $row[0];
    }
    
    
    echo "<td>".$Compromiso."</td>";
    echo "<td>".$Titular."</td>";
    echo "<td>".$Tercero."</td>";
    echo "<td>".$NoContesta."</td>";
    echo "<td>".$Inubicable."</td>";
    echo "<td>".$Otro."</td>";
    echo "</tr>";

    }
?>    

</tbody>
</table>