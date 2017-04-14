<?php
$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);

$tablas=$_POST['tablas'];
$id_estrategia=$_POST['id_estrategia'];
$columnas=$_POST['columnas'];
$id_clase=$_POST['id_clase'];
$logica=addslashes($_POST['logica']);
$valor=$_POST['valor'];
$siguiente_nivel=$_POST['siguiente_nivel'];
$nombre_nivel=$_POST['nombre_nivel'];


//--------------------TABLAS----------------------
$sql=mysql_query("select * from SIS_Tablas WHERE id='$tablas'");
while($row=mysql_fetch_array($sql))
     {
     	$tablas=$row[1];
     }
//--------------------COLUMNAS----------------------     
$sql=mysql_query("select * from SIS_Columnas WHERE id='$columnas'");
while($row=mysql_fetch_array($sql))
     {
          $columnas=$row[1];
     }    

$sql_ver_tablas=mysql_query("select * FROM SIS_Tablas_All WHERE tablas='$tablas'");
if(mysql_num_rows($sql_ver_tablas)>0){

     echo "Tabla Duplicada";
}
else{
     
     $sql_insert=mysql_query("INSERT INTO SIS_Tablas_All (tablas) VALUES ('$tablas')");
     echo "Tabla Insertada";
}
$sql_ver_columnas=mysql_query("select * FROM SIS_Columnas_All WHERE columnas='$columnas'");
if(mysql_num_rows($sql_ver_columnas)>0){

     echo "Columnas Duplicada";
}
else{
     $columnas=$tablas.".".$columnas;
     $sql_insert=mysql_query("INSERT INTO SIS_Columnas_All (columnas) VALUES ('$columnas')");
     echo "Columnas Insertada";
}

$sql=mysql_query("select tablas from SIS_Tablas_All ");
while($row = mysql_fetch_assoc($sql)){
    echo $row['tablas']; //Displays the database id

    $resultado[] = $row['tablas'];
}


$query='"SELECT * FROM '.$resultado[0].','.$resultado[1].'"';
$sql_insert=mysql_query("INSERT INTO SIS_Querys_All (query) VALUES ('$query')");



?>