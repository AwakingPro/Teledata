<?php

	include("../class/admin/conf_gestion.php");
	include("../class/global/global.php");

	$confiGuardar = new ConfGestion();

	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['id'])){
			$errors[] = "ID vacío";
	}   
	else if (!empty($_POST['id']) )
	{
	
		$id=intval($_POST['id']);
		$query_delete = $confiGuardar-> eliminarConfig($id);

		if ($query_delete == 0){
			$messages[] = "Los datos se han eliminado de manera exitosa.";
		} else{
			$errors []= "Error al Eliminar, intenta nuevamente.";
		}
		
		
		if (isset($errors))
		{
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>

<?php
		}
	}

?>