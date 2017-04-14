<?php
$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);
$id=$_POST['id'];
?>
<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
                                                <tr>
                                                 <th>ID Cola</th>
                                                 <th>Cola</th>
                                                 <th class="min-desktop"><center>Cantidad de Registros</center></th>
                                                 <th class="min-desktop"><center>Monto</center></th>
                                                 <th class="min-desktop"><center>Seleccionar</center></th>
                                                </tr>
                                               </thead>
                                              <tbody>
                                              <?php 
                                              $k = 1;
                                              $sql_estrategia = mysql_query("SELECT id,cola,cantidad,monto FROM SIS_Querys WHERE  id_estrategia='$id' AND terminal=1");
                                                while($row=mysql_fetch_array($sql_estrategia)){ ?>
                                               <tr id='<?php echo $row[0]; ?>' class='<?php echo $k; ?>'>
                                               <td><?php echo $row[0];?></td>
                                               <td><?php echo $row[1];?></td>
                                               <td><?php echo $row[2];?></td>
                                               <td><?php echo $row[3];?></td>
                                               <td><center><input type='checkbox' class='seleccione_cola' id="tres<?php echo $k; ?>"/></center></td></td>
                                               </tr> 
                                               <?php 
                                               $k++;
                                                 }
                                              ?>  
                                              </tbody>
                                             </table>                                           