$(document).ready(function(){

    $('.date').datetimepicker({
        locale: 'es',
        format: 'DD-MM-YYYY'
    });

    PendientesTable = $('#PendientesTable').DataTable({
        paging: false,
        iDisplayLength: 100,
        processing: true,
        serverSide: false,
        bInfo:false,
        bFilter:false,
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

    FinalizadasTable = $('#FinalizadasTable').DataTable({
        paging: false,
        iDisplayLength: 100,
        processing: true,
        serverSide: false,
        bInfo:false,
        bFilter:false,
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
        url: "../includes/tareas/showServicios.php",
        success: function(response){

            $.each(response.array, function( index, array ) {

                if(array.Estatus == 1){

                    var rowNode = FinalizadasTable.row.add([
                        ''+array.Codigo+'',
                        ''+array.TiepoFacturacion+'',
                        ''+array.Descripcion+'',
                        ''+array.Grupo+'',
                        ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Edit"></i>'+'',
                    ]).draw(false).node();

                    $( rowNode )
                        .attr('id',array.Id)
                        .addClass('text-center')
                }else{
                    var rowNode = PendientesTable.row.add([
                        ''+array.Codigo+'',
                        ''+array.TiepoFacturacion+'',
                        ''+array.Descripcion+'',
                        ''+array.Grupo+'',
                        ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Edit"></i>'+'',
                    ]).draw(false).node();

                    $( rowNode )
                        .attr('id',array.Id)
                        .addClass('text-center')
                }
            });
        }
    });

    $('body').on( 'click', 'i.fa-pencil', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        ObjectTR.addClass("Selected");
        var ObjectId = ObjectTR.attr("id");
        var ObjectCode = ObjectTR.find("td").eq(0).text();
        $('#storeTarea').find('input[name="Id"]').val(ObjectId);
        $('#Codigo').text(ObjectCode);

        $('#modalTarea').modal('show');
  
    });

    $('body').on('click', '#guardarTarea', function () {

        $.postFormValues('../includes/tareas/storeTarea.php', '#storeTarea', function(response){

            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Guardado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                Row = $('#'+response.Id)
                Codigo = $(Row).find("td").eq(0).html();
                TiepoFacturacion = $(Row).find("td").eq(1).html();
                Descripcion = $(Row).find("td").eq(2).html();
                Grupo = $(Row).find("td").eq(3).html();

                var rowNode = FinalizadasTable.row.add([
                    ''+Codigo+'',
                    ''+TiepoFacturacion+'',
                    ''+Descripcion+'',
                    ''+Grupo+'',
                ]).draw(false).node();

                $(rowNode)
                    .attr('id',response.Id)
                    .addClass('text-center')

                PendientesTable.row($('#'+response.Id))
                    .remove()
                    .draw();
             

                $('#storeTarea')[0].reset();
                $('.modal').modal('hide');

            }else if(response.status == 2){

                $.niftyNoty({
                    type: 'danger',
                    icon : 'fa fa-check',
                    message : 'Debe llenar todos los campos',
                    container : 'floating',
                    timer : 3000
                });

            }else if(response.status == 99){

                $.niftyNoty({
                    type: 'danger',
                    icon : 'fa fa-check',
                    message : 'Debe llenar los datos de los productos',
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
});