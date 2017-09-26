$(document).ready(function(){

    $('.date').datetimepicker({
        locale: 'es',
        format: 'DD-MM-YYYY'
    });

    PendientesTable = $('#PendientesTable').DataTable({
        "columnDefs": [ {
            "targets": [ 0 ],
            "orderable": false
        } ],
        paging: false,
        iDisplayLength: 100,
        processing: true,
        serverSide: false,
        bInfo:false,
        bFilter:false,
        order: [[1, 'asc']],
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

    AsignadasTable = $('#AsignadasTable').DataTable({
        paging: false,
        iDisplayLength: 100,
        processing: true,
        serverSide: false,
        bInfo:false,
        bFilter:false,
        order: [[1, 'asc']],
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
        url: "../includes/inventario/bodegas/showPersonal.php",
        success: function(response){

            $.each(response.array, function( index, array ) {
                $('.IdUsuarioAsignado').append('<option value="'+array.id+'" data-content="'+array.nombre+'"></option>');
            });

            setTimeout(function(){
                $('.IdUsuarioAsignado').selectpicker('refresh');
            },500)
        
        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/tareas/showServicios.php",
        success: function(response){

            $.each(response.array, function( index, array ) {

                if(array.Usuario){
                    Usuario = array.Usuario
                }else{
                    Usuario = ''
                }

                if(array.Estatus == 1){

                    var rowNode = FinalizadasTable.row.add([
                        ''+Usuario+'',
                        ''+array.Cliente+'',
                        ''+array.Codigo+'',
                        ''+array.TiepoFacturacion+'',
                        ''+array.Descripcion+'',
                        ''+array.Grupo+''
                    ]).draw(false).node();

                    $( rowNode )
                        .attr('id',array.Id)
                        .addClass('text-center')
                }else{

                    if(array.IdUsuarioAsignado != 0){

                        var rowNode = AsignadasTable.row.add([
                            ''+Usuario+'',
                            ''+array.Cliente+'',
                            ''+array.Codigo+'',
                            ''+array.TiepoFacturacion+'',
                            ''+array.Descripcion+'',
                            ''+array.Grupo+'',
                            ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-tasks Assign"></i> <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Edit"></i>'+'',
                        ]).draw(false).node();

                        $( rowNode )
                            .attr('id',array.Id)
                            .addClass('text-center')
                    }else{
                        var rowNode = PendientesTable.row.add([
                            ''+'<input name="select_check" id="select_check_"'+array.Id+' type="checkbox" />'+'',
                            ''+array.Cliente+'',
                            ''+array.Codigo+'',
                            ''+array.TiepoFacturacion+'',
                            ''+array.Descripcion+'',
                            ''+array.Grupo+''
                        ]).draw(false).node();

                        $( rowNode )
                            .attr('id',array.Id)
                            .addClass('text-center')
                    }
                    
                }
            });
        }
    });

    $('#AsignarModal').click(function () {

        Tareas = getChecked();
        Tareas = Tareas.join();
        $('#Tareas').val(Tareas)

        $('#modalAsignar').modal('show');
  
    });

    $('body').on('click', '#Asignar', function () {

        $.postFormValues('../includes/tareas/asignarTareas.php', '#asignarTareas', function(response){

            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Guardado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                Usuario = response.Usuario

                $.each(response.array, function( index, Id ) {

                    Row = $('#'+Id)
                    Cliente = $(Row).find("td").eq(1).html();
                    Codigo = $(Row).find("td").eq(2).html();
                    TiepoFacturacion = $(Row).find("td").eq(3).html();
                    Descripcion = $(Row).find("td").eq(4).html();
                    Grupo = $(Row).find("td").eq(5).html();

                    var rowNode = AsignadasTable.row.add([
                        ''+Usuario+'',
                        ''+Cliente+'',
                        ''+Codigo+'',
                        ''+TiepoFacturacion+'',
                        ''+Descripcion+'',
                        ''+Grupo+'',
                        ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-tasks Assign"></i> <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Edit"></i>'+'',
                    ]).draw(false).node();

                    $(rowNode)
                        .attr('id',Id)
                        .addClass('text-center')

                    PendientesTable.row($('#'+Id))
                        .remove()
                        .draw();
                });
             

                $('#asignarTareas')[0].reset();
                $('.selectpicker').selectpicker('refresh')
                $('#select_all').prop('checked', false);
                $("#AsignarModal").attr("disabled","disabled");
                $("#AsignarModal").css({
                    "opacity": ("0.2")
                });
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

    $('body').on('click', '#Reasignar', function () {

        $.postFormValues('../includes/tareas/reasignarTarea.php', '#reasignarTarea', function(response){

            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Guardado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                Usuario = response.Usuario
                Row = $('#'+response.Id)
                Cliente = $(Row).find("td").eq(0).html(Usuario);
                 
                $('#reasignarTarea')[0].reset();
                $('.selectpicker').selectpicker('refresh')
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

    $('body').on( 'click', 'i.fa-pencil', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        ObjectTR.addClass("Selected");
        var ObjectId = ObjectTR.attr("id");
        var ObjectCode = ObjectTR.find("td").eq(2).text();
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
                Usuario = $(Row).find("td").eq(0).html();
                Cliente = $(Row).find("td").eq(1).html();
                Codigo = $(Row).find("td").eq(2).html();
                TiepoFacturacion = $(Row).find("td").eq(3).html();
                Descripcion = $(Row).find("td").eq(4).html();
                Grupo = $(Row).find("td").eq(5).html();

                var rowNode = FinalizadasTable.row.add([
                    ''+Usuario+'',
                    ''+Cliente+'',
                    ''+Codigo+'',
                    ''+TiepoFacturacion+'',
                    ''+Descripcion+'',
                    ''+Grupo+'',
                ]).draw(false).node();

                $(rowNode)
                    .attr('id',response.Id)
                    .addClass('text-center')

                AsignadasTable.row($('#'+response.Id))
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

    $('body').on( 'click', 'i.fa-tasks', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        ObjectTR.addClass("Selected");
        var ObjectId = ObjectTR.attr("id");
        var ObjectCode = ObjectTR.find("td").eq(2).text();
        $('#reasignarTarea').find('input[name="Id"]').val(ObjectId);
        $('.Codigo').text(ObjectCode);

        $('#modalReasignar').modal('show');
  
    })

    function getChecked(){

        var checked = [];

        $('#PendientesTable tr').each(function (i, row) {
            var actualrow = $(row);
            checkbox = actualrow.find('input:checked').val();
            if(checkbox == 'on'){
                var id = $(actualrow).attr('id');
                checked[i] = id;
            }
        });

        return checked;
    }

    $('#select_all').on('click', function(){
        var rows = PendientesTable.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);

        values = getChecked();

        if(values.length > 0){

            $("#AsignarModal").removeAttr("disabled");
            $("#AsignarModal").css({
                "opacity": ("1")
            });

        }else{
            $("#AsignarModal").attr("disabled","disabled");
            $("#AsignarModal").css({
            "opacity": ("0.2")
            });
        }
    });

    $('#PendientesTable tbody').on( 'click', 'input[type="checkbox"]', function () {
        values = getChecked();

        if(values.length > 0){

            $("#AsignarModal").removeAttr("disabled");
            $("#AsignarModal").css({
            "opacity": ("1")
            });

        }else{
            $("#AsignarModal").attr("disabled","disabled");
            $("#AsignarModal").css({
                "opacity": ("0.2")
            });
        }
    });
});