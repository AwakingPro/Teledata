jQuery(document).ready(function($) {
	$('#listEmpresas').load('../empresasExternas/ajax/listEmpresas.php',function(){
		$('.TableEmpresas').dataTable({
			"lengthMenu": [
				[5, 10, -1],
				[5, 10, "Todos"]
			],
			"columnDefs": [{
				'orderable': false,
				'targets': [3]
			}, ],
			"order": [
				[0, "desc"]
			]
		});
	});

	$('#procesar').on('click', function(event) {
		var formValues = new FormData();
		$('.form-cont').find('input, textarea').each(function(index, obj) {
			formValues.append($(obj).attr('name'), $(obj).val());
		});
		if (this.hasAttribute('edit')) {
			formValues.append('id', $(this).attr('edit'));
			$.ajax({
				url: '../empresasExternas/ajax/editfin.php',
				type: 'POST',
				data: formValues,
				processData: false,
				contentType: false,
				success: function(e) {
					console.log(e);
					$('#listEmpresas').load('../empresasExternas/ajax/listEmpresas.php',function(){
						$('.TableEmpresas').dataTable({
							"lengthMenu": [
								[5, 10, -1],
								[5, 10, "Todos"]
							],
							"columnDefs": [{
								'orderable': false,
								'targets': [3]
							}, ],
							"order": [
								[0, "desc"]
							]
						});
					});
					$('.form-cont input, .form-cont textarea').val('');
				}
			});
		}else{
			 $.ajax({
				url: '../empresasExternas/ajax/insertEmpresas.php',
				type: 'POST',
				data: formValues,
				processData: false,
				contentType: false,
				success: function(e) {
					$('#listEmpresas').load('../empresasExternas/ajax/listEmpresas.php',function(){
						$('.TableEmpresas').dataTable({
							"lengthMenu": [
								[5, 10, -1],
								[5, 10, "Todos"]
							],
							"columnDefs": [{
								'orderable': false,
								'targets': [3]
							}, ],
							"order": [
								[0, "desc"]
							]
						});
					});
					$('.form-cont input, .form-cont textarea').val('');
				}
			});
		}
	});

	$(document).on('click', '.edit', function(){
		$.post('../empresasExternas/ajax/edit.php', {id: $(this).attr('attr')}, function(data) {
			value = $.parseJSON(data);
			$('[name="nombre"]').val(value[0].Nombre);
			$('[name="telefono"]').val(value[0].Telefono);
			$('[name="correo"]').val(value[0].Correo);
			$('[name="direccion"]').val(value[0].Direccion);
			$('#procesar').attr('edit',value[0].IdEmpresaExterna);
		});
	});

	$(document).on('click', '.unlink', function(){
		$('#aviso').modal('show')
		$('.bsi').attr('attr',$(this).attr('attr'));
	});

	$(document).on('click', '.bsi', function() {
		$.post('../empresasExternas/ajax/delete.php', {id: $(this).attr('attr')}, function(data) {
			$('#listEmpresas').load('../empresasExternas/ajax/listEmpresas.php',function(){
				$('.TableEmpresas').dataTable({
					"lengthMenu": [
						[5, 10, -1],
						[5, 10, "Todos"]
					],
					"columnDefs": [{
						'orderable': false,
						'targets': [3]
					}, ],
					"order": [
						[0, "desc"]
					]
				});
			});
		});
	});
});