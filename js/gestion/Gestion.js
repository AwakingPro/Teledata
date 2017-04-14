$(document).ready(function(){
    var IdCedente = $('#IdCedente').val();
    $('#SeleccioneTipoBusqueda').change(function(){

        var TipoBusqueda = $('#SeleccioneTipoBusqueda').val();
        var toAppend = '';
        if(TipoBusqueda==0){
            
            $.ajax({
                type: "POST",
                url: "../includes/gestion/ListarEstrategias.php",
                data:{IdCedente : IdCedente},
                dataType: "json",
                success: function(response){
                    $('#SeleccioneEstrategia').empty();
                    
                    $.each(response, function(i, item) {
                        toAppend +="<option value='"+item +"'>"+item+"</option>";
                    });
                    $('#SeleccioneEstrategia').append(toAppend);
                    $('#SeleccioneEstrategia').selectpicker('refresh');
                }
            });
            
        }else if(TipoBusqueda==1){
            $('#SeleccioneEstrategia').empty();
            $('#SeleccioneEstrategia').selectpicker('refresh');
        }else{
            
        }
    });

     $('#SeleccioneEstrategia').change(function(){
         alert('ok');
     });
});
