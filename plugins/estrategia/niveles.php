<select name="siguiente_nivel" class="LP2">
<option value="0">Terminal</option>
<?php 
$niveles_libres=mysql_query("SELECT * FROM nivel WHERE selector=0 ");
while ($row = mysql_fetch_row($niveles_libres)){
?>
<option value="<?php echo $row['1'];?>"><?php echo $row['1'];?></option>
<?php } ?>
</select>