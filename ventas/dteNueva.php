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
    <link href="../plugins/animate-css/animate.min.css" rel="stylesheet">
    <link href="../plugins/switchery/switchery.min.css" rel="stylesheet">
    <link href="../plugins/morris-js/morris.min.css" rel="stylesheet">
    <link href="../css/demo/nifty-demo.min.css" rel="stylesheet">
    <link href="../plugins/pace/pace.min.css" rel="stylesheet">
    <script src="../plugins/pace/pace.min.js"></script>
    <link href="../plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
    <link href="../css/themes/type-a/theme-mint.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">

    <style type="text/css">
        #navbar .brand-title {
            padding: 0 1.5em 0 5px;
        }
        .select1{
            width: 100%;
            height: 30px;
            border: solid;
            border-color: #ccc;
            border-width: thin;
            background-color: #FFF;
        }
        #DivRojo{
            border-style: solid;
            border-color:red;
        }
        .form-control {
            font-size: 12px;
            height: 100%;
            border-radius: 0;
            box-shadow: none;
            border-top:none;
            border-left:none;
            border-right:none;
            transition-duration: .5s;
        }
    </style>
</head>
<body>
<div id="container" class="effect mainnav-lg">


    <?php
    include("../layout/header.php");
    ?>
    <div class="boxed">
        <div id="content-container">
            <div id="page-title">
            </div>
            <br>
            <ol class="breadcrumb">
                <li><a href="#">Módulo Ventas</a></li>
                <li class="active">Nueva Venta</li>
            </ol>
            <div id="page-content">
                <div class="panel">
                    <div class="panel-heading">
							<h3 class="panel-title bg-mint">Nueva Venta </h3>
						</div>
                    <div class="panel-body ">

                        <div class="row">
                            <div class="col-sm-5">
                                <div class="col-md-12">
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="name">Nombre : </label>
                                            <div class="col-md-10" lateral>

                                                <select   class="selectpicker" data-live-search="true" data-width="100%" id="SeleccioneCliente" >
                                                    <?php
                                                        $Query  = mysql_query("SELECT rut,nombre FROM PersonaEmpresa");
                                                        while($row=mysql_fetch_array($Query)){
                                                            $Rut = $row[0];
                                                            $Nombre = $row[1];
                                                            echo "<option value='$Rut'>".utf8_encode($Nombre)."</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="name">Giro :</label>
                                            <div class="col-md-10" lateral>
                                                <input type="text" id="Giro" class="form-control input-md "/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label" for="name">Dirección : </label>
                                            <div class="col-md-10" lateral>
                                                <input id="Direccion" type="text" class="form-control input-md "/>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="col-md-12">
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="name">Fecha : </label>
                                            <div class="col-md-9" lateral>
                                                <input id="Descripcion" type="text" class="form-control input-md "/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="name">Contacto :</label>
                                            <div class="col-md-9" lateral>
                                                <input id="Contacto" type="text" class="form-control input-md "/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="name">CI: </label>
                                            <div class="col-md-9" lateral>
                                                <input id="Descripcion" type="text" class="form-control input-md "/>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-4">

                                    <div class="col-md-12">
                                         <div id="DivRojo">
                                        <form class="form-horizontal">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="name">Rut : </label>
                                                <div class="col-md-8" lateral>
                                                    <input id="Rut" type="text"  class="form-control input-md "/>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="name">Tipo : </label>
                                                <div class="col-md-8" lateral>
                                                    <select   class="select1" id="SeleccioneFactura">
                                                        <option value='0'>FACTURA ELECTRONICA</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="name">N° : </label>
                                                <div class="col-md-8" lateral>
                                                    <input id="Descripcion" type="text" value="No Asignado" class="form-control input-md "/>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <br>
                            <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th></th>
                                        <th><span class="text-xs"><center>CODIGO</center></span></th>
										<th><span class="text-xs"><center>PRODUCTO</center></span></th>
										<th class="min-tablet "><span class="text-xs"><center>CANTIDAD</center></span></th>
										<th class="min-tablet"><span class="text-xs"><center>UNIDAD</center></span></th>
										<th class="min-desktop"><span class="text-xs"><center>PRECIO</center></span></th>
										<th class="min-desktop"><span class="text-xs"><center>DSCTO O RECARGO</center></span></th>
                                        <th class="min-desktop"><span class="text-xs"><center>IMPTO RETENCION</center></span></th>
                                        <th class="min-desktop"><span class="text-xs"><center>INDIC. EXENCIÓN</center></span></th>
                                        <th class="min-desktop"><span class="text-xs"><center>TOTAL</center></span></th>
									</tr>
								</thead>
								<tbody>
                                    <?php
                                    $j=2;
                                    $i=0;
                                    while($i<$j){


                                    ?>
									<tr>
                                        <td><i class=' fa fa-plus-square'></i></td>
										<td>
                                            <span class="text-xs">
                                            <select   class="select1" id="SeleccioneFactura">
                                                <option value='0'>0015</option>
                                            </select>
                                            </span>
                                        </td>
										<td>
                                            <span class="text-xs">
                                                <select   class="select1" id="SeleccioneFactura">
                                                    <option value='0'>Insternet</option>
                                                    <option value='0'>Arriedo Equipos De Datos</option>
                                                </select>
                                            </span>
                                        </td>
										<td>
                                            <span class="text-xs">
                                                <input type="text" style="text-align:right; padding-right:10px;" value='0' class="select1">
                                            </span>
                                        </td>
										<td>
                                            <span class="text-xs">
                                                <select   class="select1" id="SeleccioneFactura">
                                                    <option value='0'>UNIDAD</option>
                                                    <option value='0'>M2</option>
                                                    <option value='0'>M3</option>
                                                    <option value='0'>KG</option>
                                                    <option value='0'>LT</option>
                                                    <option value='0'>UF</option>
                                                </select>
                                            </span>
                                        </td>
										<td>
                                            <span class="text-xs">
                                                <input type="text" style="text-align:right; padding-right:10px;" value='0' class="select1">
                                            </span>
                                        </td>
										<td>
                                            <span class="text-xs">
                                                <input type="text" style="text-align:right; padding-right:10px;" value='0' class="select1">
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-xs">
                                                <input type="text"  style="text-align:right; padding-right:10px;" value='0' class="select1">
                                            </span>
                                        </td>
										<td>
                                            <span class="text-xs">
                                                <select   class="select1" id="SeleccioneFactura">
                                                    <option value='0'>AFECTO</option>
                                                    <option value='0'>EXCENTO</option>
                                                </select>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-xs">
                                                <input type="text" style="text-align:right; padding-right:10px;" value='0' class="select1" value="0">
                                            </span>
                                        </td>

									</tr>
                                    <?php
                                    $i++;
                                    }
                                    ?>

									<tr>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none; background-color:#FFFFFF;"></td>
										<td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none; background-color:#FFFFFF;"></td>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none; background-color:#FFFFFF;"></td>
										<td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none; background-color:#FFFFFF;"></td>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
										<td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
										<td >Neto</td>
										<td ><span class="text-xs">
                                                <input type="text" style="text-align:right; padding-right:10px;" value='0' class="select1">
                                            </span></td>
									</tr>
                                    <tr>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none; background-color:#FFFFFF;"></td>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none; background-color:#FFFFFF;"></td>
										<td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
										<td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
										<td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
										<td >Exento</td>
										<td ><span class="text-xs">
                                                <input type="text" style="text-align:right; padding-right:10px;" value='0' class="select1">
                                            </span></td>
									</tr>
                                    <tr>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none; background-color:#FFFFFF;"></td>
										<td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none; background-color:#FFFFFF;"></td>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
										<td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
										<td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
										<td >I.V.A.</td>
										<td ><span class="text-xs">
                                                <input type="text" style="text-align:right; padding-right:10px;" value='0' class="select1">
                                            </span></td>
									</tr>
                                    <tr>
        							    <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none; background-color:#FFFFFF;"></td>
										<td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none; background-color:#FFFFFF;"></td>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
										<td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
										<td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
										<td >Imptos/Retenciones</td>
										<td ><span class="text-xs">
                                                <input type="text" style="text-align:right; padding-right:10px;" value='0' class="select1">
                                            </span></td>
									</tr>
                                    <tr>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none; background-color:#FFFFFF;"></td>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none; background-color:#FFFFFF;"></td>
										<td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
										<td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
										<td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
                                        <td style="visibility: hidden; border-right:none;border-left:none;border-bottom:none;border-top:none"></td>
										<td >Total</td>
										<td ><span class="text-xs">
                                                <input type="text" style="text-align:right; padding-right:10px;" value='0' class="select1">
                                            </span></td>
									</tr>


								</tbody>
							</table>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-6">
                                </div>

                                <div class="col-md-3">
                                    <button class="btn btn-mint col-sm-12 "  id="buscar">Guardar </button>

                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-danger col-sm-12 " id="buscar">Cancelar</button>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php include("../layout/main-menu.php"); ?>
    </div>
        <?php include("../layout/footer.php"); ?>
</div>

<script src="../js/jquery-2.2.1.min.js"></script>
<script src="../js/clientes/dte.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../plugins/fast-click/fastclick.min.js"></script>
<script src="../js/nifty.min.js"></script>
<script src="../plugins/morris-js/morris.min.js"></script>
<script src="../plugins/morris-js/raphael-js/raphael.min.js"></script>
<script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
<script src="../plugins/skycons/skycons.min.js"></script>
<script src="../plugins/switchery/switchery.min.js"></script>
<script src="../plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="../js/demo/nifty-demo.min.js"></script>
<script src="../plugins/bootbox/bootbox.min.js"></script>
<script src="../js/demo/ui-alerts.js"></script>
<script src="../js/global/funciones-global.js"></script>
<script src="../js/demo/ui-modals.js"></script>
<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
</body>
</html>