<?php

header('Content-Type: application/json');

$con = mysqli_connect("localhost","root","M9a7r5s3A","foco");

// Check connection
if (mysqli_connect_errno($con))
{
    echo "Failed to connect to DataBase: " . mysqli_connect_error();
}else
{
    $data_points = array();
    
    $result = mysqli_query($con, "SELECT * FROM SIS_grafico_fonos");
    
    while($row = mysqli_fetch_array($result))
    {        
        $point = array("name" => $row['color'] , "y" => $row['cant'],"color" => $row['color_2'],"name" => $row['color']);
        
        array_push($data_points, $point);        
    }
    
    echo json_encode($data_points, JSON_NUMERIC_CHECK);
}
mysqli_close($con);

?>