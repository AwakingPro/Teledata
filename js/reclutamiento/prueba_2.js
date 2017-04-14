$(document).ready(function(){
    var PreguntasArray = [];
    $(".Pregunta .Options label.mt-radio input[type='radio']").change(function(){
        var ObjectMe = $(this);
        var ObjectGroup = ObjectMe.closest(".btn-group");
        var ObjectPregunta = ObjectMe.closest(".Pregunta");
        var Name = ObjectMe.attr("name");
        ObjectGroup.find("input[type='radio']").each(function(index){
            $(this).closest("label").removeClass("active");
            $(this).prop("checked",false);
        });
        ObjectPregunta.find("input[name='"+Name+"']").each(function(index){
            $(this).closest("label").removeClass("active");
            $(this).closest("label").prop("checked",false);
        });
        $(this).closest("label").addClass("active");
        $(this).prop("checked",true);
    });
    $("#Calificar").click(function(){
        fillArrayData();
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
                    alert(data);
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
    function fillArrayData(){
        $(".Pregunta").each(function(indexPregunta){
            var ArrayTmp = [];
            var ObjectMe = $(this);
            var iD = ObjectMe.attr("id");
            iD = iD.split("_");
            iD = iD[1];
            ArrayTmp[0] = iD;
            ObjectMe.find(".Options").each(function(indexOption){
                var ObjectOption = $(this);
                ObjectOption.find("label.active").each(function(indexRadio){
                    var ObjectLabel = $(this);
                    var ObjectRadio = ObjectLabel.find("input");
                    var InputValue = ObjectRadio.val();
                    var ArrayInput = InputValue.split("_");
                    var index = ArrayInput[0];
                    var Value = ArrayInput[1];
                    ArrayTmp[index] = Value;
                })
            });
            PreguntasArray.push(ArrayTmp);
        });
    }
});