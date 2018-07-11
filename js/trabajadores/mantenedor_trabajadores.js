$(document).ready(function() {

    var TablaTrabajadores;
    listarTrabajadores();

/*
** Lista las empresas registradas en BD
*/
function listarTrabajadores(){        
        $.ajax({
            type: "POST",
            url: "../includes/trabajador/GetListarTrabajadores.php",
            //data: data,
            dataType: "json",
            success: function(data){
                TablaTrabajadores = $('#listaTrabajadores').DataTable({
                    data: data, // este es mi json
                    paging: false,
                    columns: [
                        { data : 'nombre' }, // campos que trae el json
                        { data : 'usuario' },
                        { data : 'email' },
                        { data: 'Actions' }
                    ],
                     "columnDefs": [
                      
                        {
                            "targets": 3,
                            "data": 'Actions', 
                            "render": function( data, type, row ) {
                                return "<div style='text-align: center;' id='"+data+"'><i style='cursor: pointer; margin: 0 10px;' class='btn eliminar fa fa-trash btn-danger btn-icon icon-lg'></i><i style='cursor: pointer; margin: 0 10px;' class='fa fa-pencil-square-o btn btn-primary btn-icon icon-lg modificar'></div>";
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

/*
** Formulario Registro de trabajadores
*/
$('body').on( 'click', '#AddTrabajador', function () {
        bootbox.dialog({
            title: "Registro de Trabajador",
            message: $("#RegistrarTrabajador").html(),
            buttons: {
                success: {
                    label: "Guardar",
                    className: "btn-primary",
                    callback: function() {
                        var nombre = $('#nombreTrabajador').val();
                        var email = $('#correoTrabajador').val(); 
                        var telefono = $('#telefonoTrabajador').val();
                        var direccion = $('#direccionTrabajador').val();
                        if ((nombre == "") || (email == "") || (telefono == "") || (direccion == ""))
                        {
                          CustomAlert("Debe ingresar todos los datos");
                          return false;
                        }                                                  
                        addTrabajador(nombre,telefono,email,direccion);                       
                    }
                }                
            }
       }).off("shown.bs.modal");
       $('#date-range .input-daterange').datepicker({
            format: "yyyy/mm/dd",
                weekStart: 1,
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
            language: 'es'
        });
        mostrarCargos();
        mostrarRegiones();
        mostrarNacionalidades();
});  


/*
** Guarda en BD una empresa nueva
*/
function addTrabajador(nombre, telefono, email, direccion){      
        $.ajax({
            type: "POST",
            url: "../includes/trabajador/crear_trabajador.php",
            dataType: "html",
            data: { nombre: nombre, telefono: telefono, email: email, direccion: direccion },
            success: function(data){
                CustomAlert("Trabajador registrado exitosamente!");
                location.reload();
         
            },
            error: function(){
                alert('errorTrabajador');
            }
        });
}


/*
** Formulario Modificacion de trabajadores
*/
$('body').on( 'click', '.modificar', function () {   
        var ObjectMe = $(this);
        var ObjectDiv = ObjectMe.closest("div");
        var idTrabajador = ObjectDiv.attr("id");     
        bootbox.dialog({
            title: "Modificar Trabajador",
            message: $("#ModificarTrabajador").html(),
            buttons: {
                success: {
                    label: "Guardar",
                    className: "btn-primary",
                    callback: function() {
                        var nombre = $('#nombreTrabajador').val();
                        var email = $('#correoTrabajador').val(); 
                        var telefono = $('#telefonoTrabajador').val();
                        var direccion = $('#direccionTrabajador').val();
                        if ((nombre == "") || (email == "") || (telefono == "") || (direccion == ""))
                        {
                          CustomAlert("Debe ingresar todos los datos");
                          return false;
                        }                                                  
                        modificaTrabajador(nombre, telefono, email, direccion, idTrabajador);                      
                    }
                }                
            }
       }).off("shown.bs.modal");
       //FiltrarTablas(GlobalData.id_cedente);
       //resetearCombo();
       //AddClassModalOpen();           
       getDatosTrabajador(idTrabajador);
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
** Trae los datos de un trabajador en especifico
*/
function getDatosTrabajador(idTrabajador)
  {
    $.ajax({
        type:"POST",
        data: {idTrabajador: idTrabajador},
        dataType: "json",
        url:"../includes/trabajador/GetDatosTrabajador.php",
        success:function(data){          
            console.log(data);
            //data = data[0];
           
            $('#nombreTrabajador').val(data.nombre);
            $('#correoTrabajador').val(data.email);            
            $('#telefonoTrabajador').val(data.telefonoMovil);
            $('#direccionTrabajador').val(data.direccion);            
          },
          error: function(){             
            alert('errorrrrrrDatostrabajador');
          }          
    });
  }

/*
** Modifica trabajador
*/
function modificaTrabajador(nombre, telefono, email, direccion, idTrabajador){      
        $.ajax({
            type: "POST",
            url: "../includes/trabajador/modifica_trabajador.php",
            dataType: "html",
            data: { nombre: nombre, telefono: telefono, email: email, direccion: direccion, idTrabajador: idTrabajador },
            success: function(data){
                alert(data);
                CustomAlert("Trabajador modificado exitosamente!");
                location.reload();
         
            },
            error: function(){
                alert('errormodificaTrabajador');
            }
        });
}

$("body").on("click",".eliminar", function(){
        var ObjectMe = $(this);
        var ObjectDiv = ObjectMe.closest("div");
        var ID = ObjectDiv.attr("id");
        var ObjectTR = ObjectMe.closest("tr");
        bootbox.confirm("¿Esta seguro que desea eliminar el Trabajador?", function(result) {
            if (result) {
                eliminarTrabajador(ObjectTR, ID);                
            }
        });
});


function eliminarTrabajador(TableRow, ID){
    $.ajax({
        type: "POST",
        url: "../includes/trabajador/eliminarTrabajador.php",
        dataType: "html",
        data: { idTrabajador: ID },
        success: function(data){
            alert(data);
            CustomAlert("El trabajador ha sido eliminado");
            TablaTrabajadores.row(TableRow).remove().draw();
            $("#listaTrabajadores").trigger('update');                
        },
        error: function(){

        }
    });
} 


 /*
    *  Validando campo email
  */ 
 $('body').on( 'blur', '#correoTrabajador', function ( event ) { 
     event.preventDefault();
    // Expresion regular para validar el correo
    if ($('#correoTrabajador').val().trim() != "")
    {
      var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
      // Se utiliza la funcion test() nativa de JavaScript
      if (!(regex.test($('#correoTrabajador').val().trim())))
      {
        $('#correoTrabajador').val("");
        CustomAlert("La dirección de correo no es valida!");    
      }
    }
  });


  /*
   *  Muestra los cargos de los trabajadores
  */
    function mostrarCargos(){
        $.ajax({
            type: "POST",
            url: "../includes/trabajador/GetListarCargos.php",
            //dataType: "html",
            data: {},
            success: function(data){
                
                $("select[name='cargoBD']").html(data);
                $("select[name='cargoBD']").selectpicker('refresh');
            },
            error: function(){   
                alert('errormostrarcargos');          
            }
        });
    }

  /*
   *  Muestra las nacionalidades
  */
    function mostrarNacionalidades(){
        $.ajax({
            type: "POST",
            url: "../includes/trabajador/GetListarNacionalidad.php",
            //dataType: "html",
            data: {},
            success: function(data){                
                $("select[name='nacionalidadTrabajador']").html(data);
                $("select[name='nacionalidadTrabajador']").selectpicker('refresh');
            },
            error: function(){   
                alert('errormostrarcargos');          
            }
        });
    }


  /*
  * Lista las provinciaes dependiendo de la region seleccionada
  */ 
  $('body').on( 'change', '#regionTrabajador', function ( event ) { 
      var idRegion = $('#regionTrabajador').val();
      if ((idRegion != 0) || (idRegion != ""))
      {
        FiltrarProvinciaes(idRegion);
      }else {
        //resetearCombos();
      }
  });

  /*
    * busca provinciaes dependiendo de la region seleccionada
  */
  function FiltrarProvinciaes(idRegion){
      $.ajax({
          type: "POST",
          url: "../includes/trabajador/GetListarProvinciaes.php",
          dataType: "html",
          data: {idRegion: idRegion},
          success: function(data){
              alert(data);
              $("select[name='provinciaTrabajador']").html(data);
              $("select[name='provinciaTrabajador']").selectpicker('refresh');
          },
          error: function(){
              alert('errorfiltrarprovinciaes');
          }
      });
  }

   /*
  * Lista las comunas dependiendo de la provincia seleccionada
  */ 
  $('body').on( 'change', '#provinciaTrabajador', function ( event ) { 
      var idProvincia = $('#provinciaTrabajador').val();
      if ((idProvincia != 0) || (idProvincia != ""))
      {
        FiltrarComunas(idProvincia);
      }else {
        //resetearCombos();
      }
  });

  /*
    * busca comunas dependiendo de la provincia seleccionada
  */
  function FiltrarComunas(idProvincia){
      $.ajax({
          type: "POST",
          url: "../includes/trabajador/GetListarComunas.php",
          dataType: "html",
          data: {idProvincia: idProvincia},
          success: function(data){
              alert(data);
              $("select[name='comunaTrabajador']").html(data);
              $("select[name='comunaTrabajador']").selectpicker('refresh');
          },
          error: function(){
              alert('errorfiltrarcomunas');
          }
      });
  }



  /*
   *  Muestra las regiones
  */
    function mostrarRegiones(){
        $.ajax({
            type: "POST",
            url: "../includes/trabajador/GetListarRegiones.php",
            //dataType: "html",
            data: {},
            success: function(data){
                $("select[name='regionTrabajador']").html(data);
                $("select[name='regionTrabajador']").selectpicker('refresh');
            },
            error: function(){   
                alert('errormostrarregiones');          
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
