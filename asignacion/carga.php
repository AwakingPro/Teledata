<?php
$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion); ?>
<table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                               <thead>
                                                <tr>
                                                 <th>ID Estrategia</th>
                                                 <th>Nombre de la Estrategia</th>
                                                 <th class="min-desktop"><center>Credador</center></th>
                                                 <th class="min-desktop"><center>Hora</center></th>
                                                 <th class="min-desktop"><center>Fecha</center></th>
                                                 <th class="min-desktop"><center>Seleccionar</center></th>
                                                </tr>
                                               </thead>
                                              <tbody>
                                              <?php $sql_estrategia = mysql_query("SELECT id,nombre,usuario,hora,fecha FROM SIS_Estrategias");
                                                while($row=mysql_fetch_array($sql_estrategia)){ ?>

                                              
                                               <tr id='<?php echo $row[0]; ?>'>
                                               <td><?php echo $row[0];?></td>
                                               <td><?php echo $row[1];?></td>
                                               <td><?php echo $row[2];?></td>
                                               <td><?php echo $row[3];?></td>
                                               <td><?php echo $row[4];?></td>
                                               <td><center><input type='checkbox' class='seleccione_estrategia2'/></center></td></td>
                                               </tr> 
                                               <?php 
                                                 }
                                              ?>  
                                              </tbody>
                                             </table>