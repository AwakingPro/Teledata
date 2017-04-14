<?php
$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);

$id_estrategia = 42;
$array_central = array();

$sql = mysql_query("SELECT id,id_subquery FROM SIS_Querys WHERE id_estrategia = $id_estrategia");

while($row = mysql_fetch_array($sql))
   {
   	  $id = $row[0];
   	  $id_subquery = $row[1];
   	  if($id_subquery==0)
   	    {
            array_push($array_central, $id);
            $sql2 = mysql_query("SELECT id FROM SIS_Querys WHERE id_subquery=$id");
 		    while($row2 = mysql_fetch_array($sql2))
               {
		   	       $id2 = $row2[0];
 				   array_push($array_central, $id2);
 				   $sql3 = mysql_query("SELECT id FROM SIS_Querys WHERE id_subquery=$id2");
 			       while($row3 = mysql_fetch_array($sql3))
                     {
		   	            $id3 = $row3[0];
		   	            array_push($array_central, $id3);


		   	         }


		   	       

   	            }  
   	    } 
      else 
       {
 			

       }
      

   }

print_r($array_central);


?>


