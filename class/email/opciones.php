<?php  

class opciones{

	public function estrategias($con){

		$query_est = mysqli_query($con, "SHOW TABLES FROM foco WHERE tables_in_foco LIKE 'qr_".$_SESSION['cedente']."%'") or die(mysqli_error($con)); 
		$estrategias = '';
		if(mysqli_num_rows($query_est)>0) { 
		    while($rows = mysqli_fetch_row($query_est)){
		        $estrategias .= '<option value="'.$rows[0].'">'.$rows[0].'</option>';
		    }
		}
		return $estrategias;
	}
	public function general($con){
		$query_temp = mysqli_query($con, "SELECT id, nombre FROM EMAIL_Template") or die(mysqli_error($con)); 
		$list='';
		if(mysqli_num_rows($query_temp)>0) { 
		    while($row_temp = mysqli_fetch_assoc($query_temp)){
		        $list.= '<option value="'.$row_temp['id'].'">'.$row_temp['nombre'].'</option>';
		    }
		}

		return $list;
	}

	public function templates($con){
		$query_select = mysqli_query($con, "SELECT * FROM EMAIL_Template");

	    $templates = '<tr><td colspan="2">No hay templates guardadas.</td></tr>';

	    if(mysqli_num_rows($query_select)> 0){
	        $templates = '';
	        while($row_select = mysqli_fetch_assoc($query_select)){
	            $templates .= '<tr data-id="'.$row_select["Id"].'"><td>'.$row_select["Nombre"].'</td><td><button type="button" data-id="'.$row_select["Id"].'" class="use-template btn btn-primary">Editar</button> <button data-id="'.$row_select["Id"].'" class="delete-template btn btn-primary" type="button">Eliminar</button></td></tr>';
	        }
	    }

		return $templates;
	}

	public function variables($con){
		$query_select = mysqli_query($con, "SELECT * FROM Variables");

	    $variables = '<tr><td colspan="2">No hay variables guardadas.</td></tr>';

	    if(mysqli_num_rows($query_select)> 0){
	        $variables = '';
	        while($row_select = mysqli_fetch_assoc($query_select)){
	            $variables .= '<tr data-id="'.$row_select["id"].'"><td>'.$row_select["variable"].'</td><td><button type="button" data-id="'.$row_select["id"].'" class="edit-var btn btn-primary">Editar</button> <button data-id="'.$row_select["id"].'" class="delete-var btn btn-primary" type="button">Eliminar</button></td></tr>';
	        }
	    }

		return $variables;
	}
	public function campos($tabla,$con){

		$query_campos = mysqli_query($con, "SHOW COLUMNS FROM ".$tabla) or die(mysqli_error($con)); 
		$campos = '';
		if(mysqli_num_rows($query_campos)>0) { 
		    while($rows = mysqli_fetch_row($query_campos)){
		        $campos .= '<option value="'.$rows[0].'">'.$rows[0].'</option>';
		    }
		}
		return $campos;
	}
	public function enviados($con){
		$query_select = mysqli_query($con, "SELECT * FROM envio_email ORDER BY id DESC");

	    $lista_enviados = '<tr><td colspan="6">No se han enviado correos.</td></tr>';

	    if(mysqli_num_rows($query_select)> 0){
	        $lista_enviados = '';
	        while($row_select = mysqli_fetch_assoc($query_select)){
	        	$status = $row_select["status"] == 1 ? 'Culminado' : 'En proceso';
	        	
	        	$query_leidos = mysqli_query($con, "SELECT * FROM Confirmacion WHERE id_envio = '".$row_select["id"]."'");

	        	if(mysqli_num_rows($query_leidos)> 0){

	        		$row_leidos = mysqli_fetch_assoc($query_leidos);

	        		$emails_array = explode(',', $row_leidos['emails']);
	        		$leidos = count($emails_array);

	        	} else {
	        		$leidos = '0';
	        	}

	            $lista_enviados .= '<tr data-id="'.$row_select["id"].'"><td>'.$row_select["estrategia"].'</td><td>'.$row_select["asunto"].'</td><td>'.$status.'</td><td>'.$row_select["offset"].'/'.$row_select["cantidad"].'</td><td>'.$leidos.'</td><td><button type="button" data-id="'.$row_select["id"].'" class="reenviar btn btn-primary">Reenviar a no leidos</button></td></tr>';
	        }
	    }

		return $lista_enviados;
	}
	public function configvalues($con){

		$consulta = mysqli_query($con,"SELECT * FROM control_envio");

		if(mysqli_num_rows($consulta)>0){
			$row_consulta = mysqli_fetch_assoc($consulta);

			$protocolo = $row_consulta['protocolo'];
			$prot1 = $protocolo == 1 ? 'checked=""' : '';
			$prot2 = $protocolo == 2 ? 'checked=""': '';
			$secure = $row_consulta['secure'];
			$sec1 = $secure == 1 ? 'checked=""': '';
			$sec2 = $secure == 2 ? 'checked=""': '';
			$host = $row_consulta['host'];
			$port = $row_consulta['puerto'];
			$email = $row_consulta['email'];
			$pass = $row_consulta['contrasena'];
			$from_email = $row_consulta['from_email'];
			$from_name = $row_consulta['from_name'];
		} else {
			$prot1 = 'checked=""';
			$prot2 = '';
			$sec1 = 'checked=""';
			$sec2 = '';
			$host = '';
			$port = '';
			$email = '';
			$pass = '';
			$from_email = '';
			$from_name = '';
		}

		$result = array($prot1,$prot2,$sec1,$sec2,$host,$port,$email,$pass,$from_email,$from_name);

		return $result;

	}
}


?>