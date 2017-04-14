$(document).ready(function() {

var TablaEmpresas;
listarEmpresas();

/*
** Formulario Registro de empresas
*/
$('body').on( 'click', '#AddEmpresa', function () {
        bootbox.dialog({
            title: "Registro de Empresa Externa",
            message: $("#RegistrarEmpresa").html(),
            buttons: {
                success: {
                    label: "Guardar",
                    className: "btn-primary",
                    callback: function() {
                        var nombre = $('#nombreEmpresa').val();
                        var email = $('#correoEmpresa').val(); 
                        var telefono = $('#telefonoEmpresa').val();
                        var direccion = $('#direccionEmpresa').val();
                        if ((nombre == "") || (email == "") || (telefono == "") || (direccion == ""))
                        {
                          CustomAlert("Debe ingresar todos los datos");
                          return false;
                        }                                                  
                        addEmpresa(nombre,telefono,email,direccion);                       
                    }
                }                
            }
       }).off("shown.bs.modal");
}); 
/*
** Guarda en BD una empresa nueva
*/
function addEmpresa(nombre, telefono, email, direccion){      
        $.ajax({
            type: "POST",
            url: "../includes/empresaExterna/crear_empresa.php",
            dataType: "html",
            data: { nombre: nombre, telefono: telefono, email: email, direccion: direccion },
            success: function(data){
                CustomAlert("Empresa registrada exitosamente!");
                location.reload();
         
            },
            error: function(){
                alert('error');
            }
        });
}

/*
** Lista las empresas registradas en BD
*/
function listarEmpresas(){        
        $.ajax({
            type: "POST",
            url: "../includes/empresaExterna/GetListar_empresas.php",
            //data: data,
            dataType: "json",
            success: function(data){
                TablaEmpresas = $('#listaEmpresas').DataTable({
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
                alert('erroryujuuu');
            }
        });
    }  

$("body").on("click",".eliminar", function(){
        var ObjectMe = $(this);
        var ObjectDiv = ObjectMe.closest("div");
        var ID = ObjectDiv.attr("id");
        var ObjectTR = ObjectMe.closest("tr");
        bootbox.confirm("¿Esta seguro que desea eliminar la empresa?", function(result) {
            if (result) {
                eliminarEmpresa(ObjectTR, ID);                
            }
        });
}); 

function eliminarEmpresa(TableRow, ID){
    $.ajax({
        type: "POST",
        url: "../includes/empresaExterna/eliminar_empresa.php",
        dataType: "html",
        data: { idEmpresa: ID },
        success: function(data){
            CustomAlert("La empresa ha sido eliminada");
            TablaEmpresas.row(TableRow).remove().draw();
            $("#listaEmpresas").trigger('update');                
        },
        error: function(){

        }
    });
}  


/*
** Formulario Registro de empresas
*/
$('body').on( 'click', '.modificar', function () {   
        var ObjectMe = $(this);
        var ObjectDiv = ObjectMe.closest("div");
        var idEmpresa = ObjectDiv.attr("id");     
        bootbox.dialog({
            title: "Modificar Empresa Externa",
            message: $("#ModificarEmpresa").html(),
            buttons: {
                success: {
                    label: "Guardar",
                    className: "btn-primary",
                    callback: function() {
                        var nombre = $('#nombreEmpresa').val();
                        var email = $('#correoEmpresa').val(); 
                        var telefono = $('#telefonoEmpresa').val();
                        var direccion = $('#direccionEmpresa').val();
                        if ((nombre == "") || (email == "") || (telefono == "") || (direccion == ""))
                        {
                          CustomAlert("Debe ingresar todos los datos");
                          return false;
                        }                                                  
                        modificaEmpresa(nombre, telefono, email, direccion, idEmpresa);                      
                    }
                }                
            }
       }).off("shown.bs.modal");
       //FiltrarTablas(GlobalData.id_cedente);
       //resetearCombo();
       //AddClassModalOpen();           
       getDatosEmpresa(idEmpresa);
       $('#date-range .input-daterange').datepicker({
            format: "yyyy/mm/dd",
                weekStart: 1,
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
            language: 'es'
        });
}); 


function getDatosEmpresa(idEmpresa)
  {
    $.ajax({
        type:"POST",
        data: {idEmpresa: idEmpresa},
        dataType: "json",
        url:"../includes/empresaExterna/GetDatos_empresa.php",
        success:function(data){          
            data = data[0];
            $('#correoEmpresa').val(data.email);
            $('#nombreEmpresa').val(data.nombre);
            $('#telefonoEmpresa').val(data.telefonoMovil);
            $('#direccionEmpresa').val(data.direccion);            
          },
          error: function(){             
            alert('errorrrrrr');
          }          
    });
  }

 /*
** Modifica empresa
*/
function modificaEmpresa(nombre, telefono, email, direccion, idEmpresa){      
        $.ajax({
            type: "POST",
            url: "../includes/empresaExterna/modifica_empresa.php",
            dataType: "html",
            data: { nombre: nombre, telefono: telefono, email: email, direccion: direccion, idEmpresa: idEmpresa },
            success: function(data){
                CustomAlert("Empresa modificada exitosamente!");
                location.reload();
         
            },
            error: function(){
                alert('error');
            }
        });
}

 /*
    *  Validando campo email
  */ 
 $('body').on( 'blur', '#correoEmpresa', function ( event ) { 
     event.preventDefault();
    // Expresion regular para validar el correo
    if ($('#correoEmpresa').val().trim() != "")
    {
      var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
      // Se utiliza la funcion test() nativa de JavaScript
      if (!(regex.test($('#correoEmpresa').val().trim())))
      {
        $('#correoEmpresa').val("");
        CustomAlert("La dirección de correo no es valida!");    
      }
    }
  });
 




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