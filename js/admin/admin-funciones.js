$(document).ready(function($) 
{
/*$(function() {
    $.niftyNoty(
        {
            type: 'success',
            icon : 'fa fa-check',
            message : 'Respuesta Rapida Guardada' ,
            container : 'floating',
            timer : 3000
        });
})*/

// Funcion crear nueva fila en creacion de tabla de BD
	$( "#addfila" ).click(function() {
		
        var CAMPO = document.getElementById("campo").value;
        var NOMBRE = document.getElementById("nombre0").value;
        //console.log("campo id Campo sel: " + CAMPO);
        //console.log("campo id Nombre sel: " + NOMBRE); 

        var tds = '<tr>';
	    tds += '<td><input type="text" class="form-control" id="campo0" name="campo"  disabled  value= "' + CAMPO +'"></td>';
        tds += '<td><input type="text" class="form-control" id="nombreE0" name="nombreE"  required maxlength="15" value ="'+ NOMBRE +'" ></td>';
		tds += '</tr>';
		
		$(".mitabla").append(tds);
		document.getElementById("nombre0").value = "";

	});

    // Funcion eliminar fila en creacion de tabla de BD
    $("#delfila").click(function(){
        var n = $('tr', $(".mitabla")).length;
        console.log("tota filas:" + n);
        if(n>0)
        {
            // Eliminamos la ultima columna
            $(".mitabla tr:last").remove();
        }
    });


    $( "#guardarConfig" ).submit(function( event ) {
        console.log("Paso por aqui");
        event.preventDefault();

        var NomConfig = document.getElementById("nombre_confi").value;
        var idCedente = $(this).find("select[id*='idCedente']").val();
        var nomTabla = $(this).find("select[id*='nomTabla']").val();
        var DATA    = [];
        var TABLA   = $("#mitabla tbody > tr");
        
        
        console.log("nombre Config:" + NomConfig);
        console.log("Id Cedente:" + idCedente);
        console.log("Tabla:" + nomTabla);

        //recorrer la tabla en cada TR 
        TABLA.each(function(){
            
            var campo  = $(this).find("input[id*='campo0']").val();
            var nombreE  = $(this).find("input[id*='nombreE0']").val();
 
            item = {};
            item ["NomConfig"]     = NomConfig;
            item ["idCedente"]     = idCedente;
            item ["nomTabla"]     = nomTabla;
            item ["campo"]     = campo;
            item ["nombreE"]     = nombreE;
             
            //una vez agregados los datos al array "item" 
            //hacemos un .push() para agregarlos a nuestro array "DATA".
            DATA.push(item);

        });
        console.log(DATA);

        //Se envia al controlador PHP por ajax array en json 
        INFO    = new FormData();
        aInfo   = JSON.stringify(DATA);
     
        INFO.append('data', aInfo);
     
        $.ajax({
            data: INFO,
            type: "POST",
            url : "guardar_conf.php",
            processData: false, 
            contentType: false,
            success: function(datos){
                //console.log(datos);
                window.location.href = 'conf_gestion.php?r1=1' 
            }
        });

        event.preventDefault();
    });


    //Funcion al mostrar el modal
    $('#dataDelete').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Botón que activó el modal
      var id = button.data('id') // Extraer la información de atributos de datos
      var modal = $(this)
      modal.find('#id').val(id)
      console.log("Id sele: " + id);
    })


    // Funcion para Eliminar Configuracion
    $( "#eliminarConf" ).submit(function( event ) {
        console.log("paso 1: " );
        var parametros = $(this).serialize();
       
        $.ajax({
            data: parametros,
            type: "POST",
            url : "eliminar_conf.php",
            success: function(datos){
                //console.log(datos);
                window.location.href = 'conf_gestion.php?r1=2' 
            }
        });
      event.preventDefault();
    });




});