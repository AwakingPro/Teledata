<?php
$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);

$tablas=$_POST['tablas'];
$id_estrategia=$_POST['id_estrategia'];
$columnas=$_POST['columnas'];
$id_clase=$_POST['id_clase'];
$logica=addslashes($_POST['logica']);
$valor=$_POST["valor"];
$siguiente_nivel=$_POST['siguiente_nivel'];
$nombre_nivel=$_POST['nombre_nivel'];


//--------------------TABLAS----------------------
$sql=mysql_query("select * from SIS_Tablas WHERE id='$tablas'");
while($row=mysql_fetch_array($sql))
     {
          $tablas=$row[1];
     }
//--------------------COLUMNAS Y TIPO DE DATO : 0 INT - DATE, 1 STRING----------------------     
$sql=mysql_query("select columna,tipo from SIS_Columnas WHERE id='$columnas'");
while($row=mysql_fetch_array($sql))
     {
          $columnas=$row[0];
          $tipo=$row[1];
     }
if ($tipo==0)
     {     
         $valor = $valor;
     }
else 
     {
          $valor = '"'.$valor.'"';
     }         

$sql_ver_tablas=mysql_query("select * FROM SIS_Tablas_All WHERE tablas='$tablas' and id_estrategia=$id_estrategia");
if(mysql_num_rows($sql_ver_tablas)>0){

     //echo "Tabla Duplicada";
}
else{
     
     $sql_insert=mysql_query("INSERT INTO SIS_Tablas_All (tablas,id_estrategia) VALUES ('$tablas','$id_estrategia')");
     //echo "Tabla Insertada";
}
$sql_ver_columnas=mysql_query("select * FROM SIS_Columnas_All WHERE columnas='$columnas2' and id_estrategia=$id_estrategia");
if(mysql_num_rows($sql_ver_columnas)>0){

     //echo "Columnas Duplicada";
}
else{
     $columnas=$columnas;
     $sql_insert=mysql_query("INSERT INTO SIS_Columnas_All (columnas,id_estrategia) VALUES ('$columnas2','$id_estrategia')");
     //echo "Columnas Insertada";
}
//-----------------------Creacion de Querys Dinamicas-------------------
    $constante = "SELECT Rut FROM Persona WHERE Rut IN ";
    $constanteNot = "SELECT Rut FROM Persona WHERE NOT Rut IN ";

    $constanteDeuda = "SELECT Persona.Rut,Deuda.Monto_Mora FROM Persona,Deuda WHERE Persona.Rut IN ";
    $constanteDeudaNot = "SELECT Persona.Rut,Deuda.Monto_Mora FROM Persona,Deuda WHERE NOT Persona.Rut IN ";

    $subQuery = "(SELECT Rut FROM $tablas WHERE $columnas $logica $valor)";
    $subQueryDeuda = "(SELECT Rut FROM $tablas WHERE $columnas $logica $valor) AND Persona.Rut = Deuda.Rut";

//-----------------------QUERY 1-------------------

    $query1 = $constante.$subQuery;

    $queryDeuda = $constanteDeuda.$subQueryDeuda;
    $queryDeudaNot = $constanteDeudaNot.$subQueryDeuda;

    $query_1=mysql_query($query1);
    while($row2=mysql_fetch_array($query_1))
      {
        $a=$row2['Rut'];
      }
    $numero = mysql_num_rows($query_1);
    $numero = number_format($numero, 0, "", ".");
    $monto1 = mysql_query($queryDeuda);     
    while($row=mysql_fetch_assoc($monto1))
      {
        $monto_1= $monto_1 + $row['Monto_Mora'];
      }
    $monto_1 = '$  '.number_format($monto_1, 0, "", ".");

//-----------------------QUERY 2-------------------


    $query2 = $constanteNot.$subQuery;
    $query_2=mysql_query($query2);
    while($row2=mysql_fetch_array($query_2))
      {
        $a=$row2['Rut'];
      }
    $numero2 = mysql_num_rows($query_2);
    $numero2 = number_format($numero2, 0, "", ".");
    $monto2 = mysql_query($queryDeudaNot);     
    while($row=mysql_fetch_assoc($monto2))
      {
        $monto_2= $monto_2 + $row['Monto_Mora'];
      }
    $monto_2 = '$  '.number_format($monto_2, 0, "", ".");

$matriz1 = "SELECT Rut FROM Persona WHERE  Rut IN ";
$matrizDeuda1 = "SELECT Persona.Rut,Deuda.Monto_Mora FROM Persona,Deuda WHERE Persona.Rut IN ";
$matriz2 = "SELECT Rut FROM Persona WHERE NOT Rut IN ";
$matrizDeuda2 = "SELECT Persona.Rut,Deuda.Monto_Mora FROM Persona,Deuda WHERE NOT Persona.Rut IN ";

mysql_query("INSERT INTO SIS_Querys(query,id_estrategia,cantidad,monto,cola,columna,condicion,matriz,matriz_deuda) VALUES('$query1','$id_estrategia','$numero','$monto_1','$nombre_nivel','$subQuery','','$matriz1','$matrizDeuda1')");
mysql_query("INSERT INTO SIS_Querys(query,id_estrategia,cantidad,monto,cola,columna,condicion,matriz,matriz_deuda) VALUES('$query2','$id_estrategia','$numero2','$monto_2','No Seleccionado','$subQuery','NOT','$matriz2','$matrizDeuda2')");

$query_id1=mysql_query("SELECT id FROM SIS_Querys WHERE query='$query1' AND id_estrategia='$id_estrategia'");
$query_id2=mysql_query("SELECT id FROM SIS_Querys WHERE query='$query2' AND id_estrategia='$id_estrategia'");
while($row=mysql_fetch_array($query_id1)){

	$id1=$row['id'];
}

while($row=mysql_fetch_array($query_id2)){

	$id2=$row['id'];
}
$array = array('first' => "<tr id='$id1'><td><i class='psi-folder-open' id='b$id1'  style='display: none;'></i> $nombre_nivel</td><td><center>$numero</center></td><td><center>$monto_1</center></td><td><center><a class='subestrategia'  id='d$id1'  href='#'><i class='fa fa-sitemap'></i></a> &nbsp;&nbsp;<a href='#' class='link'><i class='fa fa-trash'></i></a></center></td><td><center><input type='checkbox' class='checkeo$id_clase' id='c$id1' name='c$id1' value='$id1' /></center></td></tr><tr id='$id2'><td><i class='psi-folder-open' id='b$id2'  style='display: none;'></i> No Seleccionado</td><td><center>$numero2</center></td><td><center>$monto_2</center></td><td><center><a href='#' class='subestrategia' id='d$id2'><i class='fa fa-sitemap'></i></a> &nbsp;&nbsp;<a href='#' class='link'><i class='fa fa-trash'></i></a></center></td><td><center><input type='checkbox' class='checkeo$id_clase' id='c$id2' name='c$id2' value='$id2' /></center></td></tr>", 'second' => "<input type='hidden' value='$id1' id='id_clase' name='id_clase'>");
echo json_encode($array);

?>