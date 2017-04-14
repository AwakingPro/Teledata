$(document).ready(function() {
listarTablas();
var TablaCampos;
var datosTabla;
var nombreTabla;
$("body").on("click",".agregarCampo",function(){
    var ObjectMe = $(this);
    var ObjectDiv = ObjectMe.closest("div");
    var idTabla = ObjectDiv.attr("id"); 
    bootbox.dialog({
            title: "Campos",
            message: $("#listaCamposNoConfigurados").html(),
            buttons: {
                success: {
                    label: "Agregar",
                    className: "btn-primary",
                    callback: function() {
                        //var idTabla = $('#tablaBD').val();
                        //var idCampos = $('#camposTabla').val(); 
                        var nombreCampo = $("#campoBD option:selected").html(); 
                        /*if ((idTabla == 0) || (idTabla == ""))
                        {
                          CustomAlert("Debe seleccionar una tabla");
                          return false;
                        }
                        if ((idCampos == 0) || (idCampos == "") || (idCampos == null))
                        {
                          CustomAlert("Debe seleccionar minimo un campo");
                          return false;
                        }     
                        addTabla(idTabla,idCampos,GlobalData.id_cedente,nombreTabla);*/              
                        //insertaModificaCampos(myArray,idTabla);     

                       TablaCampos.row.add({
                         nombre: nombreCampo, 
                         tipo_dato: "",
                         orden: "",
                         logica: "",
                         Actions: ""
                       });
                       TablaCampos.draw(); 
                 
                       
                    }
                }                
            },
            //size: 'large'
       }).off("shown.bs.modal");
      var myArray = [];
                        TablaCampos.rows().eq(0).each( function ( index ) {
                        var array = [];
                        var row = TablaCampos.row( index );
                        var data;
                        data = row.data();
                        $.each(data,function(indexCol,value){
                            switch(indexCol){
                            case 'nombre':
                            //alert(value);
                            //alert(indexCol);
                            //myArray = [i] = value;
                            myArray.push(value);
                            break;
            }
                            //array.push(value);
                        });
                        //myArray.push(array);
                    }); 
      FiltrarCamposNoConfig(nombreTabla,myArray);
      var valorDiv = $("#nomtabla2").html();
      $("#nomtabla2").html(valorDiv + "<b>"+nombreTabla+"</b>"); 

});

  /*
   *  Muestra los campos no configurados de la tabla en cuestion
  */
  function FiltrarCamposNoConfig(nombreTabla,camposArray){
       $.ajax({
          type: "POST",
          url: "../includes/estrategia/GetListar_camposNoConfig.php",
          dataType: "html",
          data: {nombreTabla: nombreTabla, camposArray:camposArray},
          success: function(data){
              $("#campoBD").html(data);
              $("#campoBD").selectpicker('refresh');
          },
          error: function(){    
 
          }
      });
  }


  /*
    *  Lista las tablas correspondientes para configurar campos
  */
function listarTablas(){
        $.ajax({
            type: "POST",
            url: "../includes/estrategia/GetListar_Tablas.php",
            //data: data,
            dataType: "json",
            success: function(data){

                datosTabla = $('#listaTablas').DataTable({
                    data: data, // este es mi json
                    columns: [
                        { data : 'nombre' }, // campos que trae el json
                        { data: 'Actions' }
                    ],
                     "columnDefs": [
                      
                        {
                            "targets": 1,
                            "data": 'Actions',
                            "render": function( data, type, row ) {
                                return "<div style='text-align: center;' id='"+data+"'><i style='cursor: pointer; margin: 0 10px;' class='configurar ti-settings btn btn-primary btn-icon icon-lg'></div>";
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
    *  Formulario configurar campos
   */

    $('body').on( 'click', '.configurar', function () {
        var ObjectMe = $(this);
                         var ObjectDiv = ObjectMe.closest("div");
                         var idTabla = ObjectDiv.attr("id"); 
        nombreTabla = $(this).parents("tr").find("td").eq(0).html();  // obtenfo o que tiene el td  
          
        //$('#camposTabla').val()      
        bootbox.dialog({
            title: "Configuración de Campos",
            message: $("#configurarCampos").html(),
            buttons: {
                success: {
                    label: "Guardar",
                    className: "btn-primary",
                    callback: function() {
                        //var idTabla = $('#tablaBD').val();
                        //var idCampos = $('#camposTabla').val(); 
                        //var nombreTabla = $("#tablaBD option:selected").html(); 
                        /*if ((idTabla == 0) || (idTabla == ""))
                        {
                          CustomAlert("Debe seleccionar una tabla");
                          return false;
                        }
                        if ((idCampos == 0) || (idCampos == "") || (idCampos == null))
                        {
                          CustomAlert("Debe seleccionar minimo un campo");
                          return false;
                        }     
                        addTabla(idTabla,idCampos,GlobalData.id_cedente,nombreTabla);*/      
                        
                         TablaCampos.draw();
                        var myArray = [];
                        TablaCampos.rows().eq(0).each( function ( index ) {
                        var array = [];
                        var row = TablaCampos.row( index );
                        var data;
                        data = row.data();
                        $.each(data,function(indexCol,value){
                            array.push(value);
                        });
                        myArray.push(array);
                    });
                    
                         

                        insertaModificaCampos(myArray,idTabla); 
                        CustomAlert("Datos actualizados satisfactoriamente");   
                         
                 
                       
                    }
                }                
            },
            size: 'large'
       }).off("shown.bs.modal");
       listarCamposConfigurados(idTabla);
       var valorDiv = $("#nomtabla").html();
       $("#nomtabla").html(valorDiv + "<b>"+nombreTabla+"</b>");   
    });



  /*
    * Inserta y modifica los campos configurados
  */

  function insertaModificaCampos(arrayCampos, idTabla){        
        $.ajax({
            type: "POST",
            url: "../includes/estrategia/campos_config_creaModi.php",
            dataType: "html",
            data: { arrayCampos: arrayCampos, idTabla:idTabla },
            success: function(data){
           
            },
            error: function(){

            }
        });
    }


    $("body").on("change","select.RefreshTable", function(){
        var ObjectMe = $(this);
        var Value = ObjectMe.val();
        var Row = ObjectMe.attr("row");
        var ObjectTD = ObjectMe.closest("td");
        var cell = TablaCampos.cell( ObjectTD );
        cell.data( Value );
    });
    function listarCamposConfigurados(idTabla){
         $.ajax({
            type: "POST",
            url: "../includes/estrategia/GetListar_camposConfig.php",
            data: {idTabla: idTabla},
            dataType: "json",
            success: function(data){
                TablaCampos = $('#listaCampos').DataTable({
                    data: data, // este es mi json
                    "iDisplayLength": 5,
                    "pageLength": 5,
                    "bLengthChange": false,
                    columns: [
                        { data : 'nombre' }, // campos que trae el json
                        { data : 'tipo_dato' },
                        { data : 'orden' },
                        { data : 'logica' },
                        { data: 'Actions' }
                    ],
                     "columnDefs": [                      

                        {
                            "targets": 1,
                            "data": 'tipo_dato',
                            "render": function( data, type, row ) {
                                var ToReturn = "";
                                var SelectedOne = "";
                                var SelectedTwo = "";
                                var SelectedThree = "";
                                var SelectedFour = "";
                                switch(data){
                                    case '0':
                                        SelectedOne = "selected='selected'";
                                    break;
                                    case '1':
                                        SelectedTwo = "selected='selected'";
                                    break;
                                    case '2':
                                        SelectedThree = "selected='selected'";
                                    break;
                                    case '3':
                                        SelectedFour = "selected='selected'";
                                    break;
                                }
                                ToReturn = "<select style='display: block !important;' class='selectpicker form-control RefreshTable' row='tipo_dato' title='Seleccione' data-live-search='true' data-width='100%' ><option value=''>Seleccione</option><option "+SelectedOne+" value='0'>Int</option><option "+SelectedTwo+" value='1'>Date</option><option "+SelectedThree+" value='2'>Varchar</option><option "+SelectedFour+" value='3'>Distinct</option></select>";
                                return ToReturn;
                            }
                        },
                        {
                            "targets": 2,
                            "data": 'orden',
                            "render": function( data, type, row ) {
                                var ToReturn = "";
                                var SelectedOne = "";
                                var SelectedTwo = "";
                                switch(data){
                                    case '0':
                                        SelectedOne = "selected='selected'";
                                    break;
                                    case '1':
                                        SelectedTwo = "selected='selected'";
                                    break;
                                }
                                ToReturn = "<select style='display: block !important;' class='selectpicker form-control RefreshTable' row='orden' title='Seleccione' data-live-search='true' data-width='100%'><option value=''>Seleccione</option><option "+SelectedOne+" value='0'>ASC</option><option "+SelectedTwo+" value='1'>DESC</option></select>";
                                return ToReturn;
                            }
                        },
                         {
                            "targets": 3,
                            "data": 'logica',
                            "render": function( data, type, row ) {
                                var ToReturn = "";
                                var SelectedOne = "";
                                var SelectedTwo = "";
                                switch(data){
                                    case '0':
                                        SelectedOne = "selected='selected'";
                                    break;
                                    case '1':
                                        SelectedTwo = "selected='selected'";
                                    break;
                                }
                                ToReturn = "<select style='display: block !important;' class='selectpicker form-control RefreshTable' row='logica' title='Seleccione' data-live-search='true' data-width='100%'><option value=''>Seleccione</option><option "+SelectedOne+" value='0'>Todas</option><option "+SelectedTwo+" value='1'>Igual o Distinto</option></select>";
                                return ToReturn;
                            }
                        },

                        {
                            "targets": 4,
                            "data": 'Actions',
                            "render": function( data, type, row ) {
                                return "<div style='text-align: center;' id='"+data+"'><i style='cursor: pointer; margin: 0 10px;' class='eliminar fa fa-trash btn btn-danger btn-icon icon-lg'></div>";
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
    * Eliminar campo configurado
  */
  $("body").on("click",".eliminar", function(){
        var ObjectMe = $(this);
        var ObjectDiv = ObjectMe.closest("div");
        var ID = ObjectDiv.attr("id");
        var ObjectTR = ObjectMe.closest("tr");

        bootbox.confirm("¿Esta seguro que desea eliminar el campo?", function(result) {
            if (result) {
                if (ID != "")
                {
                  eliminarCampo(ObjectTR, ID);
                }else
                {
                  TablaCampos.row(ObjectTR).remove().draw();
                  $("#listaCampos").trigger('update');    
                }
                
            }

        });
    }); 

    function eliminarCampo(TableRow, ID){
        $.ajax({
            type: "POST",
            url: "../includes/estrategia/eliminar_campoConfig.php",
            dataType: "html",
            data: {
                idCampo: ID
            },
            success: function(data){
                TablaCampos.row(TableRow).remove().draw();
                $("#listaCampos").trigger('update');                
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

    function AddClassModalOpen(){
        setTimeout(function(){
            if($("body").hasClass("modal-open")){
                $("body").removeClass("modal-open");
            }
        }, 500);
    }


});
