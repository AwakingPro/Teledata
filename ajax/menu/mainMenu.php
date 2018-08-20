<?php
	$query = 'SELECT descripcion, enlace, icono, id_menu, permisos FROM menu WHERE activo = 1 ORDER BY indice';
	$data = $run->select($query);
	$url = explode('/', $_SERVER['REQUEST_URI']);
	$subM = 0;
	if (count(array_filter($url,"strlen")) > 2) {
		$url = '../'.$url[2].'/'.$url[3];
	}else{
		$url = '../'.$url[2];
	}
	if (count($data) > 0) {
		$list ='<li class="list-header">Menú Principal</li>';
		if(isset($_SESSION['idNivel'])){
			for ($i=0; $i < count($data); $i++) {
				$permiso = explode(',',$data[$i][4]);
				if (in_array($_SESSION['idNivel'], $permiso)) {
					$arrow = "";
					$subMenu = "";
					$query2 = 'SELECT Nombre, Enlace FROM submenu WHERE submenu.Id_menu = '.$data[$i]['id_menu'];
					$data2 = $run->select($query2);
					if (count($data2) > 0) {
						$arrow = "<i class='arrow'></i>";
						$subMenu .= '<ul class="collapse ">';
						for ($j=0; $j < count($data2); $j++) {
							if ($data2[$j]['Enlace'] == $url) {
								$subM = 1;
								$subMenu .= '<li class="active-link"><a href="'.$data2[$j]['Enlace'].'">'.$data2[$j]['Nombre'].'</a></li>';
							}else{
								$subMenu .= '<li><a href="'.$data2[$j]['Enlace'].'">'.$data2[$j]['Nombre'].'</a></li>';
							}

						}
						$subMenu .= '</ul>';
					}
					if ($data[$i]['enlace'] == $url || $subM == 1) {
						$list.= ' <li class="menu-items active-link">
							<a  href="'.$data[$i]['enlace'].'">
								<i class="'.$data[$i]['icono'].'"></i>
								<span class="menu-title">
									<strong>'.$data[$i]['descripcion'].'</strong>
								</span>
								'.$arrow.'
							</a>
							'.$subMenu.'
						</li>';
						$subM = 0;
					}else{
						$list.= ' <li  class="menu-items">
							<a  href="'.$data[$i]['enlace'].'">
								<i class="'.$data[$i]['icono'].'"></i>
								<span class="menu-title">
									<strong>'.$data[$i]['descripcion'].'</strong>
								</span>
								'.$arrow.'
							</a>
							'.$subMenu.'
						</li>';
					}
				}
			}
		}
		echo $list;
	}else{
		echo 'No hay menu disponible';
	}
 ?>

