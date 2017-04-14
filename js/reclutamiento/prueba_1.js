$(document).ready(function(){
    var PreguntasArray = [];
    $(".Pregunta form label input[type='radio']").change(function(){
        var OptionString = $(this).attr("id");
        var OptionArray = OptionString.split("_");
        var OptionID = OptionArray[1];
        var QuestionID = $(this).attr("name");
        if(!SearchQuestion(QuestionID)){
            var ArrayTmp = [];
            ArrayTmp[0] = QuestionID;
            ArrayTmp[1] = OptionID;
            PreguntasArray.push(ArrayTmp);
            
        }else{
            updateQuestion(QuestionID,OptionID);
        }
    });
    $("#Calificar").click(function(){
        var CantidadPreguntas = $(".Pregunta").size();
        var CantQuestionArray = PreguntasArray.length;
        if(CantQuestionArray == CantidadPreguntas){
            $.ajax({
                type: "POST",
                url: "ajax/Calificar.php",
                dataType: "html",
                data: {
                    Preguntas: PreguntasArray
                },
                beforeSend: function(){
                    $('#Cargando').modal({
                        backdrop: 'static',
                        keyboard: false
                    })
                },
                success: function(data){
                    $('#Cargando').modal('hide');
                    bootbox.alert("Gracias por Participar en nuestro proceso de reclutamiento web, nos pondremos en contacto con usted", function(){
                        location.reload();
                    });
                },
                error: function(){
                }
            });
        }else{
            bootbox.alert("Debe responder todas las preguntas");
        }
    });
    function SearchQuestion(QuestionID){
        var ToReturn = false;
        $.each(PreguntasArray, function( index, value ) {
            if(value[0] == QuestionID){
                ToReturn = true;
            }
        });
        return ToReturn;
    }
    function updateQuestion(Question,Option){
        $.each(PreguntasArray, function( index, value ) {
            if(value[0] == Question){
                value[1] = Option;
            }
        });
    }
});