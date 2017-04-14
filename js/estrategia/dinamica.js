$(document).ready(function(){
    
    var IdCedente = $('#IdCedente').val();
    var DataIdCedente = "IdCedente="+IdCedente;
    $.ajax(
    {
        type: "POST",
        url: "../includes/estrategia/MostrarTabla.php",
        data:DataIdCedente,
        success: function(response)
        {
            $('#DivTabla').html(response);
        }
    }); 

    $(document).on('change', '#SeleccioneTabla', function()
    {
        var IdTabla = $('#SeleccioneTabla').val();
        var DataIdTabla = "IdTabla="+IdTabla;
        $.ajax(
        {
            type: "POST",
            url: "../includes/estrategia/MostrarColumna.php",
            data:DataIdTabla,
            success: function(response)
            {
                $('#DivColumna').html(response);
                $('#SeleccioneColumna').selectpicker('refresh');
            }
        });       
    });   

    $(document).on('change', '#SeleccioneColumna', function()
    {
        var IdColumna = $('#SeleccioneColumna').val();
        var DataIdColumna = "IdColumna="+IdColumna;
        $.ajax(
        {
            type: "POST",
            url: "../includes/estrategia/MostrarLogica.php",
            data:DataIdColumna,
            success: function(response)
            {
                $('#DivLogica').html(response);
                $('#SeleccioneLogica').selectpicker('refresh');
            }
        });       
    }); 

    $(document).on('change', '#SeleccioneLogica', function()
    {
        var IdLogica = $('#SeleccioneLogica').val();
        var Id = $('#Id').val();
        var DataIdLogica = "IdLogica="+IdLogica+"&Id="+Id;
        $.ajax(
        {
            type: "POST",
            url: "../includes/estrategia/MostrarValor.php",
            data:DataIdLogica,
            success: function(response)
            {
                $('#DivValor').html(response);
                $('#SeleccioneValor').selectpicker('refresh');
                
            }
        });       
    }); 

    $(document).on('change', '#SeleccioneValor', function()
    {
        $('#DivCola').html('<input type="text" class="form-control" id="NombreCola">');
    });

     $(document).on('click', '#CrearEstrategia', function()
    {
        var Valor = $('#SeleccioneValor').val();
        var NombreCola = $('#NombreCola').val();
        var Logica = $('#SeleccioneLogica').val();
        var IdColumna = $('#SeleccioneColumna').val();
        var DataQuery = "Valor="+Valor+"&Logica="+Logica+"&NombreCola="+NombreCola+"&IdColumna="+IdColumna;
        $.ajax(
        {
            type: "POST",
            url: "../includes/estrategia/CrearQuery.php",
            data:DataQuery,
            success: function(response)
            {
                alert(response);
            }
        });    
    });
    
});