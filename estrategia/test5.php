<?php
$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);
$array_central = array();
$sql = mysql_query("SELECT id,id_subquery FROM SIS_Querys WHERE id_estrategia = 1");
$num = mysql_query("SELECT id FROM SIS_Querys WHERE id_estrategia = 1");
$num = mysql_num_rows($num);
while($row = mysql_fetch_array($sql))
{
  $id = $row[0];
  $id_subquery = $row[1];
  if($id_subquery==0)
  {
    array_push($array_central, $id);
    $i=1;
    
    while($i<14)
    {  
      echo $i;
      $nombres[$i] = $sqli;
      $sqli= mysql_query("SELECT id FROM SIS_Querys WHERE id_subquery=$id limit 1");
      while($row2= mysql_fetch_array($sqli))
      {
        $id = $row2[0];
        array_push($array_central, $id);
      }
    $i++;
    }
  }   
}  
?>




