Dropzone.autoDiscover = false;
estados = [];
var Filename = "";

$('select').selectpicker();

$("#file-up").dropzone({
	url: "../carga/ajax/upload.php",
	acceptedFiles: ".xlsx,.csv",
	maxFiles:1,
	  init: function() {
	    this.on("addedfile", function() {
	      if (this.files[1]!=null){
	        this.removeFile(this.files[0]);
	      }
	    });
	  },

	error: function(file,response){
		if (response == "You can't upload files of this type.") {
				$('#alertFile').modal({
					backdrop: 'static',
					keyboard: false
				})
		}
	},

	success: function (file, response) {
		$("#listUploaded").load('../carga/ajax/listUploaded.php',function(){
			$('.dataTable1').dataTable({
				"lengthMenu": [
					[2, 5, 10, -1],
					[2, 5, 10, "Todos"]
				],
				"columnDefs": [{
					'orderable': false,
					'targets': [1]
				}, ],
				"order": [
					[0, "desc"]
				]
			});
			$('.campos').selectpicker();
		});
		arr = $.parseJSON(response);
		if (arr[0] == 1) {
			$('#load').modal('hide');
			$('#procesar').attr('url', arr[2]);
			$('#listTag').html(arr[1]);
			$('#listSheet').html(arr[3]);
			$('select#tablas').attr('disabled',false);
			$('select#tablas').selectpicker('refresh');
		}else{
			alert(arr[1]);
		}
	},
	processing: function () {
		$('#load').modal({
			backdrop: 'static',
			keyboard: false
		})
	}
});

$(document).on('change', '.sheet', function(){
	$('#load').modal({
			backdrop: 'static',
			keyboard: false
	})
	$.post('../carga/ajax/sheetTag.php', {sheet: $(this).val(), doc: $('#procesar').attr('url')}, function(data){
		arr = $.parseJSON(data);
		if (arr[0] == 1) {
			$('#load').modal('hide');
			$('#procesar').attr('url', arr[2]);
			$('#listTag').html(arr[1]);
			$('select.campos').selectpicker();
			$('#tablas').selectpicker('val','');
			estados = [];
		}else{
			alert(arr[1]);
		}
	});
});

$('#tablas').on('change',function(event) {
	var nombreTabla = $(this).selectpicker('val');
	$.post('../carga/ajax/selectCamposTablas.php', {tabla:nombreTabla}, function(data) {
		switch(nombreTabla){
			case 'Persona_tmp':
				$("#listTag .listTag .pk").addClass("Off");
				$("#listTag .listTag .pk").css("visibility","visible");
			break;
			default:
				$("#listTag .listTag .pk").removeClass("On");
				$("#listTag .listTag .pk").css("visibility","hidden");
			break;
		}
		$('select.campos').html(data);
		$('select.campos').selectpicker('refresh');
		$('#AgC').css('visibility', 'visible');
		if (estados[nombreTabla]) {
			$("select.campos").each(function(index, el) {
				$(el).selectpicker('val',estados[nombreTabla][index]);
			});
		}
	});
});

$(document).on('change', '.campos', function() {
	var estadosOption = [];
	var nombreEstado = $('#tablas').selectpicker('val');
	$("select.campos").each(function(index, el) {
		estadosOption.push($(el).selectpicker('val'));
	});
	estados[nombreEstado] =estadosOption;
});

$('#procesar').on('click',function(event) {
	var listTag = [];
	var campos = [];
	var tabla = $('#tablas').selectpicker('val');
	var doc = $('#procesar').attr('url');
	var sheet;
	$('#listSheet input[name="sheet"]').each(function(){
		var ObjectMe = $(this);
		if(ObjectMe.is(':checked')){
			sheet = ObjectMe.val();
		}
	});
	$('.listTag').each(function(index, el) {
		if($(el).find(".pk").hasClass("On")){
			listTag.push("1");
		}else{
			listTag.push("0");
		}
		//listTag.push($(el).html());
	});
	$('select.campos').each(function(index, el) {
		campos.push($(el).selectpicker('val'));
	});
	$.ajax({
		type: "POST",
		url: "../carga/ajax/insertExcel.php",
		data: {
			sheet: sheet,
			doc:doc,
			campos:campos,
			listTag: listTag,
			tabla: tabla,
		},
		beforeSend: function(){
			$('#Cargando').modal({
				backdrop: 'static',
				keyboard: false
			})
		},
		success: function(data){
			console.log(data);
			$('#Cargando').modal('hide');
			var json = JSON.parse(data);
			$("#alertProcesar .Content").html(json.Query);
			$('#alertProcesar').modal();
			var IdTablaEstatus = "";
			switch(tabla){
				case 'Persona_tmp':
					IdTablaEstatus = "TablePersona";
				break;
				case 'Deuda_tmp':
					IdTablaEstatus = "TableDeuda";
				break;
				case 'fono_cob_tmp':
					IdTablaEstatus = "TableFono";
				break;
				case 'Direcciones_tmp':
					IdTablaEstatus = "TableDirecciones";
				break;
				case 'Mail_tmp':
					IdTablaEstatus = "TableMail";
				break;
			}
			$("#"+IdTablaEstatus).removeClass("list-group-item-danger");
			$("#"+IdTablaEstatus).addClass("list-group-item-success");
		},
		error: function(){
		}
	});
	/*$.post('../carga/ajax/insertExcel.php', {
		doc:doc,
		campos:campos,
		listTag: listTag,
		tabla: tabla,
	}, function(data) {
		console.log(data);
		alert(data);
	});*/
});

