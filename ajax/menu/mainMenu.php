<?php
	require_once('../../class/methods_global/methods.php');
	$query = 'SELECT descripcion, enlace, icono, id_menu FROM menu';
	$run = new Method;
	$data = $run->select($query);
	if (count($data) > 0) {
		$list ='<li class="list-header">Menú Principal</li>"';
		for ($i=0; $i < count($data); $i++) {
			$arrow = "";
			$subMenu = "";
			$query2 = 'SELECT Nombre, Enlace FROM submenu WHERE submenu.Id_menu = '.$data[$i]['id_menu'];
			$data2 = $run->select($query2);
			if (count($data2) > 0) {
				$arrow = "<i class='arrow'></i>";
				$subMenu .= '<ul class="collapse">';
				for ($j=0; $j < count($data2); $j++) {
					$subMenu .= '<li><a href="'.$data2[$j]['Enlace'].'">'.$data2[$j]['Nombre'].'</a></li>';
				}
				$subMenu .= '</ul>';
			}

			$list.= ' <li>
				<a class="itemsMenu" href="'.$data[$i]['enlace'].'">
					<i class="'.$data[$i]['icono'].'"></i>
					<span class="menu-title">
						<strong>'.$data[$i]['descripcion'].'</strong>
					</span>
					'.$arrow.'
				</a>
				'.$subMenu.'
			</li>';
		}
		echo $list;
	}else{
		echo 'No hay menu disponible';
	}
 ?>

