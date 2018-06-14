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
        var startDate = $("#date-range .input-daterange input[name='start']").val();
        var endDate = $("#date-range .input-daterange input[name='end']").val();
        if (startDate != '' & endDate != '') {
            url = "../ajax/compras_ingresos/generarReporte.php?startDate="+startDate+"&endDate="+endDate;
            window.open(url, '_blank');
        } else {
            bootbox.alert('Debe Seleccionar un rango de fecha')
            return false;
        }
    });
});