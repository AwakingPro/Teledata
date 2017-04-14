$(document).ready(function(){
  $('.enviarForm').click(function( event ){
      //event.epreventDefault();
      var usuario = $('input[name="usuario"]').val();
      var password = $('input[name="password"]').val();
      //var captcha = $('#g-recaptcha-response').val();
      if((usuario == "") || (password == ""))
      {
        //alert('Debe completar todos los campos!');
        bootbox.alert('Debe completar todos los campos!');
        return false;
      }else{
        $("form").submit();
      }
  });
});
