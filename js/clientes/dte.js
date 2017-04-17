$(document).ready(function(){
    $('#SeleccioneCliente').change(function(){
        var Rut = $(this).val();
        var data = "Rut="+Rut;
        alert(data);
        $.ajax({
			type: "POST",
			url: "../includes/ventas/LlenarDatos.php",
			data:data, 
            dataType: "json",
			success: function(response){
                $("#Giro").val(response.giro);
                $("#Contacto").val(response.contacto);
                $("#Rut").val(response.rut);
                $("#Direccion").val(response.direccion);
            }
        });

    })
});