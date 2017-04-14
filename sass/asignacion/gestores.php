<?php 
$id_gestor=$_POST['id_gestor'];
$host_name = 'localhost';
$user_name = 'root';
$pass_word = 'M9a7r5s3A';
$database_name = 'foco';
$conn = mysql_connect($host_name, $user_name, $pass_word) or die ('Error connecting to mysql');
mysql_select_db($database_name);

?>

	 <select id="gestores"  class="select1" name="gestores" data-width="100%">
     <option>Seleccionar</option>
              <?php $sql_gestor=mysql_query("SELECT * FROM SIS_Gestores WHERE id_gestor=$id_gestor");
               while($row=mysql_fetch_array($sql_gestor)){
                                                            ?>
                <option value="<?php echo $row[2];?>"><?php echo $row[1];?></option>
                   
                  <?php } ?>
    </select>
	




