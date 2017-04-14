<?php 

$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);
$mensajes = mysql_query("SELECT * FROM mensajes WHERE status = 1");
                                            while($row = mysql_fetch_array($mensajes)){ ?>
                                             <li>
                                                <a href="#">
                                                    <div class="clearfix">
                                                        <p class="pull-left" id="demo-bootbox-confirm"> <?php echo $row[1];?></p>
                                                    </div>
                                                </a>                                               
                                            </li>
                                            <?php }?>