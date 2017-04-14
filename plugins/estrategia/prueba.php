<?php

$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);
$id_estrategia=146;
//<----------------------------Valor Recibido------------------------------>
$result_tablas= mysql_query("SELECT columnas FROM SIS_Columnas_All WHERE id_estrategia=$id_estrategia");
$variable_tabla_columnas = array();
while($row = mysql_fetch_array($result_tablas)){
    $variable_tabla_columnas[] = $row[0].".Rut";
}
 $variable_tabla_columnas_lenght=count($variable_tabla_columnas);
$i=0;
$count=$variable_tabla_columnas_lenght-1;
$j=1;
$variable_final_tabla_columnas='';
while($i<$variable_tabla_columnas_lenght)
      {
          if($j<$count){
               $k=' AND ';
               $s=$variable_tabla_columnas[0]." = ";
          }
          elseif($j==$count){
               $k='  ';
               $s=$variable_tabla_columnas[0]." = ";
          }
          else {
               $k='';
               $s='';
          }
          $variable_final_tabla_columnas = $variable_final_tabla_columnas.$s.$variable_tabla_columnas[$i+1].$k;
          $i++; 
          $j++;
      }
//=====================Armar query 1======================
         
echo $query1="SELECT * FROM ".$variable_final_tablas." WHERE ".$variable_final_columnas." AND ".$variable_final_tabla_columnas;
$query2="SELECT * FROM ".$variable_final_tablas." WHERE NOT ".$variable_final_columnas2." AND ".$variable_final_tabla_columnas;









?>