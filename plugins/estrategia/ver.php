<?php
$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);

$columna_x='Persona.Fecha_Nacimiento>"1982-09-11"';
$condicion_x='';
$id_subquery=9;
$count=0;
$condicion=" AND ".$condicion_x." ".$columna_x;
$array_central = array();
array_push($array_central, $condicion);



$query1=mysql_query("SELECT id_subquery,condicion ,columna FROM SIS_Querys WHERE id=$id_subquery");
while($row=mysql_fetch_array($query1))
     {
          $id_subquery = $row[0]; //2
          $count++;
          if ($id_subquery==0)
               {
                    $condicion=$row[1]." ".$row[2];
                    array_push($array_central, $condicion);
               }
          else
              {
                    $condicion=" AND ".$row[1]." ".$row[2];
                    array_push($array_central, $condicion);
               }
          while($id_subquery!=0)
               {
                    $query2=mysql_query("SELECT id_subquery,condicion ,columna FROM SIS_Querys WHERE id=$id_subquery");    
                    while($row=mysql_fetch_array($query2))
                        {
                              $id_subquery = $row[0]; //0
                              $count++;
                              if ($id_subquery==0)
                                  {
                                        $condicion=$row[1]." ".$row[2];
                                        array_push($array_central, $condicion);
                                   }
                              else
                                   { 
                                        $condicion=" AND ".$row[1]." ".$row[2];
                                        array_push($array_central, $condicion);
                                   }
                         }
               }
     }

$count = count($array_central);
$i=0;
$k=$count-1;
$variable_central='';
while($i<$count)
      {

          $variable_central = $variable_central.$array_central[$k];
          $i++; 
          $k--;
      }

echo "Query 1 : "."SELECT * FROM Persona,Deuda WHERE ".$variable_central;
echo "<br>";
$columna_x='Persona.Fecha_Nacimiento>"1982-09-11"';
$condicion_x=' NOT ';

$id_subquery=9;
$count=0;
$condicion=" AND ".$condicion_x." ".$columna_x;
$array_central = array();
array_push($array_central, $condicion);



$query1=mysql_query("SELECT id_subquery,condicion ,columna FROM SIS_Querys WHERE id=$id_subquery");
while($row=mysql_fetch_array($query1))
     {
          $id_subquery = $row[0]; //2
          $count++;
          if ($id_subquery==0)
               {
                    $condicion=$row[1]." ".$row[2];
                    array_push($array_central, $condicion);
               }
          else
              {
                    $condicion=" AND ".$row[1]." ".$row[2];
                    array_push($array_central, $condicion);
               }
          while($id_subquery!=0)
               {
                    $query2=mysql_query("SELECT id_subquery,condicion ,columna FROM SIS_Querys WHERE id=$id_subquery");    
                    while($row=mysql_fetch_array($query2))
                        {
                              $id_subquery = $row[0]; //0
                              $count++;
                              if ($id_subquery==0)
                                  {
                                        $condicion=$row[1]." ".$row[2];
                                        array_push($array_central, $condicion);
                                   }
                              else
                                   { 
                                        $condicion=" AND ".$row[1]." ".$row[2];
                                        array_push($array_central, $condicion);
                                   }
                         }
               }
     }

$count = count($array_central);
$i=0;
$k=$count-1;
$variable_central2='';
while($i<$count)
      {

          $variable_central2 = $variable_central.$array_central[$k];
          $i++; 
          $k--;
      }
echo "Query 2 : "."SELECT * FROM Persona,Deuda WHERE ".$variable_central;

?>