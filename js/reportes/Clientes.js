$(document).ready(function(){
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
        
        if (tipo_informe != '') {
            if(tipo_informe == '1'){
                url = "../ajax/cliente/exportarExcelCliente.php";
                window.open(url, '_blank');
            }  
        } else {
            bootbox.alert('Debe Seleccionar un Informe a Emitir');
            return false;
        }
        // var startDate = $("#date-range .input-daterange input[name='start']").val();
        // var endDate = $("#date-range .input-daterange input[name='end']").val();
        // if (startDate != '' & endDate != '') {
        //     url = "../ajax/compras_ingresos/generarReporte.php?startDate="+startDate+"&endDate="+endDate;
        //     window.open(url, '_blank');
        // } else {
        //     bootbox.alert('Debe Seleccionar un rango de fecha')
        //     return false;
        // }
    });
});