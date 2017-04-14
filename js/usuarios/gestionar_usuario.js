$(document).ready(function($)
{
  /*
    * Listar usuarios al cargar pagina
  */

  onload=function(){
    // esta se carga tambien en crear usuario y no deberia OJOOOO
    // necesito que este codigo solo se ejecute cuando voy a modificar usuarios
    //var data = "vari=13";
    //alert("aqui estoy");
    $.ajax({
      type:"POST",
      url:"../includes/usuarios/datos_usuario.php",
      //data:data,
      dataType:"json",
      success:function(dato){
        //$('#nombre_usu').val("hoaaa");
        alert("sdsdsd");
      }
    });

  };

});
