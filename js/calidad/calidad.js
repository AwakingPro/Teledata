
audiojs.events.ready(function() {
    audiojs.createAll();
});
$(document).ready(function() {
    var RecordTable;
    var RecordId;
    var EvaluationTable;
    var Ejecutivo = [];
    var CantEvaluations = 0;
    var EvaluationsArray = [];
    var StatusObject;
    var RecordGroups = [];
    var GroupRecordsFlag = false;
    var PrintObject;
    var CarteraObject;

    PreloadRecordTable();

    if(!GlobalData.Empiezo){
        CustomAlert('Usted no tiene privilegios para ejecutar esta acción, consulte con el administrador'); //no puede evaluar debido a que empieza a evaluar el sistema
        $("#FiltrarPorFecha").attr("disabled","disabled");
    }

    $("#FiltrarPorFecha").click(function(){
        var startDate = $("#date-range .input-daterange input[name='start']").val();
        var endDate = $("#date-range .input-daterange input[name='end']").val();
        if((startDate != "") && (endDate != "")){
            FillPersonalList(startDate,endDate,GlobalData.nombre_cedente);
        }
    });

    $("body").on("change","select[name='Ejecutivo']",function(){
        var Val = $(this).val();
        var startDate = $("#date-range .input-daterange input[name='start']").val();
        var endDate = $("#date-range .input-daterange input[name='end']").val();
        var Cartera = GlobalData.nombre_cedente;
        if(Val != ""){
            Ejecutivo[0] = $(this).find("option:selected").text().toUpperCase();
            Ejecutivo[1] = $(this).val();
            RecordTable.destroy();
            UpdateRecords(startDate,endDate,Cartera);
        }
    });
    $('body').on('click','.AddEvaluation', function(){
        var Template = $("#Calificacion").html();

        RecordId = $(this).attr("id");
        RecordId = RecordId.substr(RecordId.indexOf("_") + 1, RecordId.length);
        
        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
            var Cartera = "";
            var Filename = "";
            var Audio = "";
            var Date = "";
            var Status = "";
            var NewEvaluation = false;
        ObjectTR.find("td").each(function(index){
            switch(index){
                case 0:
                    Cartera = $(this).html();
                    CarteraObject = $(this);
                break;
                case 1:
                    Filename = $(this).html();
                break;
                case 2:
                    Audio = $(this).html();
                break;
                case 3:
                    Date = $(this).html();
                break;
                case 4:
                    Status = $(this).html();
                    if(Status == ""){
                        NewEvaluation = true;
                    }
                    StatusObject = $(this);
                break;
                case 5:
                break;
                case 6:
                    PrintObject = $(this);
                break;
            }
        });

            Template = Template.replace("{RECORD_AUDIO}",Audio);

        bootbox.dialog({
            title: "CALIFICACIÓN GENERAL DE LA EVALUACIÓN DE " + Ejecutivo[0],
            message: Template,
            buttons: {
                confirm: {
                    label: "Save",
                    callback: function() {
                        if(HaveEvaluations()){
                            var TableTmp = $("#Evaluations");
                            SaveEvaluation(NewEvaluation, TableTmp);
                        }else{
                            CustomAlert("Debe ingresar al menos una evaluación");
                            return false;
                        }                        
                    }
                }
            },
            size: 'large'
        }).off("shown.bs.modal");
        if(Status != ""){
            $.ajax({
                type: "POST",
                url: "../includes/calidad/GetEvaluation.php",
                data: { Id_Grabacion: RecordId },
                dataType: "html",
                success: function(data){
                    var Evaluation = JSON.parse(data);
                    Evaluation = Evaluation[0];
                    var Id_Evaluacion = Evaluation.id;
                    $.ajax({
                        type: "POST",
                        url: "../includes/calidad/GetEvaluationDetails.php",
                        data: { Id_Evaluacion: Id_Evaluacion },
                        dataType: "html",
                        success: function(data1){
                            EvaluationsArray = JSON.parse(data1);
                            UpdateEvaluations();
                        },
                        error: function(){
                        }
                    });
                },
                error: function(){
                }
            });
        }else{
            $.ajax({
                type: "POST",
                url: "../includes/calidad/GetEvaluationTemplate.php",
                dataType: "html",
                data: {Ejecutivo: Ejecutivo[1]},
                success: function(data){
                    EvaluationsArray = JSON.parse(data);
                    UpdateEvaluations();
                },
                error: function(){
                }
            });
            //UpdateEvaluations();
        }
    });
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
    $('body').on( 'click', '.AddNote', function () {
        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectObservationText = ObjectTR.find(".ObservationObject");
        var ObjectNote = ObjectTR.find(".NoteObject");
        var ObjectCalfPonderada = ObjectTR.find(".CalfPonderadaObject");
        var ObjectPonderacion = ObjectTR.find(".PonderacionObject");
        var Template = $("#EvaluationFormObservation").html();
        Template = Template.replace("{OBSERVATION}",ObjectObservationText.html());
        Template = Template.replace("{NOTE}",ObjectNote.html());

        bootbox.dialog({
            title: "Formulario de Observación",
            message: Template,
            buttons: {
                success: {
                    label: "Guardar",
                    className: "btn-purple",
                    callback: function() {
                        var Observation = $('#Observation').val();
                        var Note = Number($("#Note").val()).toFixed(2);
                        if(Observation != ""){
                            if(Note != ""){
                                if((Note > 0) && (Note <= 7)){
                                    AddNote(ObjectObservationText, Observation, ObjectNote, Note, ObjectPonderacion, ObjectCalfPonderada);
                                }else{
                                    CustomAlert("La Nota debe estar entre 1 y 7");
                                    return false;
                                }
                            }else{
                                CustomAlert("Debe introducir una nota");
                                return false;
                            }
                        }else{
                            CustomAlert("Debe introducir una observación");
                            return false;
                        }
                    }
                }
            }
        }).off("shown.bs.modal");
    });
    $("body").on("click",".Delete", function(){
        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        bootbox.confirm("¿Esta seguro que desea eliminar esta evaluación?", function(result) {
            if (result) {
                DeleteEvaluation(ObjectTR);
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
                                    var TableRow = $("#Evaluations tbody tr.Selected");
                                    UpdateEvaluation(TableRow, Description, Ponderacion);
                                    $("#Evaluations tbody tr").removeClass("Selected");
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
    function FillPersonalList(startDate, endDate, Cartera){
        $.ajax({
            type: "POST",
            url: "../includes/personal/fillSelect.php",
            dataType: "html",
            data: {
                Cartera: Cartera,
                startDate: startDate,
                endDate: endDate
            },
            success: function(data){
                $("select[name='Ejecutivo'").removeAttr("disabled");
                $("select[name='Ejecutivo']").html(data);
                $("select[name='Ejecutivo']").selectpicker('refresh');
            },
            error: function(){
            }
        });
    }
    function FillCarteraList(startDate, endDate){
        $.ajax({
            type: "POST",
            url: "../includes/calidad/fillCartera.php",
            dataType: "html",
            data: {
                startDate: startDate,
                endDate: endDate
            },
            success: function(data){
                $("select[name='Cartera']").html(data);
                $("select[name='Cartera']").selectpicker('refresh');
            },
            error: function(){
            }
        });
    }
    function UpdateRecords(startDate, endDate, Cartera){
        $.ajax({
            type: "POST",
            url: "../includes/calidad/GetRecords.php",
            data: { 
                Ejecutivo: $("select[name='Ejecutivo']").val(),
                Cartera: Cartera,
                startDate: startDate,
                endDate: endDate
            },
            dataType: "html",
            success: function(data){
                var dataSet = JSON.parse(data);
                var CantRecords = dataSet.length;
                RecordGroups = [];
                for(var i in dataSet){
                    var ID = dataSet[i].Imprimir;
                    RecordGroups[ID] = false;
                }
                RecordTable = $('#Records').DataTable({
                    data: dataSet,
                    columns: [
                        { data: 'Cartera' },
                        { data: 'Filename' },
                        { data: 'Listen' },
                        { data: 'Date' },
                        { data: 'Status' }, 
                        { data: 'Evaluar' },
                        { data: 'Imprimir' }
                    ],
                    "columnDefs": [ 
                        /*{
                            "targets": 0,
                            "data": 'Cartera',
                            "render": function( data, type, row ) {
                                //return "<span class='checkbox'><input id='"+row.Evaluar+"' class='magic-checkbox groupSelecter' type='checkbox'><label for='"+row.Evaluar+"'>"+data+"</label></span>";
                                var ToReturn = "";
                                if(row.Status != ""){
                                    ToReturn = "<span class='checkbox'><input id='"+row.Evaluar+"' class='magic-checkbox groupSelecter' type='checkbox'><label for='"+row.Evaluar+"'>"+data+"</label></span>";
                                }else{
                                    ToReturn = data;
                                }
                                return ToReturn;
                            }
                        },*/
                        {
                            "targets": 2,
                            "data": 'Listen',
                            "render": function( data, type, row ) {
                                return "<audio src='"+data+"' preload='auto' controls></audio>";
                            }
                        },
                        {
                            "targets": 5,
                            "data": 'Evaluar',
                            "render": function( data, type, row ) {
                                return "<div style='text-align: center;'><i style='cursor: pointer;' id='Record_"+data+"' class='fa fa-pencil AddEvaluation'></i></div>";
                            }
                        },
                        {
                            "targets": 6,
                            "data": 'Imprimir',
                            "render": function( data, type, row ) {
                                var ToReturn = "";
                                if(row.Status != ""){
                                    ToReturn = "<div style='text-align: center;'><a href='EvaluationResume.php?id="+data+"' target='_blank'><i style='cursor: pointer;' id='Record_"+data+"' class='fa fa-print Print'></i></a></div>";
                                }
                                //return "<div style='text-align: center;'><a href='EvaluationResume.php?id="+data+"' target='_blank'><i style='cursor: pointer;' id='Record_"+data+"' class='fa fa-print Print'></i></a></div>";
                                return ToReturn;
                            }
                        }
                    ]
                });
            },
            error: function(){
            }
        });
    }
    function PreloadRecordTable(){
        var dataSet = [];
        RecordTable = $('#Records').DataTable({
            data: dataSet,
            columns: [
                { data: 'Cartera' },
                { data: 'Filename' },
                { data: 'Listen' },
                { data: 'Date' },
                { data: 'Status' }, 
                { data: 'Evaluar' },
                { data: 'Imprimir' }
            ],
            "columnDefs": [ 
                {
                    "targets": 2,
                    "data": 'Listen',
                    "render": function( data, type, row ) {
                        return "<audio src='"+data+"' preload='auto' controls></audio>";
                    }
                },
                {
                    "targets": 5,
                    "data": 'Evaluar',
                    "render": function( data, type, row ) {
                        return "<div style='text-align: center;'><i style='cursor: pointer;' id='Record_"+data+"' class='fa fa-pencil AddEvaluation'></i></div>";
                    }
                },
                {
                    "targets": 6,
                    "data": 'Imprimir',
                    "render": function( data, type, row ) {
                        var ToReturn = "";
                        if(row.Status != ""){
                            ToReturn = "<div style='text-align: center;'><a href='EvaluationResume.php?id="+data+"' target='_blank'><i style='cursor: pointer;' id='Record_"+data+"' class='fa fa-print Print'></i></a></div>";
                        }
                        //return "<div style='text-align: center;'><a href='EvaluationResume.php?id="+data+"' target='_blank'><i style='cursor: pointer;' id='Record_"+data+"' class='fa fa-print Print'></i></a></div>";
                        return ToReturn;
                    }
                }
            ]
        });
    }
    function UpdateEvaluations(){
        CantEvaluations = 0;
        EvaluationTable = $('#Evaluations').DataTable({
            data: EvaluationsArray,
            paging: false,
            iDisplayLength: 100,
            columns: [
                { data: 'Nombre' },
                { data: 'Descripcion' },
                { data: 'Esperado' },
                { data: 'Ponderacion' },
                { data: 'Nota' },
                { data: 'CalificacionPonderada' }, 
                { data: 'Observacion' },
                { data: 'Actions' },
                { data: 'ObservacionText' }
            ],
            "columnDefs": [ 
                {
                    className: "DescriptionObject",
                    "targets": 1,
                },
                {
                    className: "dt-center",
                    "targets": 2,
                    "data": 'Esperado',
                    "render": function( data, type, row ) {
                        return "<button class='btn btn-primary showEsperadoModal' text='"+data+"'>?</button>";
                    }
                },
                {
                    className: "dt-right PonderacionObject",
                    "targets": 3,
                    "searchable": false
                },
                {
                    className: "dt-right NoteObject",
                    "targets": 4,
                    "searchable": false
                },
                {
                    className: "dt-right CalfPonderadaObject",
                    "targets": 5,
                    "searchable": false
                },
                {
                    "targets": 6,
                    "data": 'Observacion',
                    "render": function( data, type, row ) {
                        return "<div style='text-align: center;'><i style='cursor: pointer;' class='fa fa-pencil AddNote'></i></div>";
                    }
                },
                {
                    "targets": 7,
                    "data": 'Actions',
                    "render": function( data, type, row ) {
                        return "<div style='text-align: center;'><i style='cursor: pointer; margin: 0 10px;' class='fa fa-times-circle icon-lg Delete'></i><i style='cursor: pointer; margin: 0 10px;' class='fa fa-pencil Update'></div>";
                    }
                },
                {
                    "targets": 8,
                    className: "ObservationObject hide_column",
                    "searchable": false,
                    "data": "ObservacionText"
                },
            ]
        });
        //EvaluationTable.order([4, 'asc']).draw();
        EvaluationTable.page('last').draw(false);
        $("#Evaluations").trigger('update');
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
        EvaluationTable.row.add(
            { 
                "Descripcion": Description,
                "Ponderacion": Ponderacion,
                "Nota": Number("0").toFixed(2),
                "CalificacionPonderada": Number("0").toFixed(2),
                "Observacion": "",
                "ObservacionText": ""
            }
        ).draw(false);
        //EvaluationTable.order([4, 'asc']).draw();
        EvaluationTable.page('last').draw(false);
        $("#Evaluations").trigger('update');
    }
    function AddNote(ObjectObservation, TextObservation, ObjectNote, Note, ObjectPonderacion, ObjectCalfPonderada){
        ObjectObservation.html(TextObservation);
        ObjectNote.html(Note);
        var Ponderacion = Number(ObjectPonderacion.text());
        ObjectCalfPonderada.html(((Ponderacion * Note) / 100).toFixed(2));
        $("#Evaluations").trigger('update');
    }
    function UpdateEvaluationSummaryFoot(){
        var ContEvaluaciones = 0;
        var SumPonderacion = 0;
        var SumNotas = 0;
        var SumCalPonderada = 0;
        $("#Evaluations tbody tr").each(function(indexTR){
            ContEvaluaciones++;
            $(this).find("td").each(function(indexTD){
                switch(indexTD){
                    case 3:
                        SumPonderacion += Number($(this).text());
                    break;
                    case 4:
                        SumNotas += Number($(this).text());
                    break;
                    case 5:
                        SumCalPonderada += Number($(this).text());
                    break;
                }
            });
        });
        $("#SumPonderacion").html(SumPonderacion.toFixed(2));
        $("#PromNota").html((SumNotas / ContEvaluaciones).toFixed(2));
        $("#PromCalPonderada").html(SumCalPonderada.toFixed(2));
        AddClassModalOpen();
    }
    function DeleteEvaluation(TableRow){
        EvaluationTable.row(TableRow).remove().draw();
        $("#Evaluations").trigger('update');
    }
    function UpdateEvaluation(TableRow, Description, Ponderacion){
        var ObjectDescription = TableRow.find(".DescriptionObject");
        var ObjectPonderacion = TableRow.find(".PonderacionObject");
        ObjectDescription.html(Description);
        ObjectPonderacion.html(Number(Ponderacion).toFixed(2));
        $("#Evaluations").trigger('update');
    }
    function SaveEvaluation(NewEvaluation, TableTmp){
        if(NewEvaluation){
            var IDtmp = PrintObject.closest("tr").find(".AddEvaluation").attr("id");
            var IDArray = IDtmp.split("_");
            AddEvaluation_DB(RecordId,TableTmp);
            StatusObject.html("Evaluada");
            PrintObject.html("<div style='text-align: center;'><a href='EvaluationResume.php?id="+IDArray[1]+"' target='_blank'><i style='cursor: pointer;' id='Record_"+IDArray[1]+"' class='fa fa-print Print'></i></a></div>");
            /*Cartera = CarteraObject.html();
            CarteraObject.html("<span class='checkbox'><input id='"+IDArray[1]+"' class='magic-checkbox groupSelecter' type='checkbox'><label for='"+IDArray[1]+"'>"+Cartera+"</label></span>");*/
        }else{
            UpdateEvaluation_DB(RecordId,TableTmp);
        }
    }
    function AddEvaluation_DB(RecordId,TableTmp){
        $.ajax({
            type: "POST",
            url: "../includes/calidad/AddEvaluation.php",
            dataType: "html",
            data: {
                PersonalUsername: Ejecutivo[1],
                RecordId: RecordId,
            },
            success: function(data){
                if(data != "0"){
                    Id_Evaluation = data;
                    AddEvaluationDetails(Id_Evaluation,TableTmp);
                }
            },
            error: function(){
            }
        });
    }
    function AddEvaluationDetails(Id_Evaluacion,TableTmp){
        var EvaluationsArray = [];
        var ContEvaluations = 0;
        TableTmp.find("tbody tr").each(function(indexTR){
            var Resumen = "";
            var Description = "";
            var Esperado = "";
            var Ponderacion = "";
            var Nota = "";
            var Observacion = "";
            var Evaluation = [];

            $(this).find("td").each(function(indexTD){
                switch(indexTD){
                    case 0:
                        Resumen = $(this).text();
                    break;
                    case 1:
                        //Description
                        Description = $(this).text();
                    break;
                    case 2:
                        //Esperado
                        Esperado = $(this).find("button").attr("text");
                    break;
                    case 3:
                        //Ponderacion
                        Ponderacion = $(this).text();
                    break;
                    case 4:
                        //Nota
                        Nota = $(this).text();
                    break;
                    case 5:
                        //Calificacion Ponderada
                    break;
                    case 6:
                        //Observacion (Boton)
                    break;
                    case 7:
                        //Acciones
                    break;
                    case 8:
                        //Observacion
                        Observacion = $(this).text();
                    break;
                }
            });
            Evaluation[0] = Resumen;
            Evaluation[1] = Description;
            Evaluation[2] = Esperado;
            Evaluation[3] = Ponderacion;
            Evaluation[4] = Nota;
            Evaluation[5] = Observacion;
            EvaluationsArray[ContEvaluations] = Evaluation;
            ContEvaluations++;
        });
        $.ajax({
            type: "POST",
            url: "../includes/calidad/AddEvaluationDetails.php",
            dataType: "html",
            data: {
                Id_Evaluacion: Id_Evaluacion, 
                Evaluations: EvaluationsArray
            },
            success: function(data){
                console.log(data);
            },
            error: function(){
            }
        });
    }
    function UpdateEvaluation_DB(RecordId,TableTmp){

        $.ajax({
            type: "POST",
            url: "../includes/calidad/UpdateEvaluation.php",
            dataType: "html",
            data: {
                RecordId: RecordId,
            },
            success: function(data){
                if(data != "0"){
                    Id_Evaluation = data;
                    AddEvaluationDetails(Id_Evaluation,TableTmp);
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
                    case 1:
                        //Description
                    break;
                    case 3:
                        //Ponderacion
                        SumPonderacion += Number($(this).text());
                    break;
                    case 4:
                        //Nota
                    break;
                    case 5:
                        //Calificacion Ponderada
                    break;
                    case 6:
                        //Observacion (Boton)
                    break;
                    case 7:
                        //Acciones
                    break;
                    case 8:
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
    $("body").on("click",".showEsperadoModal",function(){
        var Text = $(this).attr("text");
        CustomAlert(Text);
    });
});