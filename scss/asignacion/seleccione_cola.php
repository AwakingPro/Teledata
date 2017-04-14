<?php
$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);
$id=$_POST['id'];
?>
<div class="row">
                     
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                              <label for="sel1">Tipo de Estrategia</label>
                                                              <select class="selectpicker" id="tipo_estrategia" name="tipo_estrategia" data-live-search="true" data-width="100%">
                                                             <?php $result=mysql_query("SELECT id,nombre FROM SIS_Tipo_Estrategia ");
                                                             while($row=mysql_fetch_array($result)){
                                                             ?>
                                                            <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                                                              <?php }?>
                                                              </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                             <label class="control-label">Nombre Estrategia</label>
                                                             <input type="text" name="nombre_estrategia" id="nombre_estrategia" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                             <label class="control-label">Comentario</label>
                                                             <input type="text" name="comentario_estrategia" id="comentario_estrategia" class="form-control">
                                                            </div>
                                                        </div>
</div>                                        