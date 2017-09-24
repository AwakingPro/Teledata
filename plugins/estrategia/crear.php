<?PHP
$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);

//<------------------------------Consulta Tablas Vacias------------------------------->
$query_count=mysql_query("SELECT nombre FROM SIS_Tablas");
$count=mysql_num_rows($query_count);
$query=mysql_query("SELECT nombre FROM SIS_Tablas");
while($row=mysql_fetch_array($query))
    {
        $tabla=$row[0];
        $query_tablas=mysql_query("SELECT * FROM $tabla");
        if(mysql_num_rows($query_tablas)==0)
            {
                mysql_query("UPDATE SIS_Tablas SET view=0 WHERE nombre='$tabla'");
            }
        else
            {
                mysql_query("UPDATE SIS_Tablas SET view=1 WHERE nombre='$tabla'");
            }
    }
//<------------------------------Consulta Tablas Vacias------------------------------->
$sql="SELECT * FROM SIS_Tablas WHERE view=1 order by id asc";
$res=mysql_query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teledata</title>
    <!--STYLESHEET-->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/nifty.min.css" rel="stylesheet">
    <link href="../premium/icon-sets/solid-icons/premium-solid-icons.min.css" rel="stylesheet">
    <link href="../plugins/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../plugins/themify-icons/themify-icons.min.css" rel="stylesheet">
    <link href="../css/demo/nifty-demo-icons.min.css" rel="stylesheet">
    <link href="../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../plugins/animate-css/animate.min.css" rel="stylesheet">
    <link href="../plugins/switchery/switchery.min.css" rel="stylesheet">
    <link href="../plugins/morris-js/morris.min.css" rel="stylesheet">
    <link href="../css/demo/nifty-demo.min.css" rel="stylesheet">
    <link href="../plugins/pace/pace.min.css" rel="stylesheet">
    <script src="../plugins/pace/pace.min.js"></script>
    <link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
    <link href="../css/teledata.css" rel="stylesheet">
    <style type="text/css">
    .select1 
             { 
        width: 100%;
        height: 30px;
        border: solid;
        border-color: #ccc;
        background-color: #CEECF5;

             }   
    .select2 
            { 
        width: 100%;
        height: 30px;
        border: solid;
        border-color: #ccc;
        background-color: #CCC;

            }  
    .text1 
            { 
        width: 100%;
        height: 30px;
        border: solid;
        border-color: #ccc;
        background-color: #CEECF5;

            }  
    .text2 
            { 
        width: 100%;
        height: 30px;
        border: solid;
        border-color: #ccc;
        background-color: #CCC;

            } 
    .mostrar_condiciones
           {
            display: none;
           }  
    #midiv100
           {
            display: none;
           }

    #oculto
           {
            display: none;
           }  
    #guardar
           {
            display: none;
           }       
    #folder
           {
            display: none;
           } 
    .modal {
            display:    none;
            position:   fixed;
            z-index:    1000;
            top:        0;
            left:       0;
            height:     100%;
            width:      100%;
            background: rgba( 255, 255, 255, .8 ) 
            url('../img/gears.gif') 
            50% 50% 
            no-repeat;
            }
body.loading 
           {
            overflow: hidden;   
           }     
body.loading .modal 
          {
           display: block;
          }
                    
    </style>       
