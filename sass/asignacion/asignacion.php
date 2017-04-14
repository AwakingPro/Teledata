<?PHP
$conexion = mysql_connect("localhost" , "root" , "M9a7r5s3A");
mysql_select_db("foco",$conexion);
$sql="select * from SIS_Tablas order by id asc";
$res=mysql_query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foco | Software de Estrategia</title>
    <!--STYLESHEET-->
    <link href="../css/bootstrap.min.css" rel="stylesheet">


    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="../css/nifty.min.css" rel="stylesheet">

    <!--Nifty Premium Icon [ DEMO ]-->
    <link href="../css/demo/nifty-demo-icons.min.css" rel="stylesheet">

     <link href="../premium/icon-sets/solid-icons/premium-solid-icons.min.css" rel="stylesheet">
    <link href="../plugins/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../plugins/themify-icons/themify-icons.min.css" rel="stylesheet">
    <!--Font Awesome [ OPTIONAL ]-->
    <link href="../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">


    <!--Switchery [ OPTIONAL ]-->
    <link href="../plugins/switchery/switchery.min.css" rel="stylesheet">


    <!--Bootstrap Select [ OPTIONAL ]-->
    <link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">


    <!--Bootstrap Tags Input [ OPTIONAL ]-->
    <link href="../plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css" rel="stylesheet">


    <!--Chosen [ OPTIONAL ]-->
    <link href="../plugins/chosen/chosen.min.css" rel="stylesheet">


    <!--noUiSlider [ OPTIONAL ]-->
    <link href="../plugins/noUiSlider/nouislider.min.css" rel="stylesheet">


    <!--Bootstrap Timepicker [ OPTIONAL ]-->
    <link href="../plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">


    <!--Bootstrap Datepicker [ OPTIONAL ]-->
    <link href="../plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">


    <!--Dropzone [ OPTIONAL ]-->
    <link href="../plugins/dropzone/dropzone.css" rel="stylesheet">


    <!--Summernote [ OPTIONAL ]-->
    <link href="../plugins/summernote/summernote.min.css" rel="stylesheet">


    <!--Demo [ DEMONSTRATION ]-->
    <link href="../css/demo/nifty-demo.min.css" rel="stylesheet">




    <!--SCRIPT-->
    <!--=================================================-->

    <!--Page Load Progress Bar [ OPTIONAL ]-->
    <link href="../plugins/pace/pace.min.css" rel="stylesheet">
    <script src="../plugins/pace/pace.min.js"></script> 
    <style type="text/css">
    #mostrar_estrategia 
             { 
        display: none;
             }   
    #mostrar_cola
             { 
        display: none;
             }  
    #mostrar_gestor
             { 
        display: none;
             }  
    #mostrar_asignacion
             { 
        display: none;
             } 
    .select1 
             { 
        width: 100%;
        height: 30px;
        border: solid;
        border-top-width: thin;
        border-right-width: thin;
        border-bottom-width: thin;
        border-left-width: thin;
        border-color: #ccc;

             }  
    .select2 
            { 
        width: 100%;
        height: 30px;
        border: solid;
        border-color: #ccc;
        background-color: #CCC;

            } 
        .asignacion
             { 
        width: 100%;
        height: 30px;
        border: none;
        border-top-width: thin;
        border-right-width: thin;
        border-bottom-width: thin;
        border-left-width: thin;
        text-align: center;

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
                        <img src="img/logo.png" alt="Nifty Logo" class="brand-icon">
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
                                    <img class="img-circle img-user media-object" src="img/av1.png" alt="Profile Picture">
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
                            <div class="col-sm-12 eq-box-sm">
                                <div class="panel" id='padre'>
                                    <div class="panel-heading">
                                     <h2 class="panel-title"> Seleccione Tipo de Estrategia</h2>
                                    </div>
                                        <div class="panel-body">
                                         <div id="cambiar">

                                        <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                               <thead>
                                                <tr>
                                                 <th>ID Estrategia</th>
                                                 <th>Tipo de Estrategia</th>
                                                 <th><center>Seleccione</center></th>

                                                </tr>
                                               </thead>
                                              <tbody>
                                              <?php 
                                                $i = 1;
                                              $sql_estrategia = mysql_query("SELECT id,nombre FROM SIS_Tipo_Estrategia");
                                                while($row=mysql_fetch_array($sql_estrategia)){ ?>

                                              
                                               <tr id='<?php echo $i; ?>'>
                                               <td><?php echo $row[0];?></td>
                                               <td><?php echo $row[1];?></td>
                                    
                                               <td><center><input type='checkbox' id="uno<?php echo $i; ?>" class="seleccione_tipo"/></center></td></td>
                                               </tr> 
                                               <?php 
                                                 $i++;
                                                }
                                              ?>  
                                              </tbody>
                                             </table>
                                        </div>
                                        </div>
                                </div>
                            </div>
                        </div>                
					</div>      
                    <div id="mostrar_estrategia">         		
                    <div class="row">
                        <div class="eq-height">
                            <div class="col-sm-12 eq-box-sm">
                                <div class="panel" id='padre'>
                                    <div class="panel-heading">
                                     <h2 class="panel-title"> Seleccione Estrategia</h2>
                                    </div>
                                        <div class="panel-body">
                                        <div id="cambiar2">
                                        
                                             </div>
                                        </div>
                                </div>
                            </div>
                        </div>    
                     </div>   
                    <div id="mostrar_cola">               
                    <div class="row">
                        <div class="eq-height">
                            <div class="col-sm-12 eq-box-sm">
                                <div class="panel" id='padre'>
                                    <div class="panel-heading">
                                     <h2 class="panel-title"> Seleccione Cola</h2>
                                    </div>
                                        <div class="panel-body">
                                        <div id="cambiar3">
                                        
                                             </div>
                                        </div>
                                </div>
                            </div>
                        </div>                   
                    </div>  
</div>
                <div id="mostrar_gestor">               
                    <div class="row">
                        <div class="eq-height">
                            <div class="col-sm-12 eq-box-sm">
                                <div class="panel" id='padre'>
                                    <div class="panel-heading">
                                     <h2 class="panel-title"> Seleccione Gestor </h2>
                                    </div>
                                        <div class="panel-body">
                                        <div id="cambiar4">
                                        <div class="row">
                     
                                            <div class="col-sm-6">
                                                            <div class="form-group">
                                                           
                                                            <select class="select1" id="gestor"  name="gestor" data-width="100%">
                                                            <?php $sql_gestor=mysql_query("SELECT * FROM SIS_Gestor");
                                                            while($row=mysql_fetch_array($sql_gestor)){
                                                            ?>
                                                                <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                                                            <?php } ?>
                                                            </select>
                                                            </div>
                                                        </div>
                                                       <div class="col-sm-6">
                                                            <div class="form-group">
                                                            <div id="gestores_mostrar">
                                                            <select class="select2" disabled="disabled"  title="Seleccione" data-width="100%">
                                                            <option>Seleccionar</option>
                                                            </select>
                                                            </div>
                                                            </div>
                                                        </div>
                                                       
</div>  
                                       </div>
                                        </div>
                                </div>
                            </div>
                        </div>                   
                    </div>  
                </div>
                    </div>
                <form action="#" method="POST" id='formulario_asignacion'>

                <div id="mostrar_asignacion">               
                    <div class="row">
                        <div class="eq-height">
                            <div class="col-sm-12 eq-box-sm">
                                <div class="panel" >
                                    <div class="panel-heading">
                                     <h2 class="panel-title"> % Asignación y Champion Challenger</h2>
                                    </div>
                                        <div class="panel-body">
                                        <div id="cambiar5">

                                        <table id="demo-dt-basic10" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                               <thead>
                                                <tr>
                                                 <th>Gestor</th>
                                                 <th class="min-desktop"><center>% Asignación</center></th>
                                                 <th class="min-desktop"><center>Fecha Asignación</center></th>
                                                 <th class="min-desktop"><center>Fecha Desasignación</center></th>
                                                 <th class="min-desktop"><center>Acciones</center></th>

                                                </tr>
                                               </thead>
                                              <tbody>
                                                                                       
                                              </tbody>
                                             </table>
                                             <input type="button" name="smt" id='smt' class='btn btn-primary btn-block' > 
                                           
                                             </div>
                                        </div>
                                </div>
                            </div>
                        </div>                   
                    </div> 
                        </form>   
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
    <script src="../js/funciones_asignacion.js"></script>
    
     <script src="../js/bootstrap.min.js"></script>


    <!--Fast Click [ OPTIONAL ]-->
      <script src="../plugins/fast-click/fastclick.min.js"></script>

    
    <!--Nifty Admin [ RECOMMENDED ]-->
    <script src="../js/nifty.min.js"></script>


    <!--Switchery [ OPTIONAL ]-->
    <script src="../plugins/switchery/switchery.min.js"></script>


    <!--Bootstrap Select [ OPTIONAL ]-->
    <script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>


    <!--Bootbox Modals [ OPTIONAL ]-->
    <script src="../plugins/bootbox/bootbox.min.js"></script>


    <!--Demo script [ DEMONSTRATION ]-->
    <script src="../js/demo/nifty-demo.min.js"></script>


    <!--Modals [ SAMPLE ]-->
    <script src="../js/demo/ui-modals.js"></script>
        <script src="../js/demo/form-component.js"></script>

</body>
</html>
