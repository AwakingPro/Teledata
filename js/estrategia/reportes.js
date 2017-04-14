$(document).ready(function(){
    var Gestion_Anterior;
    getEstrategias();
    $("#Resultado").hide();
    $("#Detalle").hide();
    $("body").on("change","select[name='Estrategia']", function(){
        $("select[name='Periodo']").val("");
        $("select[name='Periodo']").prop("disabled",true);
        $("select[name='Periodo']").selectpicker("refresh");
        $("#Resultado").hide();
        $("#Detalle").hide();
        var id = $(this).val();
        getColasList(id);
        $('#Tabla').html("");
        $("#demo-flot-donut").html("");
    });
    $("body").on("change","select[name='Cola']", function(){
        $("select[name='Periodo']").val("");
        $("select[name='Periodo']").prop("disabled",false);
        $("select[name='Periodo']").selectpicker("refresh");
        $("#Resultado").hide();
        $("#Detalle").hide();
        $('#Tabla').html("");
        $("#demo-flot-donut").html("");
    });
    $("body").on("change","select[name='Periodo']", function(){
        var Periodo = $(this).val();
        var Cola = $("select[name='Cola']").val();
        $.ajax(
		{
			type: "POST",
			url: "../includes/estrategia/fillTablaReporte.php",
			data:{
                Periodo: Periodo,
                Cola: Cola
            },
			success: function(response)
			{
				$('#Tabla').html(response);
                ActualizarGrafico();
                $("#Resultado").show();
			}
		});
    });
    $(document).on('click', '.lvl1', function(){
		var obj = $(this);
		var id_codigo = obj.closest('tr').attr('id');
		var id_codigo2 = obj.closest('tr').attr('class');
		var total = $("#cant_total").val();
		var cola = $("select[name='Cola']").val();
		var periodo = $("select[name='Periodo']").val();
        $("#tipo").val('2');
        $('#detalleContenido').html("");
        Gestion_Anterior = id_codigo2;
        $('#id_gestion').val(id_codigo2);
        if(obj.hasClass("nivel1")){
            $.ajax({
                type: "POST",
                url: "../includes/estrategia/SelectNivel1.php",
                data:{
                    id: id_codigo2,
                    cola: cola,
                    periodo: periodo,
                    tipo: '2',
                    total: total
                },
                beforeSend: function() {
                    $(".removerNivel1").remove();
                    $(".removerNivel2").remove();
                    $(".lvl1").removeClass("fa-minus-square nivel1_minus");
                    $(".lvl1").addClass("fa-plus-square nivel1");
                },
                success: function(response){
                    obj.closest('tr').after(response);
                    obj.removeClass("fa-plus-square nivel1");
                    obj.addClass('btn btn-icon icon-lg fa fa-minus-square nivel1_minus');
                    ActualizarGrafico();
                    $("#Detalle").hide();
                }
            });
        }else{
            $(".removerNivel1").remove();
            $(".removerNivel2").remove();
            $("#tipo").val('1');
            $('#id_gestion').val(Gestion_Anterior);
            $(this).removeClass("fa-minus-square nivel1_minus");
            $(this).addClass("fa-plus-square nivel1");
            ActualizarGrafico();
            $("#Detalle").hide();
        }
	});
    $(document).on('click', '.lvl2', function(){
		var obj = $(this);
		var id_codigo = obj.closest('tr').attr('id');
		var id_codigo2 = obj.closest('tr').attr('class');
		var idcodigo="id="+id_codigo2;
		var total = $("#cant_total").val();
		var cola = $("select[name='Cola']").val();
		var periodo = $("select[name='Periodo']").val();
        $("#tipo").val('3');
        $('#id_gestion').val(id_codigo);
        $('#detalleContenido').html("");
        if(obj.hasClass("nivel2")){
            $.ajax({
                type: "POST",
                url: "../includes/estrategia/SelectNivel2.php",
                data:{
                    id: id_codigo,
                    cola: cola,
                    periodo: periodo,
                    tipo: '3',
                    total: total
                },
                beforeSend: function() {
                    $(".removerNivel2").remove();
                    $(".lvl2").removeClass("fa-minus-square nivel2_minus");
                    $(".lvl2").addClass("fa-plus-square nivel2");
                },
                success: function(response){
                    obj.closest('tr').after(response);
                    obj.removeClass("fa-plus-square nivel2");
                    obj.addClass('btn btn-icon icon-lg fa fa-minus-square nivel2_minus');
                    ActualizarGrafico();
                    $("#Detalle").hide();
                }
            });
        }else{
            $(".removerNivel2").remove();
            $("#tipo").val('2');
            $('#id_gestion').val(Gestion_Anterior);
            obj.removeClass("fa-minus-square nivel2_minus");
            obj.addClass("fa-plus-square nivel2");
            ActualizarGrafico();
            $("#Detalle").hide();
        }
	});
    var TablaDetalle;
    $("body").on('click', '.ver_detalle', function(){

		var id_n3 = $(this).closest('tr').attr('id');
		var cola = $("select[name='Cola']").val();
		$.ajax(
		{
			type: "POST",
			url: "../includes/estrategia/CrearTablaExportable.php",
			data:{
                id: id_n3,
                lista: cola
            },
			success: function(response){
                $("#Detalle").show();
                $('html,body').animate({ scrollTop: $("#detalleContenido").offset().top }, 1000);
				$('#detalleContenido').html(response);
				TablaDetalle = $('#tabla_super').DataTable();
			}
		});
	});
    $("#Exportar").click(function(){
        
        var myTableArray = [];

        $("#tabla_super tr").each(function() {
            var arrayOfThisRow = [];
            var tableData = $(this).find('th');
            if (tableData.length > 0) {
                tableData.each(function() {
                    arrayOfThisRow.push($(this).text());
                });
                myTableArray.push(arrayOfThisRow);
            }
        });
        TablaDetalle.rows().eq(0).each( function ( index ) {
            var arrayOfThisRow = [];
            var row = TablaDetalle.row( index );
            var data = row.data();
            $.each(data, function(key,value) {
                var Valor = value;
                Valor = Valor.replace("<center>","");
                Valor = Valor.replace("</center>","");
                arrayOfThisRow.push(Valor);
            });
            myTableArray.push(arrayOfThisRow);
        });
        myTableArray = JSON.stringify(myTableArray);
        $.ajax({
			type: "POST",
			url: "../includes/estrategia/ExportarReporte.php",
			data:{
                table: myTableArray
            },
			success: function(response){
                var json = JSON.parse(response);
                var $a = $("<a>");
                $a.attr("href",json.file);
                $("body").append($a);
                $a.attr("download","file.xlsx");
                $a[0].click();
                $a.remove();
			}
		});
    });

    function getEstrategias(){
        $.ajax({
            type: "POST",
            url: "../includes/estrategia/fillSelectEstrategias.php",
            dataType: "html",
            data: {
            },
            success: function(data){
                $("select[name='Estrategia']").html(data);
                $("select[name='Estrategia']").selectpicker('refresh');
            },
            error: function(){
            }
        });
    }
    function getColasList(Estrategia){
        $.ajax({
            type: "POST",
            url: "../includes/estrategia/fillSelectColas.php",
            dataType: "html",
            data: {
                Estrategia: Estrategia
            },
            success: function(data){
                $("select[name='Cola']").prop("disabled",false);
                $("select[name='Cola']").html(data);
                $("select[name='Cola']").selectpicker('refresh');
            },
            error: function(){
            }
        });
    }
    function ActualizarGrafico(){
        var tabla = 'gestion_diaria';
        var lista = $("select[name='Cola']").val();
        var id_gestion = $('#id_gestion').val();
        var tipo = $('#tipo').val();
        $.ajax({
            type: "POST",
            url: "../includes/estrategia/GetReportChartData.php",
            data: { tabla: tabla, lista: lista, id_gestion : id_gestion , tipo : tipo},
            dataType: "html",
            success: function(data){
                $("#demo-flot-donut").html("");
                $("#message").html("");
                if(data.trim() != ""){
                    var dataSet = JSON.parse(data);
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
					        show: true
					    }
                    });
                }else{
                    $("#message").html("No se encontraron resultados.");
                }
            },
            error: function(){
                alert('error2');
            }
        });
    }
    function labelFormatter(label, series) {
        var Numero = 0;
        switch($("#FormaResultado").val()){
            case 'dias':
                Numero = series.data[0][1];
            break;
            default:
                Numero = series.percent.toFixed(2) + "%";
            break;
        }
        return "<div style='font-size:6pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Numero + "</div>";
    }
});