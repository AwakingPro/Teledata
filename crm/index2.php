
<?PHP 
require_once('../db/db.php'); 
include("../class/crm/crm.php");

$id_rut = $_GET['id_rut'];
$next = $_GET['next'];


if($next == 1)
{
    $query = mysql_query("SELECT id, Rut FROM COLA_ASDASD WHERE  id = $id_rut + 1 ");
    while($row = mysql_fetch_array($query))
    {
        $nuevo_id = $row[0];
        $nuevo_rut = $row[1];
    }    
}
else if($next == 2)
{
    if(($id_rut-1)==0)
    {
        $query = mysql_query("SELECT id, Rut FROM COLA_ASDASD LIMIT 1 ");
        while($row = mysql_fetch_array($query))
        {
            $nuevo_id = $row[0];
            $nuevo_rut = $row[1];
        }  
    }
    else
    {    
        $query = mysql_query("SELECT id, Rut FROM COLA_ASDASD WHERE  id = $id_rut - 1 ");
        while($row = mysql_fetch_array($query))
        {
            $nuevo_id = $row[0];
            $nuevo_rut = $row[1];
        }
    }   
}
else if(empty($next))
{
    $query = mysql_query("SELECT id, Rut FROM COLA_ASDASD LIMIT 1 ");
    while($row = mysql_fetch_array($query))
    {
        $nuevo_id = $row[0];
        $nuevo_rut = $row[1];
    }   
}



