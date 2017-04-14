$(document).ready(function()
{

	$(document).on('change', '#seleccione_cedente', function()
	{
		var id_c = $('#seleccione_cedente').val();
		var id_cedente = "id="+id_c;
		$.ajax(
		{
			type: "POST",
			url: "seleccione_cedente.php",
			data:id_cedente,
			success: function(response)
			{
				$('#div1').html(response);
			}
		});
	});
	$(document).on('change', '#cedente_ges_eje', function()
	{
		var id_c = $('#cedente_ges_eje').val();
		var id_cedente = "id="+id_c;
		var fecha_ini = "fecha_ini="+$('#fecha_ini_eje').val();
		var fecha_fin = "fecha_fin="+$('#fecha_fin_eje').val();
		var data = id_cedente+"&"+fecha_ini+"&"+fecha_fin;
		$.ajax(
		{
			type: "POST",
			url: "gest_eje_periodo.php",
			data:data,
			success: function(response)
			{
				$('#gest_per_eje').html(response);
			}
		});

	});
	$(document).on('change', '#cedente_ges_eje', function()
	{
		var id_c = $('#cedente_ges_eje').val();
		var id_cedente = "id="+id_c;
		var fecha_ini = "fecha_ini="+$('#fecha_ini_eje').val();
		var fecha_fin = "fecha_fin="+$('#fecha_fin_eje').val();
		var data = id_cedente+"&"+fecha_ini+"&"+fecha_fin;
		$.ajax(
		{
			type: "POST",
			url: "gest_ced_periodo.php",
			data:data,
			success: function(response)
			{
				$('#gest_per_ced').html(response);
			}
		});
		$('#fecha_ini_eje').val("");
		$('#fecha_fin_eje').val("");
		$('#fecha_fin_eje').attr("disabled","true");
		$('#cedente_ges_eje').attr("disabled","true");
	});
	$(document).on('change', '#seleccione_estrategia', function()
	{
		var id_e = $('#seleccione_estrategia').val();
		var id_estrategia = "id="+id_e;
		$.ajax(
		{
			type: "POST",
			url: "seleccione_estrategia.php",
			data:id_estrategia,
			success: function(response)
			{

				$('#div2').html(response);
			}
		});
	});
	$(document).on('change', '#seleccione_periodo', function()
	{
		ActualizarGrafico();
		var cedente = $('#seleccione_cedente').val();
		var cola = $('#seleccione_cola').val();
		var periodo = $('#seleccione_periodo').val();
		var data = "cedente="+cedente+"&cola="+cola+"&periodo="+periodo;
		$('#seleccione_periodo').prop('selectedIndex',0);
		console.log(data);

		$.ajax(
		{
			type: "POST",
			url: "include.php",
			data:data,
			success: function(response)
			{

				console.log(response);
				$('#grafico').html(response);


			}
		});

	});
	function ActualizarGrafico()
	{
        var tabla = 'gestion_diaria';
        var cedente = $('#seleccione_cedente').val();
        var lista = $('#seleccione_cola').val();
        var id_gestion = $('#id_gestion').val();
        var tipo = $('#tipo').val();
        $.ajax({
            type: "POST",
            url: "Torta.php",
            data: { tabla: tabla, cedente: cedente, lista: lista, id_gestion : id_gestion , tipo : tipo},
            dataType: "html",
            success: function(data){

                $("#demo-flot-donut").html();
                if(data != "0"){
                    var dataSet = JSON.parse(data);
                    console.log(dataSet);
                    $.plot('#demo-flot-donut', dataSet, {
                        series: {

						        pie: {
					          show: true,
					            radius: 1,
					            label: {
					                show: true,
					                radius: 2/3,
					                formatter: labelFormatter,
					                threshold: 0.1
					            }
					        }
					    },
					    legend: {
					        show: false
					    }


                    });
                }else{
                    $("#demo-flot-donut").html("No se encontraron resultados.");
                }
            },
            error: function(){
                alert('error2');
            }
        });
    }
    function labelFormatter(label, series) {
        var Numero = 0;
        console.log(series);
        switch($("#FormaResultado").val()){
            case 'dias':
                Numero = series.data[0][1];
            break;
            default:
                Numero = Math.round(series.percent) + "%";
            break;
        }
        return "<div style='font-size:6pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Numero + "</div>";
    }
	$(document).on('click', '.nivel1', function()
	{
		var obj = ($(this));
		var id_codigo = $(this).closest('tr').attr('id');
		var id_codigo2 = $(this).closest('tr').attr('class');
		$('#id_gestion').val(id_codigo2);
		$('#tipo').val('2');
		ActualizarGrafico();
		var idcodigo="id="+id_codigo2;
		var total = $("#cant_total").val();
		var total2 = "cant_total="+total;
		var cedente = $('#seleccione_cedente').val();
		var cola = $('#seleccione_cola').val();
		var periodo = $('#seleccione_periodo').val();
		var tipo = $('#tipo').val();
		var data_nivel1 = idcodigo + "&" + total2+"&cedente="+cedente+"&cola="+cola+"&periodo="+periodo+"&tipo="+tipo;
		var remueve_anterior2 = $('#remover4').val();
		remueve_anterior = '.remover' +remueve_anterior2;
		var remover5 = $('#remover5').val();
		$(remover5).remove();


		$(remueve_anterior).remove();

		var remover_ant  = '#d' + remueve_anterior2;
		$(remover_ant).removeClass();
		$(remover_ant).addClass('btn btn-icon icon-lg fa fa-plus-square nivel1');
		$('#remover4').val(id_codigo2);

		$.ajax(
		{
			type: "POST",
			url: "nivel1.php",
			data:data_nivel1,
			success: function(response)
			{
				obj.closest('tr').after(response);
				$('#d' + id_codigo).removeClass();
				$('#d' + id_codigo).addClass('btn btn-icon icon-lg fa fa-minus-square nivel1_minus');

			}
		});
	});

	$(document).on('click', '.nivel1_minus', function()
	{
		var id_codigo2 = $(this).closest('tr').attr('class');
		var id_codigo = $(this).closest('tr').attr('id');
		var remover = '.remover' + id_codigo2;
		ActualizarGrafico();
		$(remover).remove();
		var remover5 = $('#remover5').val();
		$(remover5).remove();
		$('#d' + id_codigo).removeClass();
		$('#d' + id_codigo).addClass('btn btn-icon icon-lg fa fa-plus-square nivel1');
	});

	$(document).on('click', '.nivel2', function()
	{
		var obj = ($(this));
		var id_codigo = $(this).closest('tr').attr('id');
		var id_codigo2 = $(this).closest('tr').attr('class');
		$('#id_gestion').val(id_codigo);
		$('#tipo').val('3');
		ActualizarGrafico();
		var idcodigo="id="+id_codigo;
		var total = $("#cant_total").val();
		var total2 = "cant_total="+total;
		var cedente = $('#seleccione_cedente').val();
		var cola = $('#seleccione_cola').val();
		var periodo = $('#seleccione_periodo').val();
		var tipo = $('#tipo').val();
		var data_nivel2= idcodigo + "&" + total2+"&cedente="+cedente+"&cola="+cola+"&periodo="+periodo+"&tipo="+tipo;
		var remover5 = $('#remover5').val();
		var remover6 = $('#remover6').val();
		$(remover5).remove();
		$(remover6).addClass('btn btn-icon icon-lg fa fa-plus-square nivel2');
		$('#remover5').val('.remove2' + id_codigo);
		$('#remover6').val('#e' + id_codigo);
		$.ajax(
		{
			type: "POST",
			url: "nivel2.php",
			data:data_nivel2,
			success: function(response)
			{
				obj.closest('tr').after(response);
				$('#e' + id_codigo).removeClass();
				$('#e' + id_codigo).addClass('btn btn-icon icon-lg fa fa-minus-square nivel2_minus');

			}
		});
	});

	$(document).on('click', '.nivel2_minus', function()
	{
		var id_codigo2 = $(this).closest('tr').attr('class');
		var id_codigo = $(this).closest('tr').attr('id');
		var remover3 = '.remove2' + id_codigo;
		$('#remover4').val(remover3);
		$(remover3).remove();
		$('#e' + id_codigo).removeClass();
		$('#e' + id_codigo).addClass('btn btn-icon icon-lg fa fa-plus-square nivel2');

	});

	$(document).on('click', '.ver_detalle', function()
	{

		$('html,body').animate({ scrollTop: $("#detalle").offset().top }, 1000);
		var id_n3 = $(this).closest('tr').attr('id');
		var cedente = $('#seleccione_cedente').val();
		var cola = $('#seleccione_cola').val();
		var data_exportable= "id="+id_n3+"&lista="+cola+"&cedente="+cedente;
		$.ajax(
		{
			type: "POST",
			url: "exportable.php",
			data:data_exportable,
			success: function(response)
			{

				$('#detalle').html(response);
				$('#tabla_super').DataTable();

			}
		});
	});
	$(document).on('click', '.download', function()
	{

		$('html,body').animate({ scrollTop: $("#detalle").offset().top }, 1000);
		var id_n3 = $(this).closest('tr').attr('id');
		var cedente = $('#seleccione_cedente').val();
		var cola = $('#seleccione_cola').val();
		var data_exportable= "id="+id_n3+"&lista="+cola+"&cedente="+cedente;
		$.ajax(
		{
			type: "POST",
			url: "descargable.php",
			data:data_exportable,
			success: function(response)
			{

				$('#detalle').html(response);

			}
		});
	});
	$('#fecha_ini_eje').change(function(){
		var minimo = $('#fecha_ini_eje').val();
		$('#fecha_fin_eje').removeAttr("disabled");
		$('#fecha_fin_eje').attr("min",minimo);
	});
	$('#fecha_fin_eje').change(function(){
		$('#cedente_ges_eje').removeAttr("disabled");
	});
});
