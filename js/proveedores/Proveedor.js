$(document).ready(function(){

    ProveedorTable = $('#ProveedorTable').DataTable({
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

    $('body').on( 'click', '#AddProveedor', function () {
        bootbox.dialog({
            title: "Agregar Proovedor",
            message: $("#ProveedorForm").html(),
            buttons: {
                success: {
                    label: "Guardar",
                    className: "btn-purple",
                    callback: function() {
                        var data = $('#storeProveedor').serialize();
                        $.ajax({
                            type: "POST",
                            url: "../includes/proveedores/storeProveedor.php",
                            data:data,
                            success: function(response){

                                if(response.status == 1){

                                    $.niftyNoty({
                                        type: 'success',
                                        icon : 'fa fa-check',
                                        message : 'Registro Guardado Exitosamente',
                                        container : 'floating',
                                        timer : 3000
                                    });

                                    var rowNode = ProveedorTable.row.add([
                                      ''+response.array.nombre+'',
                                      ''+response.array.direccion+'',
                                      ''+response.array.telefono+'',
                                      ''+response.array.contacto+'',
                                      ''+response.array.correo+'',
                                    ]).draw(false).node();

                                      $( rowNode ).attr('id',response.array.id)

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
                                        message : 'Ocurrio un error en el Proceso',
                                        container : 'floating',
                                        timer : 3000
                                    });
                                }
                               
                            }
                        });
                    }
                }
            }
        }).off("shown.bs.modal");
    });

    $('body').on( 'click', '.Update', function () {
        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        ObjectTR.addClass("Selected");
        var ObjectId= ObjectTR.attr("id");
        var ObjectName = ObjectTR.find("td").eq(0);
        var ObjectAddress = ObjectTR.find("td").eq(1);
        var ObjectTelephone = ObjectTR.find("td").eq(2);
        var ObjectContact = ObjectTR.find("td").eq(3);
        var ObjectEmail = ObjectTR.find("td").eq(4);
        var Template = $("#ProveedorFormUpdate").html();
        Template = Template.replace("{ID}",ObjectId);
        Template = Template.replace("{NOMBRE}",ObjectName.html());
        Template = Template.replace("{DIRECCION}",ObjectAddress.html());
        Template = Template.replace("{TELEFONO}",ObjectTelephone.html());
        Template = Template.replace("{CONTACTO}",ObjectContact.html());
        Template = Template.replace("{CORREO}",ObjectEmail.html());

        bootbox.dialog({
            title: "Actualizar Proveedor",
            message: Template,
            buttons: {
                success: {
                    label: "Guardar",
                    className: "btn-purple",
                    callback: function() {
                        var data = $('#updateProveedor').serialize();
                        $.ajax({
                            type: "POST",
                            url: "../includes/proveedores/updateProveedor.php",
                            data:data,
                            success: function(response){

                                if(response.status == 1){

                                    $.niftyNoty({
                                        type: 'success',
                                        icon : 'fa fa-check',
                                        message : 'Registro Actualizado Exitosamente',
                                        container : 'floating',
                                        timer : 3000
                                    });

                                    ObjectTR = $("#"+response.array.id);
                                    console.log(objectTR);
                                    ObjectTR.find("td").eq(0).html(response.array.nombre);
                                    ObjectTR.find("td").eq(1).html(response.array.direccion);
                                    ObjectTR.find("td").eq(2).html(response.array.telefono);
                                    ObjectTR.find("td").eq(3).html(response.array.contacto);
                                    ObjectTR.find("td").eq(4).html(response.array.correo);
                                    

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
                                        message : 'Ocurrio un error en el Proceso',
                                        container : 'floating',
                                        timer : 3000
                                    });
                                }
                               
                            }
                        });
                    }
                }
            }
        }).off("shown.bs.modal");
    });
});