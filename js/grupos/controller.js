$(document).ready(function() {
	$('#listGrupos').load('../grupos/ajax/listGrupos.php',function(){
		$('.TableEmpresas').dataTable({
			"lengthMenu": [
				[5, 10, -1],
				[5, 10, "Todos"]
			],
			"columnDefs": [{
				'orderable': false,
				'targets': [1]
			}, ],
			"order": [
				[0, "desc"]
			]
		});
	});
	$.post('../grupos/ajax/listPersona.php', function(data) {
		$('#listPersonas').html(data);
	});
	$.post('../grupos/ajax/listEmpresas.php', function(data) {
		$('#listEmpresas').html(data);
	});
	$('#tagPersonas').on('click', function(event) {
		var value = $('#listPersonas').val();
		if (value != "") {
			var tag = "<div class='row t1'><div class='col-md-3 form-group'><span att='"+$('#listPersonas').val()+"' class='form-control bg-info personasGr'>"+$( "#listPersonas option:selected" ).text()+"</span></div><div class='col-md-1'><button type='button' class='btn btn-danger dlt'><i class='ti-close'></i></button></div></div>";
			$('#mens').remove();
			$('#contTagPersonas').append(tag);
			$('#listPersonas').val('');
		}
	});
	$('#tagEmpresas').on('click', function(event) {
		var value = $('#listEmpresas').val();
		if (value != "") {
			var tag = "<div class='row t1'><div class='col-md-3 form-group'><span att='"+$('#listEmpresas').val()+"' class='form-control bg-info empresasEx'>"+$( "#listEmpresas option:selected" ).text()+"</span></div><div class='col-md-1'><button type='button' class='btn btn-danger dlt'><i class='ti-close'></i></button></div></div>";
			$('#mens2').remove();
			$('#contTagEmpresas').append(tag);
			$('#listEmpresas').val('');
		}
	});
	$('#guardarGrupo').on('click', function(){
		var formValues = new FormData();
		var personas = [];
		var empresas = [];
		$('.personasGr').each(function(index, elemento) {
			personas.push($(elemento).attr('att'));
		});
		$('.empresasEx').each(function(index, elemento) {
			empresas.push($(elemento).attr('att'));
		});
		formValues.append('personas', personas);
		formValues.append('empresas', empresas);
		formValues.append('nombre', $('#nombre').val());

		if (this.hasAttribute('edit')) {
			formValues.append('id', $(this).attr('edit'));
			$.ajax({
				url: '../grupos/ajax/editfin.php',
				type: 'POST',
				data: formValues,
				processData: false,
				contentType: false,
				success: function(e) {
					console.log(e);
					$('.t1, #mens2, #mens').remove();
					$('#contTagEmpresas').append('<h4 id="mens2">No ah seleccionado ninguna empresa</h4>');
					$('#contTagPersonas').append('<h4 id="mens">No ah seleccionado ninguna persona</h4>');
					$('#listGrupos').load('../grupos/ajax/listGrupos.php',function(){
						$('.TableEmpresas').dataTable({
							"lengthMenu": [
								[5, 10, -1],
								[5, 10, "Todos"]
							],
							"columnDefs": [{
								'orderable': false,
								'targets': [1]
							}, ],
							"order": [
								[0, "desc"]
							]
						});
					});
				}
			});
		}else{
			$.ajax({
				url: '../grupos/ajax/insertGrupo.php',
				type: 'POST',
				data: formValues,
				processData: false,
				contentType: false,
				success: function(e) {
					$('.t1, #mens2, #mens').remove();
					$('#contTagEmpresas').append('<h4 id="mens2">No ah seleccionado ninguna empresa</h4>');
					$('#contTagPersonas').append('<h4 id="mens">No ah seleccionado ninguna persona</h4>');
					$('#listGrupos').load('../grupos/ajax/listGrupos.php',function(){
						$('.TableEmpresas').dataTable({
							"lengthMenu": [
								[5, 10, -1],
								[5, 10, "Todos"]
							],
							"columnDefs": [{
								'orderable': false,
								'targets': [1]
							}, ],
							"order": [
								[0, "desc"]
							]
						});
					});
				}
			});
		}
	});
	$(document).on('click', '.verGrupo', function(){
		$.post('../grupos/ajax/listPersonasEmpresas.php', {idgrupo: $(this).attr('attr')}, function(data) {
			json = $.parseJSON(data);
			$('#modalPersonas').html(json[0]);
			$('#modalEmpresas').html(json[1]);
		});
	});
	$(document).on('click', '.unlink', function(){
		$('#aviso').modal('show')
		$('.bsi').attr('attr',$(this).attr('attr'));
	});
	$(document).on('click', '.dlt', function() {
		$(this).parents('.t1').remove();
		if ($('#contTagPersonas .t1').length == 0 && $("#mens").length == 0) {
			$('#contTagPersonas').append('<h4 id="mens">No ah seleccionado ninguna persona</h4>');
		}
		if ($('#contTagEmpresas .t1').length == 0 && $("#mens2").length == 0) {
			$('#contTagEmpresas').append('<h4 id="mens2">No ah seleccionado ninguna empresa</h4>')
		}
	});
	$(document).on('click', '.bsi', function() {
		$.post('../grupos/ajax/delete.php', {id: $(this).attr('attr')}, function(data) {
			$('#listGrupos').load('../grupos/ajax/listGrupos.php',function(){
				$('.TableEmpresas').dataTable({
					"lengthMenu": [
						[5, 10, -1],
						[5, 10, "Todos"]
					],
					"columnDefs": [{
						'orderable': false,
						'targets': [1]
					}, ],
					"order": [
						[0, "desc"]
					]
				});
			});
		});
	});
	$(document).on('click', '.edit', function(){
		$.post('../grupos/ajax/edit.php', {id: $(this).attr('attr')}, function(data) {
			value = $.parseJSON(data);
			$('.t1').remove();
			if (value[3] > 0) {
				$('#mens').remove();
				$('#contTagPersonas > div').append(value[0]);
			}else{
				if ($("#mens").length == 0) {
					$('#contTagPersonas').append('<h4 id="mens">No ah seleccionado ninguna persona</h4>');
				}
			}
			if (value[4] > 0) {
				$('#mens2').remove();
				$('#contTagEmpresas').append(value[1]);
			}else{
				if ($("#mens2").length == 0) {
					$('#contTagEmpresas').append('<h4 id="mens2">No ah seleccionado ninguna empresa</h4>')
				}
			}
			$('#nombre').val(value[2][1]);
			$('#guardarGrupo').attr('edit',value[2][0]);
		});
	});
});