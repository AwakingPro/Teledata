<?php
include('../../db/conexion_foco.php');
$conexion = new Conexion();
$mysqli= $conexion->Conectar();
$result = $mysqli->query("SELECT * FROM Persona LIMIT 10");

		if ($result->num_rows > 0) {
		    while($row = $result->fetch_assoc()) {
		        echo "id: " . $row["Rut"];
		    }
		} 
		else {
		    echo "0 results";
		}
		$mysqli->close();
$mysqli->close();
?>