<?php 

	include("../class/admin/conf_gestion.php");
	include("../class/global/global.php");
	
    $confiGuardar = new ConfGestion();
    $result = $confiGuardar-> guardarConfigGestion($_POST['data']);
    
    if ($result == 0){
			$messages[] = "La Conf se ha creado de manera Exitosa.";
	} else{
		$errors []= "Error al Crear la Conf, intente nuevamente." ;		
	} 

	if (isset($errors)){
		
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
?>
		