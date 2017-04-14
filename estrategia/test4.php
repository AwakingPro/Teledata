<?php
$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);

$id_estrategia = 81;
$array_central = array();
$k=0;
$sql = mysql_query("SELECT id,id_subquery FROM SIS_Querys WHERE id_estrategia = $id_estrategia");

while($row = mysql_fetch_array($sql))
   {
   	  $id = $row[0];
   	  $id_subquery = $row[1];
   	  if($id_subquery==0)//37
   	    {
      echo $id;
      array_push($array_central, $id); //37
      while ($k<10){
            $query = "query".$k;	
            $query = mysql_query("SELECT id FROM SIS_Querys WHERE id_subquery=$id ");
 		    while($row = mysql_fetch_array($query))
               {
		   	       
		   	       echo $id = $row[0];//39
		   	       array_push($array_central, $id);
                   $query = mysql_query("SELECT id FROM SIS_Querys WHERE id_subquery=$id ");
		 		    while($row = mysql_fetch_array($query))
		               {
				   	       
				   	       echo $id = $row[0];//39
				   	       array_push($array_central, $id);


		   	            }

   	            }
            
            
   	        $k++;    

   	        } 
        echo $id;
   	    }
   	    else {


   	    }

             
   }

?>

<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
    								           <thead>
    									        <tr>
            										<th>Nombre de la Cola</th>
                                                    <th class="min-desktop"><center>Cantidad de Registros</center></th>
                                                    <th class="min-desktop"><center>Monto</center></th>
            										<th class="min-desktop"><center>Opciones</center></th>
                                                    <th class="min-desktop"><center>Eliminar</center></th>
                                                    <th class="min-desktop"><center>Terminal</center></th>
    									        </tr>
    								           </thead>
    								          <tbody>
    								          		<?php $contar = count($array_central);
													$i=0;
													while($i<$contar){
													    $arre = $array_central[$i];
													    $sq = mysql_query("SELECT * FROM SIS_Querys WHERE id=$arre");
													    while($row4=mysql_fetch_array($sq))
													    {
													    	?>
													    	<tr>
													    	<td><?php echo $id = $row4[8];?></td>
													    	<td><?php echo $id = $row4[4];?></td>
													    	<td><?php echo $id = $row4[5];?></td>
													    	<td><?php echo $id = $row4[0];?></td>
													    	<td></td>
    									                    </tr>
													    <?php }

														$i++;
													}
?>
    									       	
    								          </tbody>
    							             </table>




