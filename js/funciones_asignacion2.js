
$(document).ready(function($) {

 $('.eliminar_gestores').on('click',function(e) 
    {
			
		var miva = this.id; // button ID 
        var mivar = $(this).closest('tr').attr('id');
        var data = 'id='+mivar;
		$.ajax({
					type: "POST",
					url: "eliminar_gestores.php",
					data:data, 
					success: function(response)
							                    {
							                    $('#cambiar20').load("gestores_actualizar.php");
										        $.getScript("../js/funciones_asignacion2.js");

							                    }
				})

		e.preventDefault();

	});	

});