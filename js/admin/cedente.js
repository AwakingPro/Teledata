$(document).ready(function() {
    var tablaCedente;
    listarCedentes();

    function listarCedentes(){
        //var idCedente = $('#cedente').val();       
        //var data = "idCedente="+idCedente;
        $.ajax({
            type: "POST",
            url: "../includes/admin/GetListar_Cedentes.php",
            //data: data,
            dataType: "json",
            success: function(data){
                TablaCedente = $('#listaCedentes').DataTable({
                    data: data, // este es mi json
                    paging: false,
                    columns: [
                        { data : 'nombre' }, // campos que trae el json
                        { data: 'Actions' }
                    ],
                     "columnDefs": [
                      
                        {
                            "targets": 1,
                            "data": 'Actions', //<i style='cursor: pointer; margin: 0 10px;' class='fa fa-pencil-square-o btn btn-primary btn-icon icon-lg modificar'>
                            "render": function( data, type, row ) {
                                return "<div style='text-align: center;' id='"+data+"'><i style='cursor: pointer; margin: 0 10px;' class='btn eliminar fa fa-trash btn-danger btn-icon icon-lg'></i></div>";
                            }
                        }
                    ]
                }); 
            },
            error: function(){
                alert('erroryujuuu');
            }
        });
    }  

    $('body').on( 'click', '#AddCedente', function () {
       bootbox.dialog({
            title: "Registro de Cedente",
            message: $("#RegistrarCedente").html(),
            buttons: {
                success: {
                    label: "Guardar",
                    className: "btn-primary",
                    callback: function() {
                        var nombreCedente = $('#nombreCedente').val();
                        var fechaIngreso = $('#fechaIngreso').val(); 
                        if ((nombreCedente == 0) || (nombreCedente == ""))
                        {
                          CustomAlert("Debe ingresar el nombre del cedente");
                          return false;
                        }
                        if ((fechaIngreso == 0) || (fechaIngreso == "") || (fechaIngreso == null))
                        {
                          CustomAlert("Debe seleccionar la fecha de ingreso del cedente");
                          return false;
                        }  
                        addCedente(nombreCedente,fechaIngreso);
                       
                    }
                }                
            }
       }).off("shown.bs.modal");
       //FiltrarTablas(GlobalData.id_cedente);
       //resetearCombo();
       //AddClassModalOpen();
       $('#date-range .input-daterange').datepicker({
            format: "yyyy/mm/dd",
                weekStart: 1,
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
            language: 'es'
        });
    }); 


    function addCedente(nombreCedente, fechaIngreso){      
        $.ajax({
            type: "POST",
            url: "../includes/admin/crear_cedente.php",
            dataType: "html",
            data: { nombreCedente: nombreCedente, fechaIngreso: fechaIngreso },
            success: function(data){
                CustomAlert("Cedente ingresado exitosamente!");
                location.reload();
                    /*TablaCedente.row.add(
                        {
                            "fechaTermino": nombre,
                            "Actions": idCedente // OJOOOOOOOOOOO
                        }
                   ).draw(false);    */            
            },
            error: function(){
                alert('error');
            }
        });
    }

    function CustomAlert(Message){
        bootbox.alert(Message,function(){
            AddClassModalOpen();
        });
    } 

    function AddClassModalOpen(){
        setTimeout(function(){
            if($("body").hasClass("modal-open")){
                $("body").removeClass("modal-open");
            }
        }, 500);
    }

    $("body").on("click",".eliminar", function(){
        var ObjectMe = $(this);
        var ObjectDiv = ObjectMe.closest("div");
        var ID = ObjectDiv.attr("id");
        var ObjectTR = ObjectMe.closest("tr");
        bootbox.confirm("¿Esta seguro que desea eliminar el cedente?", function(result) {
            if (result) {
                eliminarCedente(ObjectTR, ID);                
            }
            //AddClassModalOpen();
        });
    }); 

    function eliminarCedente(TableRow, ID){
        $.ajax({
            type: "POST",
            url: "../includes/admin/eliminar_cedente.php",
            dataType: "html",
            data: {
                idCedente: ID
            },
            success: function(data){
                CustomAlert("El cedente ha sido eliminado");
                TablaCedente.row(TableRow).remove().draw();
                $("#listaCedentes").trigger('update');                
            },
            error: function(){

            }
        });
    }  

});    