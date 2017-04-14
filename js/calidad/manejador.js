$(document).ready(function() {
    var RecordTable;
    var RecordId;
    var EvaluationTable;
    var Ejecutivo = [];
    var CantEvaluations = 0;
    var EvaluationsArray = [];
    var StatusObject;

    UpdateEvaluations();

    $("body").on("keypress",".justNumber",function(e){
        if(e.keyCode == 190){
            return false;
        }
    });
    $('body').on( 'click', '#AddEvaluation', function () {
        bootbox.dialog({
            title: "Formulario de Evaluación",
            message: $("#EvaluationForm").html(),
            buttons: {
                success: {
                    label: "Guardar",
                    className: "btn-purple",
                    callback: function() {
                        var Description = $('#Description').val();
                        var Ponderacion = Number($("#Ponderacion").val()).toFixed(2);

                        if(Description != ""){
                            if(Ponderacion != ""){
                                if((Ponderacion > 0) && (Ponderacion <= 100)){
                                    if(CanAddEvaluation(Ponderacion)){
                                        addEvaluation(Description,Ponderacion);
                                    }else{
                                        CustomAlert("La sumatoria de las ponderaciones mas la agregada superan los 100%");
                                        return false;
                                    }
                                }else{
                                    CustomAlert("La ponderacion debe estar entre 1 y 100");
                                    return false;
                                }
                            }else{
                                CustomAlert("Debe introducir una poderación");
                                return false;
                            }
                        }else{
                            CustomAlert("Debe introducir una descripción");
                            return false;
                        }
                    }
                }
            }
        }).off("shown.bs.modal");
    });
    $("body").on("click",".Delete", function(){
        var ObjectMe = $(this);
        var ObjectDiv = ObjectMe.closest("div");
        var ID = ObjectDiv.attr("id");
        ID = ID.substring(ID.indexOf("_") + 1,ID.length);
        var ObjectTR = ObjectMe.closest("tr");
        bootbox.confirm("¿Esta seguro que desea eliminar esta evaluación?", function(result) {
            if (result) {
                DeleteEvaluation(ObjectTR, ID);
            }
            AddClassModalOpen();
        });
    });
    $('body').on( 'click', '.Update', function () {
        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        ObjectTR.addClass("Selected");
        var ObjectDescription = ObjectTR.find(".DescriptionObject");
        var ObjectPonderacion = ObjectTR.find(".PonderacionObject");
        var Template = $("#EvaluationFormUpdate").html();
        Template = Template.replace("{DESCRIPTION}",ObjectDescription.html());
        Template = Template.replace("{PONDERACION}",ObjectPonderacion.html());

        bootbox.dialog({
            title: "Actualizacion de Formulario de Evaluación",
            message: Template,
            buttons: {
                success: {
                    label: "Guardar",
                    className: "btn-purple",
                    callback: function() {
                        var Description = $('#Description').val();
                        var Ponderacion = Number($("#Ponderacion").val()).toFixed(2);

                        if(Description != ""){
                            if(Ponderacion != ""){
                                if((Ponderacion > 0) && (Ponderacion <= 100)){
                                    if(CanUpdateEvaluation(Ponderacion, Number(ObjectPonderacion.html()).toFixed(2))){
                                        var TableRow = $("#Evaluations tbody tr.Selected");
                                        UpdateEvaluation(TableRow, Description, Ponderacion);
                                        $("#Evaluations tbody tr").removeClass("Selected");
                                    }else{
                                        CustomAlert("La sumatoria de las ponderaciones mas la agregada superan los 100%");
                                        return false;
                                    }
                                }else{
                                    CustomAlert("La ponderacion debe estar entre 1 y 100");
                                    return false;
                                }
                            }else{
                                CustomAlert("Debe introducir una poderación");
                                return false;
                            }
                        }else{
                            CustomAlert("Debe introducir una descripción");
                            return false;
                        }
                    }
                }
            }
        }).off("shown.bs.modal");
    });
    $("body").on("update","#Evaluations",function(){
        UpdateEvaluationSummaryFoot();
    });
    $("body").on("click",".close",function(){
        AddClassModalOpen();
    });
    function UpdateEvaluations(){
        $.ajax({
            type: "POST",
            url: "../includes/calidad/GetEvaluations_Managment.php",
            data: { },
            dataType: "html",
            success: function(data){
                EvaluationsArray = JSON.parse(data);
                EvaluationTable = $('#Evaluations').DataTable({
                    data: EvaluationsArray,
                    paging: false,
                    iDisplayLength: 100,
                    columns: [
                        { data: 'Descripcion' },
                        { data: 'Ponderacion' },
                        { data: 'Actions' }
                    ],
                    "columnDefs": [
                        {
                            className: "DescriptionObject",
                            "targets": 0,
                        },
                        {
                            className: "dt-right PonderacionObject",
                            "targets": 1,
                            "searchable": false
                        },
                        {
                            "targets": 2,
                            "data": 'Actions',
                            "render": function( data, type, row ) {
                                return "<div style='text-align: center;' id='Eval_"+data+"'><i style='cursor: pointer; margin: 0 10px;' class='fa fa-times-circle icon-lg Delete'></i><i style='cursor: pointer; margin: 0 10px;' class='fa fa-pencil Update'></div>";
                            }
                        }
                    ]
                });
                EvaluationTable.order([2, 'asc']).draw();
                EvaluationTable.page('last').draw(false);
                $("#Evaluations").trigger('update');
            },
            error: function(){
            }
        });
    }
    function CustomAlert(Message){
        bootbox.alert(Message,function(){
            AddClassModalOpen();
        });
    }
    function AddClassModalOpen(){
        setTimeout(function(){
            if(!$("body").hasClass("modal-open")){
                $("body").addClass("modal-open");
            }
        }, 500);
    }
    function addEvaluation(Description,Ponderacion){
        $.ajax({
            type: "POST",
            url: "../includes/calidad/AddEvaluation_Managment.php",
            dataType: "html",
            data: { Description: Description, Ponderacion: Ponderacion },
            success: function(data){
                if(data != "0"){
                    Id_Evaluation = data;
                    EvaluationTable.row.add(
                        {
                            "Descripcion": Description,
                            "Ponderacion": Ponderacion,
                            "Actions": Id_Evaluation
                        }
                    ).draw(false);
                    EvaluationTable.order([2, 'asc']).draw();
                    EvaluationTable.page('last').draw(false);
                    $("#Evaluations").trigger('update');
                }
            },
            error: function(){
            }
        });
    }
    function UpdateEvaluationSummaryFoot(){
        var SumPonderacion = 0;
        EvaluationTable.rows().eq(0).each( function ( index ) {
            var row = EvaluationTable.row( index );
            var data = row.data();
            SumPonderacion += Number(data.Ponderacion);
        });
        $("#SumPonderacion").html(SumPonderacion.toFixed(2));
        AddClassModalOpen();
    }
    function DeleteEvaluation(TableRow, ID){
        $.ajax({
            type: "POST",
            url: "../includes/calidad/DeleteEvaluation_Managment.php",
            dataType: "html",
            data: {
                Id_Evaluacion: ID
            },
            success: function(data){
                if(data){
                    EvaluationTable.row(TableRow).remove().draw();
                    $("#Evaluations").trigger('update');
                }
            },
            error: function(){
            }
        });
    }
    function UpdateEvaluation(TableRow, Description, Ponderacion){

        var ID = TableRow.find(".Update").closest("div").attr("id");
        ID = ID.substring(ID.indexOf("_") + 1,ID.length);

        $.ajax({
            type: "POST",
            url: "../includes/calidad/UpdateEvaluation_Managment.php",
            dataType: "html",
            data: {
                Id_Evaluacion: ID,
                Description: Description,
                Ponderacion: Ponderacion
            },
            success: function(data){
                if(data){
                    Id_Evaluation = data;
                    var ObjectDescription = TableRow.find(".DescriptionObject");
                    var ObjectPonderacion = TableRow.find(".PonderacionObject");
                    var row = EvaluationTable.row(TableRow);
                    var data = row.data();
                    data.Descripcion = Description;
                    data.Ponderacion = Number(Ponderacion).toFixed(2);
                    EvaluationTable.draw();
                    ObjectDescription.html(Description);
                    ObjectPonderacion.html(Number(Ponderacion).toFixed(2));
                    $("#Evaluations").trigger('update');
                }
            },
            error: function(){
            }
        });
    }
    function HaveEvaluations(){
        var ToReturn = false;
        var ContEvaluations = 0;
        $("#Evaluations tbody tr").each(function(indexTR){
            if(!$(this).find("td").hasClass("dataTables_empty")){
                ContEvaluations++;
            }
        });
        if(ContEvaluations > 0){
            ToReturn = true;
        }
        return ToReturn;
    }
    function CanAddEvaluation(Ponderacion){
        var SumPonderacion = 0;
        var PonderacionTmp = 0;
        var ToReturn = false;
        $("#Evaluations tbody tr").each(function(indexTR){
            $(this).find("td").each(function(indexTD){
                switch(indexTD){
                    case 0:
                        //Description
                    break;
                    case 1:
                        //Ponderacion
                        SumPonderacion += Number($(this).text());
                    break;
                    case 2:
                        //Nota
                    break;
                    case 3:
                        //Calificacion Ponderada
                    break;
                    case 4:
                        //Observacion (Boton)
                    break;
                    case 5:
                        //Acciones
                    break;
                    case 6:
                        //Observacion
                    break;
                }
            });
        });
        PonderacionTmp = Number(SumPonderacion) + Number(Ponderacion);
        if(PonderacionTmp <= 100){
            ToReturn = true;
        }
        return ToReturn;
    }
    function CanUpdateEvaluation(NewPonderacion, OldPonderacion){
        var SumPonderacion = 0;
        var PonderacionTmp = 0;
        var ToReturn = false;
        $("#Evaluations tbody tr").each(function(indexTR){
            $(this).find("td").each(function(indexTD){
                switch(indexTD){
                    case 0:
                        //Description
                    break;
                    case 1:
                        //Ponderacion
                        SumPonderacion += Number($(this).text());
                    break;
                    case 2:
                        //Nota
                    break;
                    case 3:
                        //Calificacion Ponderada
                    break;
                    case 4:
                        //Observacion (Boton)
                    break;
                    case 5:
                        //Acciones
                    break;
                    case 6:
                        //Observacion
                    break;
                }
            });
        });
        PonderacionTmp = Number(SumPonderacion) + Number(NewPonderacion) - Number(OldPonderacion);
        if(PonderacionTmp <= 100){
            ToReturn = true;
        }
        return ToReturn;
    }
});
