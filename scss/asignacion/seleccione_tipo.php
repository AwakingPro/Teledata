<?php
$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);
$id=$_POST['id'];
$sql_estrategia = mysql_query("SELECT * FROM SIS_Estrategias WHERE  tipo='$id'");
if(mysql_num_rows($sql_estrategia)>0){
?>

<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
                                                <tr>
                                                 <th>ID Estrategia</th>
                                                 <th>Nombre de la Estrategia</th>
                                                 <th class="min-desktop"><center>Creador</center></th>
                                                 <th class="min-desktop"><center>Hora</center></th>
                                                 <th class="min-desktop"><center>Fecha</center></th>
                                                 <th class="min-desktop"><center>Seleccionar</center></th>
                                                </tr>
                                               </thead>
                                              <tbody>
                                              <?php 
                                               $j = 1;
                                              $sql_estrategia2 = mysql_query("SELECT * FROM SIS_Estrategias WHERE  tipo='$id'");
                                                while($row=mysql_fetch_array($sql_estrategia2)){ ?>
                                               <tr id='<?php echo $row[0]; ?>' class='<?php echo $j; ?>'>
                                               <td><?php echo $row[0];?></td>
                                               <td><?php echo $row[1];?></td>
                                               <td><?php echo $row[2];?></td>
                                               <td><?php echo $row[3];?></td>
                                               <td><?php echo $row[4];?></td>
                        <td><center><input type='checkbox' class='seleccione_estrategia' id="dos<?php echo $j; ?>" /></center></td></td>
                                               </tr> 
                                               <?php 
                                               $j++;
                                                 }
                                              ?>  
                                              </tbody>
                                             </table>          
<?php } 
else {

  echo "No hay estrategias creadas en el Tipo seleccionado.";
}
?>