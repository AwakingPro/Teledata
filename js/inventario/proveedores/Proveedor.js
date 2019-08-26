$(document).ready(function(){

    Table = $('#ProveedorTable').DataTable({
        paging: false,
        iDisplayLength: 100,
        processing: true,
        serverSide: false,  
        bInfo:false,
        order: [[0, 'asc']],
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

    $.ajax({
        type: "POST",
        url: "../includes/inventario/proveedores/showProveedores.php",
        success: function(response){

            $.each(response.array, function( index, array ) {

                var rowNode = Table.row.add([
                    ''+array.rut+'-'+array.dv+'',
                    ''+array.nombre+'',
                    ''+array.direccion+'',
                    ''+array.telefono+'',
                    ''+array.contacto+'',
                    ''+array.correo+'',
                    ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times Remove"></i>'+'',
                ]).draw(false).node();

                $( rowNode ).attr('id',array.id).addClass('text-center');
                $( rowNode ).attr('Rut',array.rut).addClass('text-center');
                $( rowNode ).attr('Dv',array.dv).addClass('text-center');
            });
        
            
        }
    });

    $('body').on('click', '#guardarProveedor', function () {

        var data = $('#storeProveedor').serialize();
        var array = $('#storeProveedor').serializeArray();
        
        if(ValidarString(array[0].value, 'Rut') && ValidarString(array[1].value, 'Nombre') && ValidarString(array[2].value, 'Dirección') && ValidarString(array[3].value, 'Télefono') && ValidarString(array[4].value, 'Contacto') && ValidarCorreo(array[5].value)){

            $.ajax({
                type: "POST",
                url: "../includes/inventario/proveedores/storeProveedor.php",
                data:data,
                beforeSend: function( ) {
                    $('#guardarProveedor').attr('disabled', 'disabled');
                    $('.cargando').html('<div style="text-align:center; font-size:15px;">Enviando Solicitud...</div><div class="spinner loading"></div>');
                  },
                success: function(response){
                    $('.cargando').html('');
                    $('#guardarProveedor').attr('disabled', false);
                    if(response.status == 1){

                        $.niftyNoty({
                            type: 'success',
                            icon : 'fa fa-check',
                            message : 'Registro Guardado Exitosamente',
                            container : 'floating',
                            timer : 3000
                        });
                        var rowNode = Table.row.add([
                            ''+response.array.rut+'-'+response.array.dv+'',
                            ''+response.array.nombre+'',
                            ''+response.array.direccion+'',
                            ''+response.array.telefono+'',
                            ''+response.array.contacto+'',
                            ''+response.array.correo+'',
                            ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times Remove"></i>'+'',
                        ]).draw(false).node();

                        $( rowNode ).attr('id',response.array.id).addClass('text-center');
                        $( rowNode ).attr('Rut',response.array.rut).addClass('text-center');
                        $( rowNode ).attr('Dv',response.array.dv).addClass('text-center');

                        $('#storeProveedor')[0].reset();
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
                }
            });
        }      
    });

    
    $('input[name="rut"]').on('blur', function() {

        rut = $(this).val()
        input = $(this)

        if (rut) {
            $.post('../ajax/inventario/proveedores/listProveedor.php', { rut: rut }, function(data) {
                data = $.parseJSON(data);
                if (data.length) {
                    swal({
                        title: "Este rut ya esta registrado",
                        text: "Desea modificarlo?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#28a745",
                        confirmButtonText: "Si",
                        cancelButtonText: "No",
                        closeOnConfirm: true,
                        allowOutsideClick: false
                    }, function(isConfirm) {
                        if (isConfirm) {
                            $('#updateProveedor').find('input[name="id"]').val(data[0].id);
                            $('#updateProveedor').find('input[name="nombre"]').val(data[0].nombre);
                            $('#updateProveedor').find('textarea[name="direccion"]').text(data[0].direccion);
                            $('#updateProveedor').find('input[name="telefono"]').val(data[0].telefono);
                            $('#updateProveedor').find('input[name="contacto"]').val(data[0].contacto);
                            $('#updateProveedor').find('input[name="correo"]').val(data[0].correo);
                            $('#ProveedorForm').modal('hide');
                            $('#ProveedorFormUpdate').modal('show');
                        } else {
                            $(input).val('')
                        }
                    });
                } else {
                    $.post('../ajax/cliente/getDv.php', { rut: rut }, function(data) {
                        $('#Dv').val(data)
                        $('#DvUpdate').val(data);
                    });
                }
            });
        }
    });

    $('body').on( 'click', '.Update', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        ObjectTR.addClass("Selected");
        var ObjectId = ObjectTR.attr("id");
        $.ajax({
            url: "../includes/inventario/proveedores/showProveedor.php",
            type: 'POST',
            data:"&id="+ObjectId,
            success:function(response){
                $('#updateProveedor').find('input[name="rut"]').val(response.array[0].rut);
                $('#updateProveedor').find('input[name="DvUpdate"]').val(response.array[0].dv);
                $('#updateProveedor').find('input[name="nombre"]').val(response.array[0].nombre);
                $('#updateProveedor').find('textarea[name="direccion"]').text(response.array[0].direccion);
                $('#updateProveedor').find('input[name="telefono"]').val(response.array[0].telefono);
                $('#updateProveedor').find('input[name="contacto"]').val(response.array[0].contacto);
                $('#updateProveedor').find('input[name="correo"]').val(response.array[0].correo);
            },
            error:function(){
                swal('Solicitud no procesada para ver el proveedor','Ha ocurrido un error, intente nuevamente por favor','error');
            }
        });
        
        $('#updateProveedor').find('input[name="id"]').val(ObjectId);

        $('#ProveedorFormUpdate').modal('show');
  
    });


    $('body').on('click', '#actualizarProveedor', function () {

        var data = $('#updateProveedor').serialize();
        var array = $('#updateProveedor').serializeArray();

        if(ValidarString(array[1].value, 'Rut') &&  ValidarString(array[2].value, 'Nombre') && ValidarString(array[3].value, 'Dirección') && ValidarString(array[4].value, 'Télefono')  && ValidarString(array[5].value, 'Contacto') && ValidarCorreo(array[6].value)){
                        
            $.ajax({
                type: "POST",
                url: "../includes/inventario/proveedores/updateProveedor.php",
                data:data,
                beforeSend: function( ) {
                    $('#actualizarProveedor').attr('disabled', 'disabled');
                    $('.cargando').html('<div style="text-align:center; font-size:15px;">Enviando Solicitud...</div><div class="spinner loading"></div>');
                  },
                success: function(response){
                    $('.cargando').html('');
                    $('#actualizarProveedor').attr('disabled', false);
                    if(response.status == 1){

                        $.niftyNoty({
                            type: 'success',
                            icon : 'fa fa-check',
                            message : 'Registro Actualizado Exitosamente',
                            container : 'floating',
                            timer : 3000
                        });


                        ObjectTR = $("#"+response.array.id);
                        ObjectTR.find("td").eq(0).html(response.array.rut+'-'+response.array.dv);
                        ObjectTR.find("td").eq(1).html(response.array.nombre);
                        ObjectTR.find("td").eq(2).html(response.array.direccion);
                        ObjectTR.find("td").eq(3).html(response.array.telefono);
                        ObjectTR.find("td").eq(4).html(response.array.contacto);
                        ObjectTR.find("td").eq(5).html(response.array.correo);
                        
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
                   
                }
            });
        }      
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
                    url: "../includes/inventario/proveedores/deleteProveedor.php",
                    type: 'POST',
                    data:"&id="+ObjectId,
                    beforeSend: function( ) {
                        $('.TableLoader').html('<tr class="odd"><td valign="top" colspan="12" class="dataTables_empty"><div style="text-align:center; font-size:15px;">Enviando Solicitud...</div><div class="spinner loading"></div></td></tr>');
                      },
                    success:function(response){
                        if(response.status == 1){
                            swal("Éxito!","El registro ha sido eliminado!","success");
                            Table.row($(ObjectTR))
                                .remove()
                                .draw();
                        }else if(response.status == 3){
                            swal('Solicitud no procesada','Este registro no puede ser eliminado porque posee otros registros asociados','error');
                        }else{
                            swal('Solicitud no procesada','Ha ocurrido un error, intente nuevamente por favor','error');
                        }
                    },
                    error:function(){
                        swal('Solicitud no procesada','Ha ocurrido un error, intente nuevamente por favor','error');
                    }
                });
            }
        });
    });
});