$("#listUploaded").load('../carga/ajax/listUploaded.php',function(){
	$('.dataTable1').dataTable({
		"lengthMenu": [
			[2, 5, 10, -1],
			[2, 5, 10, "Todos"]
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

$('#AgCp').on('click', function() {
	$.post('../carga/ajax/agregarCampo.php', {
		tabla: $('#tablas').selectpicker('val'),
		nombre: $('input[name="NomCam"]').val(),
		tipo: $('select[name="TipCam"]').selectpicker('val')
	}, function(data) {
		$.post('../carga/ajax/selectCamposTablas.php', {tabla: $('#tablas').selectpicker('val')}, function(data) {
			$('select.campos').html(data);
		});
		$('#AgregarCampo').modal('hide');
	});
});

$(document).on('click', '.unlink', function(){
	$.post('../carga/ajax/unlink.php', {file: $(this).attr('attr')}, function() {
		$("#listUploaded").load('../carga/ajax/listUploaded.php',function(){
			$('.dataTable1').dataTable({
				"lengthMenu": [
					[2, 5, 10, -1],
					[2, 5, 10, "Todos"]
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

$("body").on("click","#listTag .listTag .pk",function(){
	if($(this).hasClass("Off")){
		$("#listTag .listTag .pk").removeClass("On");
		$("#listTag .listTag .pk").addClass("Off");
		$(this).removeClass("Off");
		$(this).addClass("On");
	}else{
		$(this).removeClass("On");
		$(this).addClass("Off");
	}
});

$("#ProcessTables").click(function(){
	$.ajax({
		type: "POST",
		url: "../carga/ajax/procesarTablasTemporales.php",
		beforeSend: function(){
			$('#Cargando').modal({
				backdrop: 'static',
				keyboard: false
			})
		},
		success: function(result){
			$('#Cargando').modal('hide');
			var json = JSON.parse(result);
			if(json.Result == "1"){
				var Message = "<h2><center>Tablas procesadas satisfactoriamente<center><h2>";
				Message += "<br>";
				Message += "Cantidad de Ruts almacenados: "+json.Resume.Registros;
				Message += "<br>";
				Message += "Total de Deuda almacenada:"+formatDollar(Number(json.Resume.TotalDeuda));
				bootbox.alert(Message);
				$("#TableStatus a").removeClass("list-group-item-success");
				$("#TableStatus a").addClass("list-group-item-danger");
			}else{
				bootbox.alert("Hubo un problema por favor verifique las tablas");
			}
		},
		error: function(){
		}
	});
});

function formatDollar(num) {
    var p = num.toFixed(2).split(".");
    return "$" + p[0].split("").reverse().reduce(function(acc, num, i, orig) {
        return  num=="-" ? acc : num + (i && !(i % 3) ? "," : "") + acc;
    }, "") + "." + p[1];
}

getTableStatus();
var Tables;
function getTableStatus(){
	$.post('../carga/ajax/getTableStatus.php', {}, function(data) {
		Tables = JSON.parse(data);
		if(Tables.Persona){
			$("#TablePersona").removeClass("list-group-item-danger");
			$("#TablePersona").addClass("list-group-item-success");
		}
		if(Tables.Deuda){
			$("#TableDeuda").removeClass("list-group-item-danger");
			$("#TableDeuda").addClass("list-group-item-success");
		}
		if(Tables.FonoCob){
			$("#TableFono").removeClass("list-group-item-danger");
			$("#TableFono").addClass("list-group-item-success");
		}
		if(Tables.Direcciones){
			$("#TableDirecciones").removeClass("list-group-item-danger");
			$("#TableDirecciones").addClass("list-group-item-success");
		}
		if(Tables.Mail){
			$("#TableMail").removeClass("list-group-item-danger");
			$("#TableMail").addClass("list-group-item-success");
		}
	});
}