</head>
<body>

    <div id="container" class="effect mainnav-sm">
        
        <!--NAVBAR-->
        <!--===================================================-->
        <header id="navbar">
            <div id="navbar-container" class="boxed">

                <!--Logo-->
                <div class="navbar-header">
                    <a href="../index.php" class="navbar-brand">
                        <img src="../img/logo.png" alt="Nifty Logo" class="brand-icon">
                        <div class="brand-title">
                            <span class="brand-text">Foco Estrategico</span>
                        </div>
                    </a>
                </div>
                <!--End Logo-->

                <!--Navbar Dropdown-->
                <!--================================-->
                <div class="navbar-content clearfix">
                    <ul class="nav navbar-top-links pull-left">

                        <!--Navigation toogle button-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <li class="tgl-menu-btn">
                            <a class="mainnav-toggle" href="#">
                                <i class="pli-view-list"></i>
                            </a>
                        </li>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End Navigation toogle button-->

                        <!--Notification dropdown-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                <i class="pli-bell"></i>
                                <span class="badge badge-header badge-danger"></span>
                            </a>

                            <!--Notification dropdown menu-->
                            <div class="dropdown-menu dropdown-menu-md">
                                <div class="pad-all bord-btm">
                                    <p class="text-lg text-semibold mar-no">Tienes Nuevas Notificaciones</p>
                                </div>
                                <div class="nano scrollable">
                                    <div class="nano-content">
                                        <ul class="head-list">
                                      
                                        </ul>
                                    </div>
                                </div>

                                <!--Dropdown footer-->
                                <div class="pad-all bord-top">
                                    <a href="#" class="btn-link text-dark box-block">
                                        <i class="fa fa-angle-right fa-lg pull-right"></i>Ver Todas las Notificaciones
                                    </a>
                                </div>
                            </div>
                        </li>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End notifications dropdown-->
                    </ul>
                    <ul class="nav navbar-top-links pull-right">

                        <!--Language selector-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <li class="dropdown">
                            <a id="demo-lang-switch" class="lang-selector dropdown-toggle" href="#" data-toggle="dropdown">
                                <span class="lang-selected">
                                    <img class="lang-flag" src="../img/flags/spain.png" alt="Español">
                                </span>
                            </a>

                            <!--Language selector menu-->
                            <ul class="head-list dropdown-menu">
						        <li>
						            <!--English-->
						            <a href="#" class="active">
						                <img class="lang-flag" src="../img/flags/united-kingdom.png" alt="English">
						                <span class="lang-id">EN</span>
						                <span class="lang-name">English</span>
						            </a>
						        </li>
						        <li>
						            <!--France-->
						            <a href="#">
						                <img class="lang-flag" src="../img/flags/france.png" alt="France">
						                <span class="lang-id">FR</span>
						                <span class="lang-name">Fran&ccedil;ais</span>
						            </a>
						        </li>
						        <li>
						            <!--Germany-->
						            <a href="#">
						                <img class="lang-flag" src="../img/flags/germany.png" alt="Germany">
						                <span class="lang-id">DE</span>
						                <span class="lang-name">Deutsch</span>
						            </a>
						        </li>
						        <li>
						            <!--Italy-->
						            <a href="#">
						                <img class="lang-flag" src="../img/flags/italy.png" alt="Italy">
						                <span class="lang-id">IT</span>
						                <span class="lang-name">Italiano</span>
						            </a>
						        </li>
						        <li>
						            <!--Spain-->
						            <a href="#">
						                <img class="lang-flag" src="../img/flags/united-kingdom.png" alt="English">
						                <span class="lang-id">EN</span>
						                <span class="lang-name">English</span>
						            </a>
						        </li>
                            </ul>
                        </li>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End language selector-->



                        <!--User dropdown-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <li id="dropdown-user" class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                                <span class="pull-right">
                                    <img class="img-circle img-user media-object" src="../img/av1.png" alt="Profile Picture">
                                </span>
                                <div class="username hidden-xs">Luis Ponce</div>
                            </a>


                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right panel-default">

                                <!-- Dropdown heading  -->
                           


                                <!-- User dropdown menu -->
                                <ul class="head-list">
                                    <li>
                                        <a href="#">
                                            <i class="pli-male icon-lg icon-fw"></i> Perfil
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="badge badge-danger pull-right">9</span>
                                            <i class="pli-mail icon-lg icon-fw"></i> Mensajes
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="pli-gear icon-lg icon-fw"></i> Configuración
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="pli-information icon-lg icon-fw"></i> Ayuda
                                        </a>
                                    </li>
                          
                                </ul>

                                <!-- Dropdown footer -->
                                <div class="pad-all text-right">
                                    <a href="login.php" class="btn btn-primary">
                                        <i class="pli-unlock"></i> Salir
                                    </a>
                                </div>
                            </div>
                        </li>
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End user dropdown-->

                    </ul>
                </div>
                <!--================================-->
                <!--End Navbar Dropdown-->

            </div>
        </header>
        <!--===================================================-->
        <!--END NAVBAR-->

        <div class="boxed">

            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                
                <!--Page Title-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <div id="page-title">

                    <!--Searchbox-->
            
                </div>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End page title-->


                <!--Breadcrumb-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <ol class="breadcrumb">
                    <li><a href="#">Estrategia</a></li>
                    <li class="active">Crear Estrategia</li>
                </ol>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->


        

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">

					<div class="row">
						<div class="eq-height">

					
							<div class="col-sm-3 eq-box-sm">
					
								<!--Panel with Header-->
								<!--===================================================-->
                                <div class="panel" id='padre'>
									<div class="panel-heading">
									 <h2 class="panel-title"> <i class="fa fa-pagelines"></i> Árbol de Decisión</h2>
									</div>
									<div class="panel-body">
                                        <form name="form1"  id='form1' autocomplete="off" method='POST' action="ver.php">
                                        <!--Nivel-->
                                        <div id="id_clases"><input type='hidden' value='1' id='id_clase' name='id_clase'></div>
                                        <div id="divnivel"><input type="hidden" value="0" id="nivel" name="nivel"></div>
                                        <div id="clasesnivel"><input type="hidden" value="1" id="id_clases" name="id_clases"></div>

                                        <div id="estrategia"></div>

                                        <div id="midiv200">
                                        <div class="alert alert-warning fade in">
                                        Registros :  <?php  $query=mysql_query("SELECT * FROM Persona");

                                           while($row2=mysql_fetch_array($query)){
                                          $a=$row2['Rut'];
                                             }

                                         $numero = mysql_num_rows($query);
                                        echo $numero = number_format($numero, 0, "", ".");
                                         ?><br>
                                        Monto : <?php $monto2=mysql_query("SELECT * FROM Deuda");  
                                        while($row=mysql_fetch_assoc($monto2)){
                                        $monto_2= $monto_2 + $row['Monto_Mora'];
                                        }
                                        echo $monto_2 = '$  '.number_format($monto_2, 0, "", "."); ?>
                                        <!--End Nivel-->    
                                        <!--Tabla-->  
                                        </div>
                                        </div>
                                        <div id="midiv101">
                                        </div>
                                         <div id="midiv99"> 
                                          <select  disabled="disabled" class="select2">
                                             <option value="">Seleccione Tabla</option>                                                   
                                         </select><br><br>

                                        </div>
                                        <div id="midiv100">

                                        <select name="tablas" id="tablas"  class="select1">
				                            <option value="0"><center>Seleccione Tabla</center></option>
				                            <?php while ($fila=mysql_fetch_array($res)){ ?>
					                        <option value="<?php echo $fila['id']?>"><center><?php echo $fila['nombre']?></center></option>
				                        <?php } ?>					
		                                </select>	<br><br>
                                        </div>
                                        <!--End Tabla-->
                                        <!--Columna-->
                                    <div id="midiv"> 
                                        <select name="tablas" id="tablas"  disabled="disabled" class="select2">
	                                         <option value="">Seleccione Columna</option>                           	                    
                                        </select>
                                    </div>
                                    <!--End Columna-->
                                    <!--Logica-->
                                    <br>
                                    <div id="midiv2">
			                            <select  class="select2" disabled="disabled">	 
	                                        <option value="">Seleccione Lógica</option>             	                    
                                        </select>
                                    </div>
                                    <!--End Logica-->
                                    <!--Valor-->
                                    <br>
                                    <div id="midiv3">
			                            <input type="text" value="  Ingrese Valor" disabled="disabled" class="text2" >			
	                                </div>
                                    <!--End Valor-->
                                   
                                    <div id="midiv4">
                                    <br /><input type="text" id="nombre_nivel" value="  Nombre Cola" class="text2" name="nombre_nivel" disabled="disabled">
	                                </div>
                                     <div id="midiv5">
                                     <br><input type="submit" disabled="disabled" value="Crear Consulta " class="btn btn-primary btn-block" >
	                                </div>
                                    </form>
								  </div>
								</div>
                          
								<!--===================================================-->
								<!--End Panel with Header-->
					
							</div>
					
								<!--Panel with Header-->
								<!--===================================================-->
							<div class="col-sm-9 eq-box-sm">	
                                                                <div id="contenedor"></div>

                                <div id="mostrar_estrategia">
                                    <div class="panel" id='sql'>
                                            <div class="panel-heading">
                                              <h2 class="panel-title"> <i class="fa fa-pencil-square-o"></i> Nueva Estrategia</h2>
                                            </div>
                                                <div class="panel-body">
                                                 <form id="crear_estrategia" autocomplete="off" name="crear_estrategia" action="#" method="POST">
                                                    <div class="row">
                                                        <div class="col-sm-3">
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
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                             <label class="control-label">Nombre Estrategia</label>
                                                             <input type="text" name="nombre_estrategia" id="nombre_estrategia" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                             <label class="control-label">Comentario</label>
                                                             <input type="text" name="comentario_estrategia" id="comentario_estrategia" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>       
                                                    <div class="row">       
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                             <input type="submit" class="btn btn-primary btn-block" value="Crear Estrategia"> 
                                                            </div>
                                                        </div>
                                                    </div> 
                                                 </form>
                                                </div> 
                                    
                                    </div>

                                </div>

                                <div class="mostrar_condiciones">
                                        <div class="panel" id='sql'>
    									    <div class="panel-heading">
    										  <h3 class="panel-title"><div id="titulo_condiciones"></div></h3>
    									    </div>
                                            <div class="panel-body">
                                            <div class="mostrar">
                                            <i class="ti-server"></i> Realice Consulta a la Base de datos.
                                            </div>
                                            <div class="oculto">
    							              <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
    								           <thead>
    									        <tr>
        										 <th>Nombre de la Cola</th>
                                                 <th class="min-desktop"><center>Cantidad de Registros</center></th>
                                                 <th class="min-desktop"><center>Monto</center></th>
        										 <th class="min-desktop"><center>Opciones</center></th>
                                                 <th class="min-desktop"><center>Terminal</center></th>
    									        </tr>
    								           </thead>
    								          <tbody>
    									       <tr>
    									       </tr>	
    								          </tbody>
    							             </table>
                                          
                                            </div>
                                            <div id='guardar'>
                                             <div class="col-sm-3">
                                            <form action="#" method="POST" name="refrescar" id="refrescar">
                                             <input type="submit" class="btn btn-primary btn-block col-sm-3" value="Guardar Estrategia">
                                             </form>
                                             </div>
                                             </div>
                                        </div>
                                        </div>
                                    
                                </div>
                              
								<!--===================================================-->
								<!--End Panel with Header-->
					
							</div>
						</div>
					</div>               					        
                </div>
                <!--===================================================-->
                <!--End page content-->


            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->


            
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
						                <a href="index.html">
						                    <i class="psi-home"></i>
						                    <span class="menu-title">
												<strong>Inicio</strong>
											</span>
						                </a>
						            </li>
						
						            <!--Menu list item-->
						            <li>
						                <a href="#">
						                    <i class="psi-knight"></i>
						                    <span class="menu-title">
												<strong>Estrategia</strong>
											</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse in">
						                    <li class="active-link"><a href="#">Crear Estrategia</a></li>
											<li><a href="#">Estrategias Guardadas</a></li>
											
											
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
						            <li>
						                <a href="#">
						                    <i class="psi-eye"></i>
						                    <span class="menu-title">Búsqueda Deudores</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <li><a href="#">Submenu</a></li>
							
											
						                </ul>
						            </li>
                                    <li>
						                <a href="#">
						                    <i class="psi-bar-chart-4"></i>
						                    <span class="menu-title">Reportería</span>
											<i class="arrow"></i>
						                </a>
						
						                <!--Submenu-->
						                <ul class="collapse">
						                    <li><a href="#">Submenu</a></li>
	
											
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


                            </div>
                        </div>
                    </div>
                    <!--================================-->
                    <!--End menu-->

                </div>
            </nav>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->
            

        </div>
        <!-- FOOTER -->
        <!--===================================================-->
        <footer id="footer">
            <!-- Visible when footer positions are fixed -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <div class="show-fixed pull-right">
                <ul class="footer-list list-inline">
                </li>
                </ul>
            </div>

        </footer>
        <!--===================================================-->
        <!-- END FOOTER -->
        <!-- SCROLL TOP BUTTON -->
        <!--===================================================-->
        <button id="scroll-top" class="btn"><i class="fa fa-chevron-up"></i></button>
        <div class="modal"><!-- Place at bottom of page --></div>
        <!--===================================================-->
    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->
    <!--JAVASCRIPT-->
    <script src="../js/jquery-2.2.1.min.js"></script>
    <script src="../js/funciones.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../plugins/fast-click/fastclick.min.js"></script>
    
	<script src="../plugins/morris-js/morris.min.js"></script>
    <script src="../plugins/morris-js/raphael-js/raphael.min.js"></script>
    <script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="../plugins/skycons/skycons.min.js"></script>
    <script src="../plugins/switchery/switchery.min.js"></script>
    <script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
    
    <script src="../plugins/bootbox/bootbox.min.js"></script>
    <script src="../js/demo/ui-alerts.js"></script>

</body>
</html>
