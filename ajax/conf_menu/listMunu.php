<?php
	require_once('../../class/methods_global/methods.php');
	$query = "SELECT
	menu.id_menu,
	menu.nombre,
	menu.descripcion,
	menu.enlace,
	menu.permisos,
	menu.icono
	FROM
	menu";
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {
		$list ='';
		for ($i=0; $i < count($data); $i++) {
			$list.= '  <div class="panel panel-default">
			    <div class="panel-heading" role="tab" id="headingTwo'.$i.'">
			      <h4 class="panel-title">
			        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo'.$i.'" aria-expanded="false" aria-controls="collapseTwo'.$i.'">
			          '.$data[$i][1].'
			        </a>
			        <i class="glyphicon glyphicon-trash pull-right iconItemsMenu"></i>
			        <i class="glyphicon glyphicon-edit pull-right iconItemsMenu"></i>
			      </h4>
			    </div>
			    <div id="collapseTwo'.$i.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo'.$i.'">
			      <div class="panel-body">
			      adasd <br>
			      adasd <br>
			      adasd <br>
			      adasd <br>

			      </div>
			    </div>
			  </div>';

			  $query2 = "SELECT
				submenu.IdSubMenu,
				submenu.Id_menu,
				submenu.Nombre,
				submenu.Enlace
				FROM
				submenu
				WHERE
				submenu.Id_menu =".$data[$i][0];
			$data2 = $run->select($query2);


				if (count($data2) > 0) {

					for ($j=0; $j < count($data2); $j++) {
						$list.= '  <div class="panel panel-default subMenuItems">
						    <div class="panel-heading" role="tab" id="headingTwo'.$i.'-'.$j.'">
						      <h4 class="panel-title">
						        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo'.$i.'-'.$j.'" aria-expanded="false" aria-controls="collapseTwo'.$i.'-'.$j.'">
						          '.$data2[$j][2].'
						        </a>
						        <i class="glyphicon glyphicon-trash pull-right iconItemsMenu"></i>
						        <i class="glyphicon glyphicon-edit pull-right iconItemsMenu"></i>
						      </h4>
						    </div>
						    <div id="collapseTwo'.$i.'-'.$j.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo'.$i.'-'.$j.'">
						      <div class="panel-body">
						      adasd <br>
						      adasd <br>
						      adasd <br>
						      adasd <br>

						      </div>
						    </div>
						  </div>';

				}
			}
		}
	}
?>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

<?php echo $list; ?>


</div>