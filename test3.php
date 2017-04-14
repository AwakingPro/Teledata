<?php
$db = new PDO('mysql:host=localhost;dbname=foco;charset=utf8mb4', 'root', 'M9a7r5s3A');
$stmt = $db->query('SELECT * FROM Persona LIMIT 1');
 
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
{
    echo $row['Rut'];
}
?>