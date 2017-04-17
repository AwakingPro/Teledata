$(document).ready(function(){

    function VerServicios(){
        $.ajax({
            type: "POST",
            url: "../includes/clientes/MostrarServicios.php",
            data:"Rut="+$("#Rut").val(),
            success: function(response){
                $('#DivServicios').html(response);
                $("#tabla1").dataTable();
            }
        });    
    }
    function LimpiarDatos(){
        var Facturacion = "<b>Datos de Facturación</b><div class='list-divider'></div> Seleccione Cliente.";
        
        $('#DivServicios').html('Seleccione Cliente.');
        $('#DatosTecnicos').html('');
        $('#VerClientes').html(Facturacion);
    }



    $("#Crear").click(function(){
        var Nombre = $("#Nombre").val();
        var Rut = $("#Rut").val();
        var Dv = $("#Dv").val();
        var data = "Nombre="+Nombre+"&Rut="+Rut+"&Dv="+Dv;
        $.ajax({
            type: "POST",
            url: "../includes/clientes/crear.php",
            data:data,
            success: function(response){
                if(response==1){
                    $.niftyNoty({
                        type: 'success',
                        icon : 'fa fa-check',
                        message : 'Registro Guardado Exitosamente',
                        container : 'floating',
                        timer : 2000
                    });
                }else{
                    $.niftyNoty({
                        type: 'danger',
                        icon : 'fa fa-check',
                        message : 'Ocurrio un error en el Proceso',
                        container : 'floating',
                        timer : 2000
                    });
                }
               
            }
        });    
    });

    $("#TipoBusqueda").change(function(){
        var data = '';
        if($(this).val()==1){
             data="data=1";
        }
        else{
            data="data=2";
        }
        $.ajax({
            type: "POST",
            url: "../includes/clientes/TipoBusqueda.php",
            data:data,
            success: function(response){
                $("#Tipo").html(response);
                $('#Dato').selectpicker('refresh');
            }
        }); 
        LimpiarDatos();
       
   }); 

   $(document).on('change', '#Dato', function() {
       $("#Rut").val($(this).val());
       $("#buscar").prop('disabled',false);
        
   });

   $(document).on('click', '#buscar', function() {
        var Rut = $("#Rut").val();
        var data = "Rut="+Rut;
        $.ajax({
            type: "POST",
            url: "../includes/clientes/VerCliente.php",
            data:data,
            success: function(response){
                $("#VerClientes").html(response);
                VerServicios();
                $('#DatosTecnicos').html('');
            }
        }); 
   });

   


    $(document).on('click', '#AgregaProducto', function() {
        $.ajax({
            type: "POST",
            url: "../includes/clientes/Servicios.php",
            data:'',
            success: function(response){
                bootbox.dialog({
                    title: "Agregar Servicio ",
                    message:response,
                    buttons: {
                        success: {
                            label: "Guardar",
                            className: "btn-mint",
                            callback: function() {
                                
                                var IdServicio =  $('#SeleccioneServicio').val();
                                var IdTipo =  $('#SeleccioneTipo').val();
                                var Rut = $("#Rut").val();
                                var Descripcion = $("#Descripcion").val();
                                var data = "Rut="+Rut+"&IdServicio="+IdServicio+"&Descripcion="+Descripcion+"&IdTipo="+IdTipo;
                                
                                $.ajax({
                                    type: "POST",
                                    url: "../includes/clientes/AgregaServicios.php",
                                    data:data,
                                    success: function(response){
                                        if(response==1){
                                            $.niftyNoty({
                                                type: 'mint',
                                                icon : 'fa fa-check',
                                                message : 'Servicio Agregado Exitosamente',
                                                container : 'floating',
                                                timer : 4000
                                            });
                                            VerServicios();
                                            $('#DatosTecnicos').html('');

                                        }
                                        else{
                                            $.niftyNoty({
                                                type: 'danger',
                                                icon : 'fa fa-close',
                                                message : 'Ocurrio un error en el proceso!',
                                                container : 'floating',
                                                timer : 4000
                                            });
                                        }      
                                    }
                                }); 
                            }
                        }
                    }
                });
            }
        });
    });


    $(document).on('change', '#SeleccioneTipo', function() {
        var IdTipo = $("#SeleccioneTipo").val();
        var data = "IdTipo="+IdTipo;
        $.ajax({
            type: "POST",
            url: "../includes/clientes/SeleccioneServicioTipo.php",
            data:data,
            success: function(response){
                $('#TipoServicio').html(response);
            }
        });       
    });

    $(document).on('click','.VerServicio',function(){
        var Bg = $('#bg').val();
        $('.bg'+Bg).removeClass('bg-mint');
        var Id = $(this).closest('tr').attr('id');
        var Class = ".bg"+Id;
        $(Class).addClass('bg-mint');
        $("#bg").val(Id);
        $('html,body').animate({ scrollTop: $("#DatosTecnicos").offset().top}, 1000);
        var Rut = $('#Rut').val();
        var data = 'Rut='+Rut+"&Id="+Id;
        $.ajax({
            type: "POST",
            url: "../includes/clientes/VerDatosTecnicos.php",
            data:data,
            success: function(response){
                $('#DatosTecnicos').html(response);
            }
        });   
    });    
});