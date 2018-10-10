$(document).ready(function(){
    
    $('select[name="rutCliente"]').load('../ajax/servicios/selectClientes.php', function() {
        $('select[name="rutCliente"]').selectpicker();
    });

    $('.input-daterange').datepicker({
        format: "dd-mm-yyyy",
        weekStart: 1,
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true,
        language: 'es'
    });

    $(document).on('click', '#Download', function () {
        var tipo_informe = $('#tipo_informe').val();
        var startDate = $("#date-range .input-daterange input[name='start']").val();
        var endDate = $("#date-range .input-daterange input[name='end']").val();
        var rut = $('select[name="rutCliente"]').selectpicker('val');
        
        console.log(rut);
        if (tipo_informe != '') {
            if(tipo_informe == '1'){
                url = "../ajax/informes/exportarExcelClienteServicios.php";
                window.open(url, '_blank');
            }
            if(tipo_informe == '2'){
                if (startDate != '' & endDate != '') {
                    url = "../ajax/informes/exportarExcelPagos.php?startDate="+startDate+"&endDate="+endDate;
                    window.open(url, '_blank');
                } else {
                    bootbox.alert('Debe Seleccionar un rango de fecha')
                    return false;
                }
            }  
        } else {
            bootbox.alert('Debe Seleccionar un Informe a Emitir');
            return false;
        }
    });
});