$(document).ready(function(){
    
    $('select[name="rutCliente"]').load('../ajax/servicios/selectClientes.php', function() {
        $('select[name="rutCliente"]').selectpicker();
        $('select[name="rutCliente"]').selectpicker('refresh');
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
        
        // console.log(rut);
        if (tipo_informe != '') {
            if(tipo_informe == '1'){
                url = "../ajax/informes/exportarExcelClientes.php?startDate="+startDate+"&endDate="+endDate+"&rut="+rut;
                window.open(url, '_blank');
            }

            if(tipo_informe == '2'){
                
                url = "../ajax/informes/exportarExcelPagosMensualesAnuales.php?startDate="+startDate+"&endDate="+endDate;
                if(rut != '')
                url = url+"&rut="+rut;
                window.open(url, '_blank');
            
            }
            if(tipo_informe == '3'){
                url = "../ajax/informes/exportarExcelCobranzaCliente.php";
                window.open(url, '_blank');
            }
            if(tipo_informe == '4'){
                url = "../ajax/informes/exportarExcelPagosCliente.php?";
                if(rut != ''){
                    url = url+"rut="+rut;
                    window.open(url, '_blank');
                }else{
                    bootbox.alert('Debe Seleccionar un Cliente');
                    return false;
                }
                
            }
            if(tipo_informe == '5'){
                url = "../ajax/informes/exportarExcelEstadoClientes.php";
                window.open(url, '_blank');
            }
            if(tipo_informe == '6'){
                if (startDate != '' & endDate != '') {
                    url = "../ajax/informes/exportarExcelLibroVentas.php?startDate="+startDate+"&endDate="+endDate;
                } else {
                    url = "../ajax/informes/exportarExcelLibroVentas.php";
                }
                
                window.open(url, '_blank');
            }
        } else {
            bootbox.alert('Debe Seleccionar un Informe a Emitir');
            return false;
        }
    });
});