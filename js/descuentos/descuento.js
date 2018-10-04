$(document).ready(function(){

    $(".number").mask("00");

    $('select[name="Rut"]').load('../ajax/servicios/selectClientes.php',function(){
		$('select[name="Rut"]').selectpicker();
    });
    
    $('.IdServicio').selectpicker();
    $('.IdTicket').selectpicker();
    getDescuentos();

    function getDescuentos(){
        $.ajax({
            type: "POST",
            url: "../includes/descuentos/getDescuentos.php",
            success: function(data){

                DescuentoTable = $('#DescuentoTable').DataTable({
                    paging: false,
                    iDisplayLength: 100,
                    processing: true,
                    serverSide: false,  
                    bInfo:false,
                    order: [[0, 'desc']],
                    data: data,
                    columns: [
                        { data: 'Cliente' },
                        { data: 'Codigo' },
                        { data: 'Porcentaje' },
                        { data: 'Cantidad' },
                        { data: 'CantidadUtilizada' },
                        { data: 'IdTicket' },
                        { data: 'Usuario' },
                        { data: 'Id' }
                    ],
                    destroy: true,
                    'createdRow': function( row, data, dataIndex ) {
                        $(row)
                            .attr('id',data.Id)
                            .addClass('text-center')
                    },
                    "columnDefs": [
                        {
                            "targets": 7,
                            "render": function (data, type, row) {
                                if(!row.idUsuario){
                                    Check = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-check Check"></i> '
                                    Update = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i> ' 
                                }else{
                                    Check = ' '
                                    Update = ' '
                                }
                                return Check + Update + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times Remove"></i>';
                            }
                        },
                    ],
                    language: {
                        processing:     "Procesando ...",
                        search:         'Buscar',
                        lengthMenu:     "Mostrar _MENU_ Registros",
                        info:           "Mostrando _START_ a _END_ de _TOTAL_ Registros",
                        infoEmpty:      "Mostrando 0 a 0 de 0 Registros",
                        infoFiltered:   "(filtrada de _MAX_ registros en total)",
                        infoPostFix:    "",
                        loadingRecords: "...",
                        zeroRecords:    "No se encontraron registros coincidentes",
                        emptyTable:     "No hay datos disponibles en la tabla",
                        paginate: {
                            first:      "Primero",
                            previous:   "Anterior",
                            next:       "Siguiente",
                            last:       "Ultimo"
                        },
                        aria: {
                            sortAscending:  ": habilitado para ordenar la columna en orden ascendente",
                            sortDescending: ": habilitado para ordenar la columna en orden descendente"
                        }
                    }
                });

                $('[data-toggle="popover"]').popover();
                $('table').css('width', '100%');
            }
        });
    }

    $(document).on('change', 'select[name="Rut"]', function() {
        $('select[name="IdTicket"]').load('../ajax/tickets/listNroTickets.php',{Rut:$(this).selectpicker('val')},function(data){
            $('select[name="IdTicket"]').selectpicker('refresh');
        });
        $('#IdServicio').empty();
        $.ajax({
            type: "POST",
            url: "../includes/nota_venta/showCodigos.php",
            data: { 
                personaempresa_id: $(this).selectpicker('val')
            },
            success: function(response){
                $.each(response.array, function( index, array ) {
                    $('#IdServicio').append('<option value="'+array.Id+'">'+array.Codigo+'</option>');
                });
                $('#IdServicio').selectpicker('refresh');
            }
        })
    });


    $('body').on('click', '#guardarDescuento', function () {

        $.postFormValues('../includes/descuentos/storeDescuento.php', '#storeDescuento', {}, function(response){

            if(response.status == 1){

                getDescuentos();
                $('#storeDescuento')[0].reset();
                $('.modal').modal('hide');

            }else if(response.status == 2){

                $.niftyNoty({
                    type: 'danger',
                    icon : 'fa fa-check',
                    message : 'Debe llenar todos los campos',
                    container : 'floating',
                    timer : 3000
                });

            }else if(response.status == 3){

                $.niftyNoty({
                    type: 'danger',
                    icon : 'fa fa-check',
                    message : 'Debe ingresar un porcentaje valido',
                    container : 'floating',
                    timer : 3000
                });

            }else{

                $.niftyNoty({
                    type: 'danger',
                    icon : 'fa fa-check',
                    message : 'Ocurrió un error en el Proceso',
                    container : 'floating',
                    timer : 3000
                });

            }
        });     
    });

    $('body').on('click', '.Check', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectId = ObjectTR.attr("id");

        swal({   
            title: "Desea aprobar este descuento? Tenga en cuenta que no podra ser modificado despues de ser aprobado",   
            text: "Confirmar aprobación!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#28a745",   
            confirmButtonText: "Aprobar!",  
            cancelButtonText: "Cancelar",         
            closeOnConfirm: true 
        },function(isConfirm){   
            if (isConfirm) {
                $.ajax({
                    url: "../includes/descuentos/aprobarDescuento.php",
                    type: 'POST',
                    data:"&id="+ObjectId,
                    success:function(response){
                        setTimeout(function() {
                            if(response.status == 1){
                                swal("Éxito!","El descuento ha sido aprobado!","success");
                                getDescuentos();
                            }else if(response.status == 3){
                                swal('Solicitud no procesada','Este registro no puede ser eliminado porque posee otros registros asociados','error');
                            }else{
                                swal('Solicitud no procesada','Ha ocurrido un error, intente nuevamente por favor','error');
                            }
                        }, 1000);  
                    },
                    error:function(){
                        swal('Solicitud no procesada','Ha ocurrido un error, intente nuevamente por favor','error');
                    }
                });
            }
        });
    });

    $('body').on( 'click', '.Update', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        ObjectTR.addClass("Selected");
        var ObjectId = ObjectTR.attr("id");
        var ObjectName = ObjectTR.find("td").eq(0).text();
        var ObjectLimit = ObjectTR.find("td").eq(1).text();
        $('#updateDescuento').find('input[name="id"]').val(ObjectId);
        $('#updateDescuento').find('input[name="nombre"]').val(ObjectName);
        $('#updateDescuento').find('input[name="limite_facturas"]').val(ObjectLimit);

        $('#DescuentoFormUpdate').modal('show');
  
    });


    $('body').on('click', '#actualizarDescuento', function () {

        $.postFormValues('../includes/descuentos/updateDescuento.php', '#updateDescuento', {}, function(response){
       
            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Actualizado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });
                getDescuentos();
                
                $('.modal').modal('hide');

            }else if(response.status == 2){
                $.niftyNoty({
                    type: 'danger',
                    icon : 'fa fa-check',
                    message : 'Debe llenar todos los campos',
                    container : 'floating',
                    timer : 3000
                });
            }else{
                $.niftyNoty({
                    type: 'danger',
                    icon : 'fa fa-check',
                    message : 'Ocurrió un error en el Proceso',
                    container : 'floating',
                    timer : 3000
                });
            }
                   
      
        });  
    });

    $('body').on('click', '.Remove', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectId = ObjectTR.attr("id");

        swal({   
            title: "Desea eliminar este registro?",   
            text: "Confirmar eliminación!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#28a745",   
            confirmButtonText: "Eliminar!",  
            cancelButtonText: "Cancelar",         
            closeOnConfirm: true 
        },function(isConfirm){   
            if (isConfirm) {
    
                $.ajax({
                    url: "../includes/descuentos/deleteDescuento.php",
                    type: 'POST',
                    data:"&id="+ObjectId,
                    success:function(response){
                        setTimeout(function() {
                            if(response.status == 1){
                                swal("Éxito!","El registro ha sido eliminado!","success");
                                getDescuentos();
                            }else if(response.status == 3){
                                swal('Solicitud no procesada','Este registro no puede ser eliminado porque posee otros registros asociados','error');
                            }else{
                                swal('Solicitud no procesada','Ha ocurrido un error, intente nuevamente por favor','error');
                            }
                        }, 1000);  
                    },
                    error:function(){
                        swal('Solicitud no procesada','Ha ocurrido un error, intente nuevamente por favor','error');
                    }
                });
            }
        });
    });
});