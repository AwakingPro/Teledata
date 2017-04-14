<?php 
$id_gestor=$_POST['id_gestor'];
$host_name = 'localhost';
$user_name = 'root';
$pass_word = 'M9a7r5s3A';
$database_name = 'foco';
$conn = mysql_connect($host_name, $user_name, $pass_word) or die ('Error connecting to mysql');
mysql_select_db($database_name);

?>
<html>
<head> 

</head>
<body>
	   <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                               <thead>
                                                <tr>
                                                 <th>ID Gestor</th>
                                                 <th>Nombre Gestor</th>
                                                 <th><center>Eliminar</center></th>

                                                </tr>
                                                 </thead>
                                                <tbody>
                                              <?php 
                                               
                                              $sql = mysql_query("SELECT id,nombre FROM SIS_Gestores WHERE seleccion=1");
                                                while($row=mysql_fetch_array($sql)){ ?>
                                               <tr id='<?php echo $row[0]; ?>'>
                                               <td><?php echo $row[0];?></td>
                                               <td><?php echo $row[1];?></td>
                                               <td><center><a href='#' class='eliminar_gestores'><i class='fa fa-close icon-lg' > </i></a></center></td>
                                               </tr> 
                                               <?php 
                                                }
                                              ?>  
                                              </tbody>
                                        </table>
	
</body>
</html>



