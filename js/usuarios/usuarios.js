$(document).ready(function($)
{
  /*
    * Lista los cedentes dependiendo del mandante seleccionado
  */
  $("#id_mandante").change(function(){
      var id_cedente_man = $('#id_mandante').val();
      if ((id_cedente_man != 0) || (id_cedente_man != ""))
      {
        FiltrarCedentes(id_cedente_man);
      }else {
        resetearCombos();
      }
  });

  /*
    * muestra los combos cedente y/o mandante dependiendo del rol seleccionado
  */
  $("#nivel_usu").change(function(){
      var nivel_rol = $('#nivel_usu').val();
      if ((nivel_rol != 0) || (nivel_rol != ""))
      {
        mandanteCedente(nivel_rol);
      }else {
        $('#selectorCedente').hide();
        $('#selectorMandante').hide();
        resetearCombos();
      }

  });

  /*
    * muestra los datos del trabajador
  */
  $("#trabajador_usu").change(function(){
      var idTrabajador = $('#trabajador_usu').val();
      if ((idTrabajador != 0) || (idTrabajador != ""))
      {
        muestraDatosTrabajador(idTrabajador);
      }else {
        //resetearCombos();
      }

  });


  /*
    * muestra los datos de la empresa
  */
  $("#empresa_usu").change(function(){
      var idEmpresa = $('#empresa_usu').val();
      if ((idEmpresa != 0) || (idEmpresa != ""))
      {
        muestraDatosEmpresa(idEmpresa);
      }else {
        //resetearCombos();
      }

  });

  /*
    * Busca y muestra datos del trabajador
  */

  function muestraDatosTrabajador(idTrabajador)
  {
    $.ajax({
        type:"POST",
        data: {idTrabajador: idTrabajador},
        dataType: "json",
        url:"../includes/trabajador/GetDatosTrabajador.php",
        success:function(data){          
            $('#email_usu').val(data.email);
            $('#cargo_usu').val(data.cargo);
            cambiarTextoLabel('Cargo', 'cargo');
          },
          error: function(){             
            alert('error');
          }          
    });
  }


  /*
    * Busca y muestra datos de la empresa
  */

  function muestraDatosEmpresa(idEmpresa) 
  {
    $.ajax({
        type:"POST",
        data: {idEmpresa: idEmpresa},
        dataType: "json",
        url:"../includes/empresaExterna/GetDatosEmpresa.php",
        success:function(data){          
            $('#email_usu').val(data.email);
            $('#cargo_usu').val(data.telefono);
            cambiarTextoLabel('Teléfono', 'cargo');
          },
          error: function(){             
            alert('error');
          }          
    });
  }

  /*
    * Busca y muestra datos de la empresa
  */

function muestraDatosEmpresa(idEmpresa)
{
   $.ajax({
        type:"POST",
        data: {idEmpresa: idEmpresa},
        dataType: "json",
        url:"../includes/empresaExterna/GetDatos_empresa.php",
        success:function(data){
          data = data[0];         
          $('#email_usu').val(data.email);
          $('#cargo_usu').val(data.telefono);
          cambiarTextoLabel('Teléfono', 'cargo');
        },
        error: function(){             
          alert('error muestraDatosEmpresa');
        }          
  });
}

function cambiarTextoLabel(texto, idEtiqueta)
{
  $('#'+idEtiqueta+'').text(texto);
}


  /*
    * Oculta o desaparece combo dependiendo del rol
  */

  function mandanteCedente(rol)
  {
    switch (rol) {
    case '1': // administrador
    $('#selectorCedente').hide();
    $('#selectorMandante').hide();
    resetearCombos();
    break;
    case '2': // supervisor
    $('#selectorCedente').hide();
    $('#selectorMandante').show();
    resetearCombos();
    break;
    case '4': // ejecutivo
    $('#selectorCedente').show();
    $('#selectorMandante').show();
    resetearCombos();
    break;
    case '6': // calidad
    $('#selectorCedente').hide();
    $('#selectorMandante').show();
    resetearCombos();
    break;
    default: // 3: cedente, 5: sin definir
    $('#selectorCedente').hide();
    $('#selectorMandante').hide();
    resetearCombos();
    }
  }

  /*
    * Resetear combos
  */
  function resetearCombos()
  {
    $('#id_mandante').val("");
    $("#id_mandante").selectpicker('refresh');
    $('#cedentes').val("0");
    $("#cedentes").selectpicker('refresh');
    $("select[name='cedentes']").html('<option value="0">Seleccione</option>');
    $("select[name='cedentes']").selectpicker('refresh');
  }

  /*
    * busca cedentes dependiendo del mandante seleccionado
  */
  function FiltrarCedentes(mandante){
      $.ajax({
          type: "POST",
          url: "../includes/global/getCedentesMandante.php",
          dataType: "html",
          data: {mandante: mandante},
          success: function(data){
              $("select[name='cedentes']").html(data);
              $("select[name='cedentes']").selectpicker('refresh');
          },
          error: function(){
          }
      });
  }

  /*
    * Listar usuarios al cargar pagina
  */
    if($('.listaUsuarios').size() > 0){
      $.ajax({
          type:"POST",
          url:"../includes/usuarios/listar_usuarios.php",
          success:function(data){
              $('.listaUsuarios').html(data);
              $("#TablaUsuarios").DataTable();
          }
      });
    }

$('input[name=tipoUsuario]').click(function( event ){
  if ($('input:radio[name=tipoUsuario]:checked').val() == 1){
    //trabajador
    cambiarTextoLabel('Cargo', 'cargo');
    cambiarTextoLabel('Trabajador', 'labelCombo');   
    listaTrabajadores(); 
    resetearValoresTipoUsuario();
    $("#comboTrabajador").show();
    $("#comboEmpresa").hide();
    $("select[name='trabajador_usu']").selectpicker('refresh');
  }else{
    //empresaExterna
    cambiarTextoLabel('Teléfono', 'cargo');
    cambiarTextoLabel('Empresa', 'labelComboE');
    listaEmpresas();
    resetearValoresTipoUsuario();
    $("#comboEmpresa").show();
    $("#comboTrabajador").hide();
  }
});

$(".selectpicker").selectpicker('refresh');
  /*
    * resetear valores del trabajador o empresa externa
  */
function resetearValoresTipoUsuario()
  {
    $('#email_usu').val("");
    $('#cargo_usu').val("");
    $("#trabajador_usu").selectpicker('refresh');
    $("#empresa_usu").selectpicker('refresh');
    /*$('#cedentes').val("0");
    $("#cedentes").selectpicker('refresh');
    $("select[name='cedentes']").html('<option value="0">Seleccione</option>');
    $("select[name='cedentes']").selectpicker('refresh');*/
  }


   /*
    * lista las empresas externas
   */
  function listaEmpresas(){
      $.ajax({
          type: "POST",
          url: "../includes/usuarios/getListar_empresas.php",
          dataType: "html",
          //data: {mandante: mandante},
          success: function(data){
              $("select[name='empresa_usu']").html(data);
              $("select[name='empresa_usu']").selectpicker('refresh');
              //$('#trabajador_usu').append(toAppend);
          },
          error: function(){
            alert('error listaEmpresas');
          }
      });
  }
   
 /*
    * lista las empresas externas
   */
  function listaTrabajadores(){  
      $.ajax({
          type: "POST",
          url: "../includes/usuarios/getListar_trabajadores.php",
          dataType: "html",
          //data: {mandante: mandante},
          success: function(data){       
              $("select[name='trabajador_usu']").html(data);
              $("select[name='trabajador_usu']").selectpicker('refresh');
              //$('#trabajador_usu').append(toAppend);
          },
          error: function(){
            alert('error listatRABAJAdores');
          }
      });
  } 


  /*
    *  Registrar nuevo usuario
  */
  $('#crearUsuario').click(function( event ){      
      var nombreUsu = $('#nombre_usu').val();
      var cargoUsu = $('#cargo_usu').val();
      var emailUsu = $('#email_usu').val();
      var usuario = $('#usuario_usu').val();
      var passwordUsu = $('#password_usu').val();
      var nivelUsu = $('#nivel_usu').val();
      var idMandante = $('#id_mandante').val();
      var idCedente = $('#cedentes').val();
      var usuarioDialUsu = $('#usuarioDial_usu').val();
      var passwordDialUsu = $('#passwordDial_usu').val();     
      // VERIFICO si es un trabajador o es una empresa interna
      // 1=trabajador 2=empresaExterna
      if ($('input:radio[name=tipoUsuario]:checked').val() == 1){
        var idTrabajador = $('#trabajador_usu').val();
        var idEmpresa = 0;
        var validar = $('#trabajador_usu').val();
      }else{
        var idEmpresa = $('#empresa_usu').val();
        var idTrabajador = 0;
        var validar = $('#empresa_usu').val();
      }

      var data = "nombreUsu="+nombreUsu+"&cargoUsu="+cargoUsu+"&emailUsu="+emailUsu;
      data = data+"&usuario="+usuario+"&passwordUsu="+passwordUsu+"&nivelUsu="+nivelUsu+"&idMandante="+idMandante;
      data = data+"&usuarioDialUsu="+usuarioDialUsu+"&passwordDialUsu="+passwordDialUsu+"&idCedente="+idCedente;
      data = data+"&idTrabajador="+idTrabajador+"&idEmpresa="+idEmpresa;
      // ojooooooooo validar que seleccione un trabajador
      // if(nombreUsu == "" || cargoUsu == "" || emailUsu == "" || usuario == "" || passwordUsu == "" || nivelUsu == "")
  		if(usuario == "" || passwordUsu == "" || nivelUsu == "" || validar == "")
      {
      	$.niftyNoty(
				{
   				type: 'danger',
  				icon : 'fa fa-close',
  				message : "Debe completar todos los campos!" ,
  				container : 'floating',
  				timer : 5000
  			});
      }
      else
      {
        $.ajax({
          type:"POST",
          url:"../includes/usuarios/guardar_usuario.php",
          data:data,
          dataType:"json",
          success:function(dato){
            if(dato.respuesta == 1)
              alert("El usuario no puede ser registrado. Ya existe en base de datos")
            else
            {
              alert("El usuario ha sido creado con éxito");
              window.location.href = 'usuarios.php'
            }
          }
        });
      }
  });


  /*
    *  Eliminar un usuario
  */
  $(document).on('click','.eliminar',function(){
    var id = $(this).attr("id");
    var data = "id_usuario="+id;
    bootbox.confirm("¿Esta seguro que desea eliminar el usuario?", function(result) {
    if (result) {
      $.ajax({
       type:"POST",
       url:"../includes/usuarios/eliminar_usuario.php",
       data:data,
       success:function(data) {
        $('#'+id+'').remove();
        alert("Usuario eliminado con éxito");
       }
      });
    }
    });
  });

  /*
    *  Modificar un usuario
  */

  $('#modificarUsuario').click(function( event ){
      var nombreUsu = $('#nombre_usu').val();
      var cargoUsu = $('#cargo_usu').val();
      var emailUsu = $('#email_usu').val();
      var usuario = $('#usuario_usu').val();
      var passwordUsu = $('#password_usu').val();
      var nivelUsu = $('#nivel_usu').val();
      var cedenteUsu = $('#cedentes').val();
      var idMandanteUsu = $('#id_mandante').val();
      var usuarioDialUsu = $('#usuarioDial_usu').val();
      var passwordDialUsu = $('#passwordDial_usu').val();
      var valorocultoarescatar = $('#valorocultoarescatar').val();

          // 1=trabajador 2=empresaExterna
      if ($('input:radio[name=tipoUsuario]:checked').val() == 1){
        nombreUsu = $("#trabajadorUsu option:selected").html(); 
        alert('entro');
        alert($("#trabajadorUsu option:selected").html());
      }else{
        nombreUsu = $("#empresaUsu option:selected").html(); 
      }
      alert(nombreUsu);
      alert($('input:radio[name=tipoUsuario]:checked').val());
       
       

      var data = "nombreUsu="+nombreUsu+"&cargoUsu="+cargoUsu+"&emailUsu="+emailUsu;
      data = data+"&usuario="+usuario+"&passwordUsu="+passwordUsu+"&nivelUsu="+nivelUsu+"&cedenteUsu="+cedenteUsu+"&idMandanteUsu="+idMandanteUsu;
      data = data+"&usuarioDialUsu="+usuarioDialUsu+"&passwordDialUsu="+passwordDialUsu+"&valorocultoarescatar="+valorocultoarescatar;
  		if(nombreUsu == "" || cargoUsu == "" || emailUsu == "" || usuario == "" || passwordUsu == "")
      {
      	$.niftyNoty(
				{
   				type: 'danger',
  				icon : 'fa fa-close',
  				message : "Debe completar todos los campos...!" ,
  				container : 'floating',
  				timer : 5000
  			});
      }
      else
      {
        $.ajax({
          type:"POST",
          url:"../includes/usuarios/modificar_usuario.php",
          data:data,
          dataType:"json",
          success:function(dato){
            if(dato.respuesta == 1)
              alert("El usuario no puede ser modificado. Ya existe en base de datos")
            else
            {
              alert("El usuario ha sido modificado con éxito");
              window.location.href = 'usuarios.php'
            }
          }
        });
      }
  });

  /*
    *  Envio id del usuario dependiendo si va a modifcar o crear usuarios
  */

  $(document).on('click','.gestionar_usu',function(){
    var id = $(this).attr("id"); // Obtengo el id del usuario
    if (id === undefined)
    {     
      window.location.href = 'crear_usuarios.php';
    }
    else
    {
      $("#id_usuario").val(id);
      $("#SubmitModusuario").submit();
    }

  });

  /*
    *  Validando campo email
  */
  $('#email_usu').blur(function( event ){
    event.preventDefault(); // ojooooooooooooooooo probar con el return false para ver el compratamiento del boton
    // Expresion regular para validar el correo
    if ($('#email_usu').val().trim() != "")
    {
      var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
      // Se utiliza la funcion test() nativa de JavaScript
      if (!(regex.test($('#email_usu').val().trim())))
      {
        $('#email_usu').val("");
        alert('La dirección de correo no es valida');

      }
    }
  });

});
