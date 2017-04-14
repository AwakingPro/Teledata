<?php
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('Column 1', 'Column 2'));

// fetch the data



// loop over the rows, outputting them
$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);

$id = 13;
$sql = mysql_query("SELECT query FROM SIS_Querys WHERE id=$id");

$constate1 = "SELECT Persona.Rut , Deuda.Monto_Mora FROM Persona,Deuda WHERE Persona.Rut IN (";
$constate2 = ") AND Persona.Rut  = Deuda.Rut";

while($row=mysql_fetch_array($sql))
     {
        $query=$row[0];
     }
$queryFinal = $constate1.$query.$constate2;
$rows = mysql_query($queryFinal);
while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);


?>


