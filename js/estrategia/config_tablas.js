$(document).ready(function() {

listarTablas();
var TablaCampos;
  /*
    *  Lista las tablas (por cedente)
  */
function listarTablas(){
        var idCedente = $('#cedente').val();       
        var data = "idCedente="+idCedente;
        $.ajax({
            type: "POST",
            url: "../includes/estrategia/GetListar_TablasCedente.php",
            data: data,
            dataType: "json",
            success: function(data){
                TablaCampos = $('#listaTablas').DataTable({
                    data: data, // este es mi json
                    paging: false,
                    columns: [
                        { data : 'nombre' }, // campos que trae el json
                        { data: 'Actions' }
                    ],
                     "columnDefs": [
                      
                        {
                            "targets": 1,
                            "data": 'Actions',
                            "render": function( data, type, row ) {
                                return "<div style='text-align: center;' id='"+data+"'><i style='cursor: pointer; margin: 0 10px;' class='btn eliminar fa fa-trash btn-danger btn-icon icon-lg'></i><i style='cursor: pointer; margin: 0 10px;' class='fa fa-pencil-square-o btn btn-primary btn-icon icon-lg modificar'></div>";
                            }
                        }
                    ]
                }); 
            },
            error: function(){
            }
        });
 }
  
   /*
    *  Formulario Registrar nueva tabla (por cedente)
   */

    $('body').on( 'click', '#AddTabla', function () {
       bootbox.dialog({
            title: "Formulario de Registro de tablas por Cedente",
            message: $("#RegistrarTablas").html(),
            buttons: {
                success: {
                    label: "Guardar",
                    className: "btn-primary",
                    callback: function() {
                        var idTabla = $('#tablaBD').val();
                        var idCampos = $('#camposTabla').val(); 
                        var nombreTabla = $("#tablaBD option:selected").html(); 
                        if ((idTabla == 0) || (idTabla == ""))
                        {
                          CustomAlert("Debe seleccionar una tabla");
                          return false;
                        }
                        if ((idCampos == 0) || (idCampos == "") || (idCampos == null))
                        {
                          CustomAlert("Debe seleccionar minimo un campo");
                          return false;
                        }     
                        addTabla(idTabla,idCampos,GlobalData.id_cedente,nombreTabla);                      
                       
                    }
                }                
            }
       }).off("shown.bs.modal");
       FiltrarTablas(GlobalData.id_cedente);
       resetearCombo();
       //AddClassModalOpen();
    });

  /*
   *  Muestra las tablas que el cedente aun no tiene registradas
  */
    function FiltrarTablas(idCedente){
        $.ajax({
            type: "POST",
            url: "../includes/estrategia/GetFiltrar_Tablas.php",
            //dataType: "html",
            data: {idCedente: idCedente},
            success: function(data){
                $("select[name='tablaBD']").html(data);
                $("select[name='tablaBD']").selectpicker('refresh');
            },
            error: function(){             
            }
        });
    }

  /*
   *  Muestra los campos configurados de la tabla
  */
  function FiltrarCampos(idTabla){
      $.ajax({
          type: "POST",
          url: "../includes/estrategia/GetFiltrar_Campos.php",
          dataType: "html",
          data: {idTabla: idTabla},
          success: function(data){
              console.log(data);
              $("#camposTabla").html(data);
              $("#camposTabla").selectpicker('refresh');
          },
          error: function(){    
 
          }
      });
  }

   /*
   *  Muestra los campos configurados de la tabla
   */

  $("body").on("change","#tablaBD",function(){
      var idTabla = $('#tablaBD').val();
      if ((idTabla != 0) || (idTabla != ""))
      {
        FiltrarCampos(idTabla);
      }else {
        resetearCombos();
      }
  });

  /*
    * Resetear combo
  */
  function resetearCombo()
  {
    $('#tablaBD').val("");
    $("#tablaBD").selectpicker('refresh');
    $("#camposTabla").html("<option value='0'>Seleccione</option>");
    $("#camposTabla").selectpicker('refresh');
  }
  /*
    * Registrar nueva tabla (por cedente)
  */

  function addTabla(idTabla,campos,idCedente,nombreTabla){        
        $.ajax({
            type: "POST",
            url: "../includes/estrategia/registrar_tabla.php",
            dataType: "html",
            data: { idTabla: idTabla, campos: campos, idCedente: idCedente },
            success: function(data){
                    TablaCampos.row.add(
                        {
                            "nombre": nombreTabla,
                            "Actions": idTabla
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
        bootbox.confirm("¿Esta seguro que desea eliminar la tabla?", function(result) {
            if (result) {
                //DeleteEvaluation(ObjectTR, ID);
                eliminarTabla(ObjectTR, ID, GlobalData.id_cedente);
            }
            //AddClassModalOpen();
        });
    }); 

    /*
    * Pop up Eliminar tabla al cedente
  */
  $("body").on("click",".modificar", function(){
        var ObjectMe = $(this);
        var ObjectDiv = ObjectMe.closest("div");
        var ID = ObjectDiv.attr("id");
        var ObjectTR = ObjectMe.closest("tr");
        bootbox.dialog({
            title: "Formulario de Registro de tablas por Cedente",
            message: $("#ModificarTablas").html(),
            buttons: {
                success: {
                    label: "Modificar",
                    className: "btn-primary",
                    callback: function() {
                        var idTabla = $('#UpdatetablaBD').val();
                        var idCampos = $('#UpdatecamposTabla').val(); 
                        var nombreTabla = $("#UpdatetablaBD option:selected").html(); 
                        if ((idTabla == 0) || (idTabla == ""))
                        {
                          CustomAlert("Debe seleccionar una tabla");
                          return false;
                        }
                        if ((idCampos == 0) || (idCampos == "") || (idCampos == null))
                        {
                          CustomAlert("Debe seleccionar minimo un campo");
                          return false;
                        }
                        updateCampos();
                        //addTabla(idTabla,idCampos,GlobalData.id_cedente,nombreTabla);                      
                       
                    }
                }                
            }
       }).off("shown.bs.modal");
       getOptionsFromTablesWithSelectedID(ID);
       getOptionsFromColumnsWithSelectedID(ID);
    }); 

  function AddClassModalOpen(){
        setTimeout(function(){
            if($("body").hasClass("modal-open")){
                $("body").removeClass("modal-open");
            }
        }, 500);
    }

    
    function eliminarTabla(TableRow, ID, idCedente){
        $.ajax({
            type: "POST",
            url: "../includes/estrategia/eliminar_tablaConfig.php",
            dataType: "html",
            data: {
                idTabla: ID, idCedente: idCedente
            },
            success: function(data){
                TablaCampos.row(TableRow).remove().draw();
                $("#listaTablas").trigger('update');                
            },
            error: function(){

            }
        });
    }

    function CustomAlert(Message){
        bootbox.alert(Message,function(){
            AddClassModalOpen();
        });
    }
    function getOptionsFromTablesWithSelectedID(IdTabla){
        $.ajax({
            type: "POST",
            url: "../includes/estrategia/getOptionsFromTablesWithSelectedID.php",
            dataType: "html",
            data: {table: IdTabla},
            success: function(data){
                $("select[name='UpdatetablaBD']").html(data);
                $("select[name='UpdatetablaBD']").selectpicker('refresh');
            },
            error: function(){             
            }
        });
    }
    function getOptionsFromColumnsWithSelectedID(IdTabla){
        $.ajax({
            type: "POST",
            url: "../includes/estrategia/getOptionsFromColumnsWithSelectedID.php",
            dataType: "html",
            data: {table: IdTabla},
            success: function(data){
                $("select[name='UpdatecamposTabla']").html(data);
                $("select[name='UpdatecamposTabla']").selectpicker('refresh');
            },
            error: function(){             
            }
        });
    }
    $("body").on("change","select[name='UpdatetablaBD']",function(){
        var idTabla = $(this).val();
        if ((idTabla != 0) || (idTabla != "")){
            FiltrarCampos(idTabla);
            $.ajax({
                type: "POST",
                url: "../includes/estrategia/GetFiltrar_Campos.php",
                dataType: "html",
                data: {idTabla: idTabla},
                success: function(data){
                    $("#UpdatecamposTabla").html(data);
                    $("#UpdatecamposTabla").selectpicker('refresh');
                },
                error: function(){    

                }
            });
        }else{
            $('#UpdatetablaBD').val("");
            $("#UpdatetablaBD").selectpicker('refresh');
            $("#UpdatecamposTabla").html("");
            $("#UpdatecamposTabla").selectpicker('refresh');
        }
    });
    function updateCampos(){
        var CamposArray = [];
        $("#UpdatecamposTabla option").each(function(index){
            var array = [];
            var Bool = 0;
            array[0] = $(this).val();
            if($(this).prop("selected")){
                Bool = 1;
            }
            array[1] = Bool;
            CamposArray.push(array);
        });
        $.ajax({
            type: "POST",
            url: "../includes/estrategia/updateColumsFromTable.php",
            dataType: "html",
            data: {columns: JSON.stringify(CamposArray)},
            success: function(data){
                if(data == "1"){
                    CustomAlert("Tabla actualizada satisfactoriamente");
                }
            },
            error: function(){             
            }
        });
    }
});