<?php 
$arrMenu = explode( ',' ,$_SESSION['idMenu']);
//$arrMenu = arrMenu ( ',' , $Nombre_Campos );

 ?>
            <!--MAIN NAVIGATION-->
            <!--===================================================-->
            <nav id="mainnav-container">
                <div id="mainnav">

                    <!--Shortcut buttons-->
                    <!--================================-->
                    <div id="mainnav-shortcut">
                        <ul class="list-unstyled">
                
                            <li class="col-xs-4" data-content="Page Alerts">
                               
                            </li>
                        </ul>
                    </div>
                    <!--================================-->
                    <!--End shortcut buttons-->


                    <!--Menu-->
                    <!--================================-->
                    <div id="mainnav-menu-wrap">
                        <div class="nano">
                            <div class="nano-content">
                                <ul id="mainnav-menu" class="list-group">
						
						            <!--Category name-->
						            <li class="list-header">Menú Principal</li>
						
						            <!--Menu list item-->
						            <li >
						                <a href="../index.php">
						                    <i class="psi-home"></i>
						                    <span class="menu-title">
												<strong>Inicio</strong>
											</span>
						                </a>
						            </li>
						
						            <!--Menu list item-->
						            <?php if($arrMenu[0] == "est"){
                                	echo "<li class='active-sub'>";} 
                                    else { ?> 
                                    <li>
                                	<?php } ?>
						                <a href="#">
						                    <i class="psi-knight"></i>
						                    <span class="menu-title">
												<strong>Estrategia</strong>
											</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse in">
						                    <?php if($arrMenu[1] == "ces"){
		                                	echo "<li class='active-link'>";} 
		                                    else { ?> 
		                                    <li>
		                                	<?php } ?>
						                    <a href="../estrategia/crear.php">Crear Estrategia</a>
						                    </li>
											<?php if($arrMenu[1] == "egu"){
		                                	echo "<li class='active-link'>";} 
		                                    else { ?> 
		                                    <li>
		                                	<?php } ?>
											<a href="../estrategia/estrategias.php">Estrategias Guardadas</a>
											</li>
                                            <?php if($arrMenu[1] == "ccf"){
		                                	echo "<li class='active-link'>";} 
		                                    else { ?> 
		                                    <li>
		                                	<?php } ?>
                                            <a href="../estrategia/categoria_fonos.php">Crear Categoria Fonos</a>
                                            </li>
                                            <?php if($arrMenu[1] == "cci"){
		                                	echo "<li class='active-link'>";} 
		                                    else { ?> 
		                                    <li>
		                                	<?php } ?>
                                            <a href="../estrategia/categoria_ivr.php">Crear Categoria IVR</a>
                                            </li>
                                            <?php if($arrMenu[1] == "cco"){
		                                	echo "<li class='active-link'>";} 
		                                    else { ?> 
		                                    <li>
		                                	<?php } ?>
                                            <a href="../estrategia/crear_categoria.php">Crear Color</a>
                                            </li>
											
											
						                </ul>
						            </li>
						
						            <!--Menu list item-->
		
						
						
						            <!--Category name-->
						
						            <!--Menu list item-->
		
						
						            <!--Menu list item-->
						            <li>
						                <a href="#">
						                    <i class="psi-pie-chart"></i>
						                    <span class="menu-title">Asignación</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <li><a href="#">Submenu</a></li>
					
											
						                </ul>
						            </li>
						
						            <!--Menu list item-->
						            <?php if($arrMenu[0] == "crm"){
                                	echo "<li class='active-sub'>";} 
                                    else { ?> 
                                    <li>
                                	<?php } ?>
						                <a href="#">
						                    <i class="psi-phone-2"></i>
						                    <span class="menu-title">CRM</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <?php if($arrMenu[1] == "vdi"){
		                                	echo "<li class='active-link'>";} 
		                                    else { ?> 
		                                    <li>
		                                	<?php } ?>
						                    <a href="../crm/index.php">Ventana Dial</a>
						                    </li>
							
											
						                </ul>
						            </li>
						             <?php if($arrMenu[0] == "gra"){
                                	echo "<li class='active-sub'>";} 
                                    else { ?> 
                                    <li>
                                	<?php } ?>
						                <a href="#">
						                    <i class="psi-bar-chart-4"></i>
						                    <span class="menu-title">Reportería</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <?php if($arrMenu[1] == "gra_son"){
		                                	echo "<li class='active-link'>";} 
		                                    else { ?> 
		                                    <li>
		                                	<?php } ?>
						                    <a href="../crm/index5.php">Reportes</a>
						                    </li>
							
											
						                </ul>
						            </li>
                                 
						          
                                    <li>
						                <a href="#">
						                    <i class="psi-coin"></i>
						                    <span class="menu-title">Comisiones</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <li><a href="#">Submenu</a></li>
						
						                </ul>
						            </li>
                                    <?php if($arrMenu[0] == "tar"){
                                	echo "<li class='active-sub'>";} 
                                    else { ?> 
                                    <li>
                                	<?php } ?>
						                <a href="#">
						                    <i class="fa fa-tasks"></i>
						                    <span class="menu-title">Tareas</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <?php if($arrMenu[1] == "pdt"){
		                                	echo "<li class='active-link'>";} 
		                                    else { ?> 
		                                    <li>
		                                	<?php } ?>
						                    <a href="../tareas/tareas.php">Panel de Tareas</a>
						                    </li>
						
						                </ul>
						            </li>
						            <?php if($arrMenu[0] == "cal"){
                                	echo "<li class='active-sub'>";} 
                                    else { ?> 
                                    <li>
                                	<?php } ?>
						                <a href="#">
						                    <i class="fa fa-check-square-o"></i>
						                    <span class="menu-title">Calidad</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <?php if($arrMenu[1] == "cal_son"){
		                                	echo "<li class='active-link'>";} 
		                                    else { ?> 
		                                    <li>
		                                	<?php } ?>
						                    <a href="../calidad/calidad.php">Evaluar</a>
						                    </li>
						
						                </ul>
						            </li>
                                    
                                	<?php if($arrMenu[0] == "adm"){
                                	echo "<li class='active-sub'>";} 
                                    else { ?> 
                                    <li>
                                	<?php } ?>
                                        
                                        <a href="#">
                                            <i class="fa fa-cogs"></i>
                                            <span class="menu-title">Administrador</span>
                                            <i class="arrow"></i>
                                        </a>
                        
                                        <!--Submenu-->
                                        <ul class="collapse">
                                        <?php if($arrMenu[1] == "cpg"){
		                                	echo "<li class='active-link'>";} 
		                                    else { ?> 
		                                    <li>
		                                <?php } ?>
                                            	<a href="../admin/conf_gestion.php">Conf. Pantalla Gestión</a>
                                            </li>
                        
                                        </ul>
                                    </li>

                            </div>
                        </div>
                    </div>
                    <!--================================-->
                    <!--End menu-->

                </div>
            </nav>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->
            

   