?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foco | Software de Estrategia</title>
    <!--STYLESHEET-->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/nifty.min.css" rel="stylesheet">
    <link href="../premium/icon-sets/solid-icons/premium-solid-icons.min.css" rel="stylesheet">
    <link href="../plugins/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../plugins/themify-icons/themify-icons.min.css" rel="stylesheet">
    <link href="../css/demo/nifty-demo-icons.min.css" rel="stylesheet">
    <link href="../plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../premium/icon-sets/line-icons/premium-line-icons.css" rel="stylesheet">
    <link href="../premium/icon-sets/solid-icons/premium-solid-icons.min.css" rel="stylesheet">

    <link href="../plugins/animate-css/animate.min.css" rel="stylesheet">
    <link href="../plugins/switchery/switchery.min.css" rel="stylesheet">
    <link href="../plugins/morris-js/morris.min.css" rel="stylesheet">
    <link href="../css/demo/nifty-demo.min.css" rel="stylesheet">
    <link href="../plugins/pace/pace.min.css" rel="stylesheet">
    <script src="../plugins/pace/pace.min.js"></script>
    <link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
    
    <style type="text/css">
    .select1 
    { 
        width: 100%;
        height: 30px;
        border: solid;
        border-color: #ccc;
        border-width: thin;
        background-color: #FFF;
    }   
    .select2 
    { 
        width: 100%;
        height: 30px;
        border: solid;
        border-color: #ccc;
        border-width: thin;
        background-color: #F6F6F6;
    }  

    #oculto
    {
        display: none;
    } 
    #colas_mostrar
    {
        display: none;
    } 
    #colas_mostrar2
    {
        display: none;
    }  
    #mostrar_rut
    {
        display: none;
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
                    <a href="index.php" class="navbar-brand">
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
                       
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End notifications dropdown-->
                    </ul>
                    <ul class="nav navbar-top-links pull-right">

                        <!--Language selector-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        <!--End language selector-->



                        <!--User dropdown-->
                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                        
                        <li id="dropdown-user" class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                                <span class="pull-right">
                                    

                                </span>  
                            </a>
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
              
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End breadcrumb-->


        

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    <div class="row">
                        <div class="row">
                        <div class="col-lg-12">
                        <div class="panel" id="demo-panel-collapse" class="collapse in">
                            <div class="panel-body">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="sel1">Seleccione Cedente</label>
                                        <?php  
                                            $mostrarCedente = new crm();
                                            $mostrarCedente->mostrarCedente();
                                        ?>
                                    </div>
                                    <input type="hidden" id="prefijo"  name="prefijo" value="">
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="sel1">Seleccione Estategia</label>
                                        <div id="colas">
                                            
                                            <select class="select2" id="tipo_estrategia" disabled="disabled" name="tipo_estrategia" > 
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                        <div id="colas_mostrar">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="sel1">Seleccione Cola</label>
                                        <div id="colas2">
                                            
                                            <select class="select2" id="tipo_estrategia" disabled="disabled" name="tipo_estrategia" > 
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                        <div id="colas_mostrar2">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label class="control-label">&nbsp;</label><br>
                                        <center><button class="btn btn-primary btn-icon icon-lg fa fa-arrow-left" id="prev_rut" value=""></button>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label class="control-label">Rut</label>
                                        <div id="ocultar_rut">
                                        <input type="text" value="" disabled="disabled"  class="form-control">
                                        </div>
                                        <div id="mostrar_rut"></div>
                                    </div>
                                </div>
                                         <div class="col-sm-1">
                                            <div class="form-group">
                                                <label class="control-label">&nbsp;</label><br>
                                                <center><button class="btn btn-primary btn-icon icon-lg fa fa-arrow-right" id="next_rut" value=""></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</center>
                                            </div>
                                        </div>
                                         <div class="col-sm-2">
                                                            <div class="form-group">
                                                              <label for="sel1">Modo Discado</label>
                                                              <select class="select2" id="tipo_estrategia" name="tipo_estrategia" disabled="disabled">
                                                             <?php $result=mysql_query("SELECT id,nombre FROM SIS_Tipo_Estrategia ");
                                                             while($row=mysql_fetch_array($result)){
                                                             ?>
                                                            <option value="<?php echo $row[0];?>">Manual</option>
                                                              <?php }?>
                                                              </select>
                                                            </div>
                                                        </div>
                                        </div>

                                    </div>
                        </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="panel" id="demo-panel-collapse" class="collapse in">
                                        <div class="panel-heading">
                                            <h3 class="panel-title bg-info"><div id="mostrar_nombre"></div></h3>
                                        </div>
                                        <div class="panel-body">
                                        <div id="mostrar_rut2"></div>
                                       
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="panel" >
                    
                                <!--Panel heading-->
                                <div class="panel-heading bg-primary">
                                    <div class="panel-control ">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#demo-tabs-box-1" data-toggle="tab">Teléfonos</a></li>
                                            <li><a href="#demo-tabs-box-2" data-toggle="tab">Direcciones</a></li>
                                            <li><a href="#demo-tabs-box-3" data-toggle="tab">Correos</a></li>
                                            
                                        </ul>
                                    </div>
                                </div>
                    
                                <!--Panel body-->
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="demo-tabs-box-1">
                                        <div id="mostrar_fonos"></div>
                                           
                                        </div>
                                        <div class="tab-pane fade" id="demo-tabs-box-2">
                                            <div id="prueba"></div>
                                             <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-xs">Rut</th>
                                                            <th class="text-sm">Razón_Social</th>
                                                            <th class="text-sm">Tipo_Documento</th>
                                                            <th class="text-sm">Fecha_Documento</th>
                                                            <th class="text-sm">Numero_Documento</th>
                                                            <th class="text-sm">Fecha_Vencimiento</th>
                                                            <th class="text-sm">Estado</th>
                                                            <th class="text-sm">Tramo_Mora</th>
                                                            <th class="text-sm">Segmento</th>
                                                            <th class="text-sm">Dias_Credito</th>
                                                            <th class="text-sm">Monto_Deuda</th>
                                                            <th class="text-sm">Intereses_Mora</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-xs">76004689-2</td>
                                                            <td class="text-xs">EMPRESA</td>
                                                            <td class="text-xs">Factura</td>
                                                            <td class="text-xs">29-01-2016</td>
                                                            <td class="text-xs">FA00045507</td>
                                                            <td class="text-xs">29-04-2016</td>
                                                            <td class="text-xs">cancelado</td>
                                                            <td class="text-xs">Vigente</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                          
                                                        </tr>
                                                         <tr>
                                                            <td class="text-xs">76004689-2</td>
                                                            <td class="text-xs">EMPRESA</td>
                                                            <td class="text-xs">Factura</td>
                                                            <td class="text-xs">29-01-2016</td>
                                                            <td class="text-xs">FA00045507</td>
                                                            <td class="text-xs">29-04-2016</td>
                                                            <td class="text-xs">cancelado</td>
                                                            <td class="text-xs">Vigente</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                          
                                                        </tr>
                                                         <tr>
                                                            <td class="text-xs">76004689-2</td>
                                                            <td class="text-xs">EMPRESA</td>
                                                            <td class="text-xs">Factura</td>
                                                            <td class="text-xs">29-01-2016</td>
                                                            <td class="text-xs">FA00045507</td>
                                                            <td class="text-xs">29-04-2016</td>
                                                            <td class="text-xs">cancelado</td>
                                                            <td class="text-xs">Vigente</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                          
                                                        </tr>
                                                         <tr>
                                                            <td class="text-xs">76004689-2</td>
                                                            <td class="text-xs">EMPRESA</td>
                                                            <td class="text-xs">Factura</td>
                                                            <td class="text-xs">29-01-2016</td>
                                                            <td class="text-xs">FA00045507</td>
                                                            <td class="text-xs">29-04-2016</td>
                                                            <td class="text-xs">cancelado</td>
                                                            <td class="text-xs">Vigente</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                          
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div> 
                                            
                                        </div>
                                        <div class="tab-pane fade" id="demo-tabs-box-3">
                                             <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-xs">Rut</th>
                                                            <th class="text-sm">Razón_Social</th>
                                                            <th class="text-sm">Tipo_Documento</th>
                                                            <th class="text-sm">Fecha_Documento</th>
                                                            <th class="text-sm">Numero_Documento</th>
                                                            <th class="text-sm">Fecha_Vencimiento</th>
                                                            <th class="text-sm">Estado</th>
                                                            <th class="text-sm">Tramo_Mora</th>
                                                            <th class="text-sm">Segmento</th>
                                                            <th class="text-sm">Dias_Credito</th>
                                                            <th class="text-sm">Monto_Deuda</th>
                                                            <th class="text-sm">Intereses_Mora</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-xs">76004689-2</td>
                                                            <td class="text-xs">EMPRESA</td>
                                                            <td class="text-xs">Factura</td>
                                                            <td class="text-xs">29-01-2016</td>
                                                            <td class="text-xs">FA00045507</td>
                                                            <td class="text-xs">29-04-2016</td>
                                                            <td class="text-xs">cancelado</td>
                                                            <td class="text-xs">Vigente</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                          
                                                        </tr>
                                                         <tr>
                                                            <td class="text-xs">76004689-2</td>
                                                            <td class="text-xs">EMPRESA</td>
                                                            <td class="text-xs">Factura</td>
                                                            <td class="text-xs">29-01-2016</td>
                                                            <td class="text-xs">FA00045507</td>
                                                            <td class="text-xs">29-04-2016</td>
                                                            <td class="text-xs">cancelado</td>
                                                            <td class="text-xs">Vigente</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                          
                                                        </tr>
                                                         <tr>
                                                            <td class="text-xs">76004689-2</td>
                                                            <td class="text-xs">EMPRESA</td>
                                                            <td class="text-xs">Factura</td>
                                                            <td class="text-xs">29-01-2016</td>
                                                            <td class="text-xs">FA00045507</td>
                                                            <td class="text-xs">29-04-2016</td>
                                                            <td class="text-xs">cancelado</td>
                                                            <td class="text-xs">Vigente</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                          
                                                        </tr>
                                                         <tr>
                                                            <td class="text-xs">76004689-2</td>
                                                            <td class="text-xs">EMPRESA</td>
                                                            <td class="text-xs">Factura</td>
                                                            <td class="text-xs">29-01-2016</td>
                                                            <td class="text-xs">FA00045507</td>
                                                            <td class="text-xs">29-04-2016</td>
                                                            <td class="text-xs">cancelado</td>
                                                            <td class="text-xs">Vigente</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                            <td class="text-xs">Order #53431</td>
                                                          
                                                        </tr>
                                                    </tbody>
                                                </table>
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
						       
						
						            <!--Menu list item-->
						            
                                     <li>
                                        <a href="#" class="active-link">
                                            <i class="psi-phone-2" ></i>
                                            <span class="menu-title">CRM</span>
                                            <i class="arrow"></i>
                                        </a>
                        
                                        <!--Submenu-->
                                        <ul class="collapse in">
                                             <li class="active-link"><a href="index.php">Ventana Dial</a></li>
                        
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
    <script src="../js/crm/crm.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../plugins/fast-click/fastclick.min.js"></script>
    <script src="../js/nifty.min.js"></script>
	<script src="../plugins/morris-js/morris.min.js"></script>
    <script src="../plugins/morris-js/raphael-js/raphael.min.js"></script>
    <script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="../plugins/skycons/skycons.min.js"></script>
    <script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="../js/demo/nifty-demo.min.js"></script>
    <script src="../plugins/bootbox/bootbox.min.js"></script>
    <script src="../js/demo/ui-alerts.js"></script>
    <script src="../plugins/bootstrap-validator/bootstrapValidator.min.js"></script>
    <script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="../js/demo/ui-panels.js"></script>


    <!--Demo script [ DEMONSTRATION ]-->
    <script src="../js/demo/nifty-demo.min.js"></script>


    <!--Charts [ SAMPLE ]-->


</body>
</html>
