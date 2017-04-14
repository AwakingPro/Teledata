$(document).ready(function() {
    var TablaPeriodo;
    listarTablas();
    /*
    *  Lista periodos (por cedente)
    */
    function listarTablas(){
        //var idCedente = $('#cedente').val();      
        //var idCedente = GlobalData.id_cedente;
        if (typeof GlobalData.id_cedente == "undefined"){
            idCedente = "";
        }else{
            idCedente = GlobalData.id_cedente;
        }
        var data = "idCedente="+idCedente;
        $.ajax({
            type: "POST",
            url: "../includes/estrategia/GetListar_periodo.php",
            data: data,
            dataType: "json",
            success: function(data){ 
                // si no tengo un cedente seleccionado desactivo el boton --- si el cedente ya tiene un periodo desactivo el boton  
                if((((idCedente == "")) || ((data.length != 0) && (idCedente != "")))){
                    $('#AddPeriodo').attr('disabled', 'disabled');
                }else{
                    $('#AddPeriodo').removeAttr("disabled");
                }    
                TablaPeriodo = $('#listaPeriodo').DataTable({
                    data: data, // este es mi json
                    paging: false,
                    columns: [
                        { data : 'fechaInicio' }, // campos que trae el json
                        { data : 'fechaTermino' },
                        { data: 'Actions' }
                    ],
                     "columnDefs": [
                      
                        {
                            "targets": 2,
                            "data": 'Actions',
                            "render": function( data, type, row ) {
                                return "<div style='text-align: center;' id='"+data+"'><i style='cursor: pointer; margin: 0 10px;' class='btn eliminar fa fa-trash btn-danger btn-icon icon-lg'></i></div>";
                            }
                        }
                    ]
                }); 
            },
            error: function(){
                alert('error');
            }
        });
 }


$('body').on( 'click', '#AddPeriodo', function () {
       bootbox.dialog({
            title: "Registro de periodo por Cedente",
            message: $("#RegistrarPeriodo").html(),
            buttons: {
                success: {
                    label: "Guardar",
                    className: "btn-primary",
                    callback: function() {
                        var fechaInicio = $('#start').val();
                        var fechaFin = $('#end').val(); 
                       /* var nombreTabla = $("#tablaBD option:selected").html(); 
                        if ((idTabla == 0) || (idTabla == ""))
                        {
                          CustomAlert("Debe seleccionar una tabla");
                          return false;
                        }
                        if ((idCampos == 0) || (idCampos == "") || (idCampos == null))
                        {
                          CustomAlert("Debe seleccionar minimo un campo");
                          return false;
                        }     */  
                        addPeriodo(fechaInicio,fechaFin,GlobalData.id_cedente);                    
                        $('#AddPeriodo').attr('disabled', 'disabled');
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


     /*
    * Registrar nueva tabla (por cedente)
  */

  function addPeriodo(fechaInicio,fechaTermino,idCedente){        
        $.ajax({
            type: "POST",
            url: "../includes/estrategia/crear_periodo.php",
            dataType: "html",
            data: { fechaInicio: fechaInicio, fechaTermino: fechaTermino, idCedente: idCedente },
            success: function(data){
                    TablaPeriodo.row.add(
                        {
                            "fechaInicio": fechaInicio,
                            "fechaTermino": fechaTermino,
                            "Actions": idCedente // OJOOOOOOOOOOO id_periodo
                        }
                   ).draw(false);                
            },
            error: function(){

            }
        });
    }


     /*
    * Pop up Eliminar tabla al cedente
  */
  $("body").on("click",".eliminar", function(){
        var ObjectMe = $(this);
        var ObjectDiv = ObjectMe.closest("div");
        var ID = ObjectDiv.attr("id");
        var ObjectTR = ObjectMe.closest("tr");
        bootbox.confirm("¿Esta seguro que desea eliminar el periodo?", function(result) {
            if (result) {
                eliminarPeriodo(ObjectTR, ID, "");
            }
            //AddClassModalOpen();
        });
    }); 

    /*
    ** tipo=Foco o ''
    */
    function eliminarPeriodo(TableRow, ID, tipo){
        $.ajax({
            type: "POST",
            url: "../includes/estrategia/eliminar_periodoGestion.php",
            dataType: "html",
            data: {
                tipo: tipo, idPeriodo: ID
            },
            success: function(data){
                /*TablaPeriodo.row(TableRow).remove().draw();
                $("#listaPeriodo").trigger('update');  */
                $('#AddPeriodo').removeAttr("disabled");
                location.reload();              
            },
            error: function(){

            }
        });
    }




});