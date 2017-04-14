<?php
	require_once('../db/db.php'); 
	include("../class/admin/conf_gestion.php");

	$camposTabla = new ConfGestion();
    //$res= $camposTabla->listarCamposTabla("Deuda");

	//$Nomtabla=$_POST['b'];
    //$array_Campos = $campos->listarCamposTabla($Nomtabla);

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

	$camposTabla->listarCamposTabla("Deuda");
	//return $camposTabla;

	//echo json_encode($camposTabla, JSON_FORCE_OBJECT);

/*		if ($array_Campos > 0){
			?>
			 <?php foreach($array_Campos as $item): ?>
	                    <label><input type="checkbox"> <?php echo $item['Field'];?></label><br>
	                    <?php endforeach;   ?>
			
			<?php
			
		} else {
			?>
			<div class="alert alert-warning alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4>Aviso!!!</h4> No hay datos para mostrar
            </div>
			
			<?php
		}
*/

 ?>
