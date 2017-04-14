$(document).ready(function($) 
{
	$('.seleccione_tipo').on('click',function() 
	{
    	var mivar = $(this).closest('tr').attr('id');
    	var id_cedente = $('#id_cedente').val();
		
        var data = 'id='+mivar+"&id_cedente="+id_cedente;
        console.log(data);
        var recorrer = $('.seleccione_tipo').length;
		if ($('.seleccione_tipo').is(':checked')) 
		{ 
        	$.niftyNoty(
			{
				type: 'success',
				icon : 'fa fa-check',
				message : "Tipo Estrategia Seleccionado" ,
				container : 'floating',
				timer : 2000
			});
            for (var i=1; i<=recorrer; i++) 
			{
            	if (mivar==i)
				{
					$('#uno'+i).attr("disabled" , false);
				}
				else 
				{
					$('#uno'+i).attr("disabled" , true);
                }
			}
            $.ajax(
	        {
				type: "POST",
				url: "../../includes/tareas/seleccione_tipo.php",
				data:data, 
				success: function(response)
				{ 
					$('#mostrar_estrategia').show();			
                    $('#cambiar2').html(response);
					$('html,body').animate({ scrollTop: $("#cambiar").offset().top }, 1000);    
					$('.seleccione_estrategia').on('click',function() 
					{
						
						console.log("AÑADIEDO CLASS");

						var mivar2 = $(this).closest('tr').attr('id');
						var mivar3 = $(this).closest('tr').attr('class');
						var data = 'id='+mivar2;
						var recorrer2 = $('.seleccione_estrategia').length;	
						if ($('.seleccione_estrategia').is(':checked')) 
						{ 
							 
							
							

						for (var j=1; j<=recorrer2; j++) 
						{
							if (mivar3==j)
							{
								$('#dos'+j).attr("disabled" , false);
								$('body').addClass("loading"); 
							}
							else 
							{
								$('#dos'+j).attr("disabled" , true); 
						    }
						}

						$.ajax(
						{
							type: "POST",
							url: "../../includes/tareas/seleccione_estrategia.php",
							data:data, 
							success: function(response)
							{ 
								$('body').removeClass("loading");  
								$.niftyNoty({
									type: 'success',
									icon : 'fa fa-check',
									message : "Estrategia Seleccionada" ,
									container : 'floating',
									timer : 2000
								});
								$('#mostrar_cola').show();
								$('#cambiar3').html(response);
								$('html,body').animate({scrollTop: $("#cambiar3").offset().top}, 1000);
								$('.activar_cola').on('click',function() 
								{
									var ObjectTR = $(this).closest('tr');
									var Asignador = ObjectTR.find("td.AsignadorBtn");
									var id_var = $(this).closest('tr').attr('id');
									var id_var2 = '#k'+id_var;
									var mivar = $(this).closest('tr').attr('id');
								    var data = "id="+mivar;
									console.log(id_var2);
									var prueba = $(id_var2).val();
									console.log(prueba);
							    	if (prueba==1) 
									{ 
										prueba = $(id_var2).val("0");
										$('body').addClass("loading");
										$.ajax(
								        {
											type: "POST",
											url: "../../includes/tareas/desactivar_cola.php",
											data:data, 
											success: function(response)
											{ 
												$('body').removeClass("loading"); 
												console.log(response);
												if(response==1)
												{
													Asignador.find("i").addClass("Disabled");
													$.niftyNoty({
														type: 'danger',
														icon : 'fa fa-check',
														message : "Cola Desactivada" ,
														container : 'floating',
														timer : 4000
													});

												}
												else
												{

												}
											}	
										});	
								    	
									}
									else
									{

										prueba = $(id_var2).val("1");
										console.log(response);

										$('body').addClass("loading"); 
								    	var mivar = $(this).closest('tr').attr('id');
								    	var data = "id="+mivar;
								    	$.ajax(
								        {
											type: "POST",
											url: "../../includes/tareas/activar_cola.php",
											data:data, 
											success: function(response)
											{ 
												$('body').removeClass("loading"); 
												console.log(response);
												if(response==1)
												{
													$.niftyNoty({
														type: 'danger',
														icon : 'fa fa-check',
														message : "La Cola ya existe" ,
														container : 'floating',
														timer : 2000
													});

												}
												else
												{
													Asignador.find("i").removeClass("Disabled");
													$.niftyNoty({
														type: 'success',
														icon : 'fa fa-check',
														message : "Cola Activada , Ya se puede visualizar en el Discador!" ,
														container : 'floating',
														timer : 4000
													});
												}	
											}	
										});	
										
									}	
							    });	
								
						 	}
	                	});      
			  		} 
					else 
					{		 
						for (var j=1; j<=recorrer2; j++) 
						{
							$('#dos'+j).attr("disabled" , false);
						}
						$('#mostrar_cola').fadeOut( "slow", function() {


  						});
					}  
				}); 	
			}
 		});     
	} 
	else 
	{ 
		for (var i=1; i<=recorrer; i++) 
		{                       		
			$('#uno'+i).attr("disabled" , false);
		}
		$('#mostrar_estrategia').fadeOut( "slow", function() {

  		});
		$('#mostrar_cola').fadeOut( "slow", function() {

  		});
		$('html,body').animate({ scrollTop: $("#cambiar").offset().top}, 1000);
	}       
});
	
	var IDCola;
	var TablaDeAsignados;
	var ArrayEE = [];
	var ArrayPersonal = [];
	$("body").on("click",".Asignar", function(){
		var ObjectMe = $(this);
		var ObjectTd = ObjectMe.closest("td");
		var ObjectIcon = ObjectTd.find("i");
		var ObjectTr = ObjectMe.closest("tr");
		IDCola = ObjectTr.attr("id");
		if(!ObjectIcon.hasClass("Disabled")){
			var dataSet = [];
			$.ajax({
				type: "POST",
				url: "../../includes/tareas/getAsignaciones.php",
				data:{
					idCola: IDCola
				},
				beforeSend: function() {
					$('body').addClass("loading");
				},
				success: function(response){ 
					console.log(response);
					$('body').removeClass("loading"); 
					var json = JSON.parse(response);
					console.log(json);
					dataSet = json.Asiganciones;
					//console.log(json);
					$("#Downloads #Tipo1").html("<a class='list-group-item'>Full</a>");
					$("#Downloads #Tipo2").html("<a class='list-group-item'>Dial</a>");
					//$("#Downloads #Tipo3").html("<a class='list-group-item'>TIPO 3</a>");
					$.each(json.Archivos.Tipo1, function(i, item) {
						//console.log(item);
						var $a = $("<a>");
						$a.addClass("list-group-item");
						$a.attr("href",item[0].file);
						$a.attr("download",item[0].fileName+"_Full.xlsx");
						$a.html(item[0].fileName+"_Full");
						$("#Downloads").find("#Tipo1").append($a);
					});
					$.each(json.Archivos.Tipo2, function(i, item) {
						//console.log(item);
						var $a = $("<a>");
						$a.addClass("list-group-item");
						$a.attr("href",item[0].file);
						$a.attr("download",item[0].fileName+"_Dial.xlsx");
						$a.html(item[0].fileName+"_Dial");
						$("#Downloads").find("#Tipo2").append($a);
					});
					/*$.each(json.Archivos.Tipo3, function(i, item) {
						console.log(item);
						var $a = $("<a>");
						$a.addClass("list-group-item");
						$a.attr("href",item[0].file);
						$a.attr("download",item[0].fileName+".xlsx");
						$a.html(item[0].fileName);
						$("#Downloads").find("#Tipo3").append($a);
					});*/
					$("#page-content").addClass("AsignadorOculto");
					$("#AsignadorDeCasos").addClass("AsignadorOculto");
					TablaDeAsignados = $("#TablaDeAsignados").DataTable({
						data: dataSet,
						columns: [
							{ data: 'Nombre',"width": "60%" },
							{ data: 'Tipo',"width": "10%", },
							{ data: 'Porcentaje',"width": "10%", },
							{ data: 'Foco',"width": "10%", },
							{ data: 'id' },
							{ data: 'Actions',"width": "10%", }
						],
						"columnDefs": [ 
							{
								"targets": 0,
								"width": "70%",
							},
							{
								"targets": 1,
								"width": "10%",
							},
							{
								"targets": 2,
								"width": "10%",
								"render": function( data, type, row ) {
									return "<input style='width: 100%; border: 0;' class='InputPorcentaje' type='text' value='"+data+"' />";
								}
							},
							{
								"targets": 3,
								"width": "10%",
								"render": function( data, type, row ) {
									var Checked = "";
									if(data == "1"){
										Checked = "checked";
									}
									return "<input class='Checkbox' "+Checked+" type='checkbox'>";
								}
							},
							{
								"targets": 4,
								"visible": false
							},
							{
								"targets": 5,
								"width": "10%",
								"data": 'Actions',
								"render": function( data, type, row ) {
									return "<div style='text-align: center;'><i style='cursor: pointer; margin: 0 10px;' id='"+data+"' class='fa fa-times-circle icon-lg Delete'></i></div>";
								}
							},
						]
					});
					$("#TablaDeAsignados").trigger('update');
				}	
			});
		}else{
			$.niftyNoty({
				type: 'danger',
				icon : 'fa fa-check',
				message : "La cola no existe" ,
				container : 'floating',
				timer : 2000
			});
		}
	});
	$("body").on("click","#AddEntidad",function(){
		var Template = $("#TemplateAddEntidad").html();
		bootbox.dialog({
            title: "Agregue Nueva Entidad",
            message: Template,
            buttons: {
                success: {
                    label: "Guardar",
                    className: "btn-purple",
                    callback: function() {
                        var Entidad = $("select[name='Entidad'] option:selected").val();
						var NombreEntidad = $("select[name='Entidad'] option:selected").text();
						var ArrayEntidad = Entidad.split("_");
						var TipoEntidad = ArrayEntidad[0];
						var idEntidad = ArrayEntidad[1];
						switch(TipoEntidad){
							case 'S':
								TipoEntidad = "Personal";
								ArrayPersonal.push(idEntidad);
							break;
							case 'E':
								TipoEntidad = "Personal";
								ArrayPersonal.push(idEntidad);
							break;
							case 'EE':
								TipoEntidad = "Empresa Externa";
								ArrayEE.push(idEntidad);
							break;
						}
						if((Entidad != "")){
							TablaDeAsignados.row.add({
								Nombre: NombreEntidad,
								Tipo: TipoEntidad,
								Porcentaje: "0",
								id: Entidad,
								Foco: "0",
								Actions: Entidad
							}).draw();
						}else{
							CustomAlert("Debe lleanr todos los datos.");
						}
                    }
                }
            }
        }).off("shown.bs.modal");
		$(".selectpicker").selectpicker("refresh");
	});
	$("body").on("change","select[name='TipoEntidad']",function(){
		var tipoEntidad = $(this).val();
		$("select[name='Entidad']").html();
		$("select[name='Entidad']").prop("disabled",false);
		$("select[name='Entidad']").selectpicker("refresh");
		var ArrayTmp = [];
		switch(tipoEntidad){
			case '1':
				ArrayTmp = ArrayEE;
			break;
			case '2':
				ArrayTmp = ArrayPersonal;
			break;
		}
		$.ajax({
			type: "POST",
			url: "../../includes/tareas/getEntidades.php",
			data:{
				tipoEntidad: tipoEntidad, ArrayIds: ArrayTmp
			},
			beforeSend: function() {
				$('body').addClass("loading");
			},
			success: function(response){ 
				$('body').removeClass("loading"); 
				$("select[name='Entidad']").html(response);
				$("select[name='Entidad']").selectpicker("refresh");
			}	
		});
	});
	$("body").on("click",".Delete", function(){
        var ObjectMe = $(this);
		var ID = ObjectMe.attr("id");
        var ObjectTR = ObjectMe.closest("tr");
        bootbox.confirm("¿Esta seguro que desea eliminar esta entidad?", function(result) {
            if (result) {
                DeleteEntidad(ObjectTR,ID);
            }
        });
    });
	$("body").on("click","#Seleccionar_Modo_Asignacion",function(){
		var Porcentaje = $("#SumPorcentaje").html();
		Porcentaje = Porcentaje.replace("%","");
		Porcentaje = Number(Porcentaje);
		if(Porcentaje == 100){
			var Template = $("#TemplateSeleccionModoAsignacion").html();
			bootbox.dialog({
				title: "Agregue Nueva Entidad",
				message: Template,
				buttons: {
					success: {
						label: "Guardar",
						className: "btn-purple",
						callback: function() {
							var MetodoAsignacion = $("select[name='MetodoAsignacion']").val();
							var Rows = [];
							TablaDeAsignados.rows().eq(0).each( function ( index ) {
								var row = TablaDeAsignados.row( index );
								var data = row.data();
								var ArrayTmp = [];
								$.each(data,function(indexCol,value){
									switch(indexCol){
										case 'Nombre':
											ArrayTmp.push(value);
										break;
										case 'Porcentaje':
											ArrayTmp.push(value);
										break;
										case 'Foco':
											ArrayTmp.push(value);
										break;
										case 'id':
											ArrayTmp.push(value);
										break;
									}
								});
								Rows.push(ArrayTmp);
							});

							switch(MetodoAsignacion){
								case '1':
									//Ruts
									$.ajax({
										type: "POST",
										url: "../../includes/tareas/SeparateByRuts.php",
										data:{
											idCola: IDCola, Rows: Rows
										},
										beforeSend: function() {
											$('body').addClass("loading");
										},
										success: function(response){ 
											$('body').removeClass("loading"); 
											var json = JSON.parse(response);
											console.log(json);
											$("#Downloads #Tipo1").html("<a class='list-group-item'>Full</a>");
											$("#Downloads #Tipo2").html("<a class='list-group-item'>Dial</a>");
											//$("#Downloads #Tipo3").html("<a class='list-group-item'>TIPO 3</a>");
											$.each(json.Tipo1, function(i, item) {
												//console.log(item);
												var $a = $("<a>");
												$a.addClass("list-group-item");
												$a.attr("href",item.file);
												$a.attr("download",item.fileName+"_Full.xlsx");
												$a.html(item.fileName+"_Full");
												$("#Downloads").find("#Tipo1").append($a);
											});
											$.each(json.Tipo2, function(i, item) {
												//console.log(item);
												var $a = $("<a>");
												$a.addClass("list-group-item");
												$a.attr("href",item.file);
												$a.attr("download",item.fileName+"_Dial.xlsx");
												$a.html(item.fileName+"_Dial");
												$("#Downloads").find("#Tipo2").append($a);
											});
											/*$.each(json.Tipo3, function(i, item) {
												console.log(item);
												var $a = $("<a>");
												$a.addClass("list-group-item");
												$a.attr("href",item.file);
												$a.attr("download",item.fileName+".xlsx");
												$a.html(item.fileName);
												$("#Downloads").find("#Tipo3").append($a);
											});*/
										}	
									});
								break;
								case '2':
									//Deuda
									$.ajax({
										type: "POST",
										url: "../../includes/tareas/SeparateByDeuda.php",
										data:{
											idCola: IDCola, Rows: Rows
										},
										beforeSend: function() {
											$('body').addClass("loading");
										},
										success: function(response){ 
											$('body').removeClass("loading"); 
											var json = JSON.parse(response);
											console.log(json);
											$("#Downloads #Tipo1").html("<a class='list-group-item'>Full</a>");
											$("#Downloads #Tipo2").html("<a class='list-group-item'>Dial</a>");
											//$("#Downloads #Tipo3").html("<a class='list-group-item'>TIPO 3</a>");
											$.each(json.Tipo1, function(i, item) {
												//console.log(item);
												var $a = $("<a>");
												$a.addClass("list-group-item");
												$a.attr("href",item.file);
												$a.attr("download",item.fileName+"_Full.xlsx");
												$a.html(item.fileName+"_Full");
												$("#Downloads").find("#Tipo1").append($a);
											});
											$.each(json.Tipo2, function(i, item) {
												//console.log(item);
												var $a = $("<a>");
												$a.addClass("list-group-item");
												$a.attr("href",item.file);
												$a.attr("download",item.fileName+"_Dial.xlsx");
												$a.html(item.fileName+"_Dial");
												$("#Downloads").find("#Tipo2").append($a);
											});
											/*$.each(json.Tipo3, function(i, item) {
												console.log(item);
												var $a = $("<a>");
												$a.addClass("list-group-item");
												$a.attr("href",item.file);
												$a.attr("download",item.fileName+".xlsx");
												$a.html(item.fileName);
												$("#Downloads").find("#Tipo3").append($a);
											});*/
										}	
									});
								break;
							}
						}
					}
				}
			}).off("shown.bs.modal");
			$(".selectpicker").selectpicker("refresh");
		}else{
			CustomAlert("El porcentaje total debe ser de 100%");
		}
	});
	$("body").on("change","input.InputPorcentaje",function(){
		var ObjectMe = $(this);
        var Value = ObjectMe.val();
        var Row = ObjectMe.attr("row");
        var ObjectTD = ObjectMe.closest("td");
        var cell = TablaDeAsignados.cell( ObjectTD );
        cell.data( Value ).draw();
		$("#TablaDeAsignados").trigger('update');
	});
	$("body").on("click","input.Checkbox",function(){
		var ObjectMe = $(this);
		var Value = "0";
		if(ObjectMe.is(':checked')){
			Value = "1";
		}
        var Row = ObjectMe.attr("row");
        var ObjectTD = ObjectMe.closest("td");
        var cell = TablaDeAsignados.cell( ObjectTD );
        cell.data( Value ).draw();
		$("#TablaDeAsignados").trigger('update');
	});
	$("body").on("update","#TablaDeAsignados",function(){
        UpdateEntidadSummaryFoot();
    });
	function DeleteEntidad(TableRow,ID){
        TablaDeAsignados.row(TableRow).remove().draw();
		var ArrayEntidad = ID.split("-");
		var TipoEntidad = ArrayEntidad[0];
		var idEntidad = ArrayEntidad[1];
		switch(TipoEntidad){
			case 'S':
				removeItem(ArrayPersonal,idEntidad);
			break;
			case 'E':
				removeItem(ArrayPersonal,idEntidad);
			break;
			case 'EE':
				removeItem(ArrayEE,idEntidad);
			break;
		}
    }
	function removeItem(array, item){
		for(var i in array){
			if(array[i]==item){
				array.splice(i,1);
				break;
			}
		}
		console.log(array);
	}
	function UpdateEntidadSummaryFoot(){
        var SumPorcentaje = 0;
		TablaDeAsignados.rows().eq(0).each( function ( index ) {
			var row = TablaDeAsignados.row( index );
			var data = row.data();
			$.each(data,function(indexCol,value){
				switch(indexCol){
                    case 'Porcentaje':
                        SumPorcentaje += Number(value);
                    break;
                }
			});
		});
        $("#SumPorcentaje").html(SumPorcentaje.toFixed(2)+"%");
    }
	function CustomAlert(Message){
        bootbox.alert(Message);
    }
});