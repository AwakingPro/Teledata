
audiojs.events.ready(function() {
    audiojs.createAll();
});
$(document).ready(function() {
    var RecordTable;
    var CierreId;
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

    
    $("#FiltrarPorFecha").click(function(){
        var startDate = $("#date-range .input-daterange input[name='start']").val();
        var endDate = $("#date-range .input-daterange input[name='end']").val();
        if((startDate != "") && (endDate != "")){
            //FillCarteraList(startDate,endDate);
            FillPersonalList(startDate,endDate,GlobalData.nombre_cedente);
        }
    });

    $("body").on("change","select[name='Ejecutivo']",function(){
        var Val = $(this).val();
        var startDate = $("#date-range .input-daterange input[name='start']").val();
        var endDate = $("#date-range .input-daterange input[name='end']").val();
        var Cartera = GlobalData.nombre_cedente;
        var IdCedente = GlobalData.id_cedente;
        if(Val != ""){
            Ejecutivo[0] = $(this).find("option:selected").text().toUpperCase();
            Ejecutivo[1] = $(this).val();
            RecordTable.destroy();
            UpdateRecords(startDate,endDate,IdCedente);
        }
    });
    $('body').on('click','.Visualizar', function(){
        var Template = $("#Calificacion").html();

        CierreId = $(this).attr("id");
        CierreId = CierreId.substr(CierreId.indexOf("_") + 1, CierreId.length);
        bootbox.dialog({
            title: "CALIFICACIÓN GENERAL DE LA EVALUACIÓN DE " + Ejecutivo[0],
            message: Template,
            buttons: {
                confirm: {
                    label: "Salir",
                    callback: function() {
                        
                    }
                }
            },
            size: 'large'
        }).off("shown.bs.modal");
        $.ajax({
            type: "POST",
            url: "../includes/calidad/GetCierre.php",
            data: { CierreId: CierreId },
            dataType: "html",
            success: function(data){
                var Evaluation = JSON.parse(data);
                Evaluation = Evaluation[0];
                var Id_Evaluaciones = Evaluation.Id_Evaluaciones;
                $.ajax({
                    type: "POST",
                    url: "../includes/calidad/GetEvaluationDetailsCierre.php",
                    data: { Id_Evaluaciones: Id_Evaluaciones },
                    dataType: "html",
                    success: function(data1){
                        EvaluationsArray = JSON.parse(data1);
                        UpdateEvaluations();
                        $("#SumPonderacion").html(Evaluation.Ponderacion);
                        $("#PromNota").html(Evaluation.Nota);
                        $("#PromCalPonderada").html(Evaluation.Calf_Ponderada);
                        $("#Observation_aspectosF").val(Evaluation.Aspectos_Fortalecer);
                        $("#Observation_aspectosC").val(Evaluation.Aspectos_Corregir);
                        $("#Observation_comprimisoE").val(Evaluation.Compromiso_Ejecutivo);
                    },
                    error: function(){
                    }
                });
            },
            error: function(){
            }
        });
    });
    $("body").on("click",".close",function(){
        AddClassModalOpen();
    });
    function FillPersonalList(startDate, endDate, Cartera){
        $.ajax({
            type: "POST",
            url: "../includes/personal/fillSelectCierres.php",
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
    function UpdateRecords(startDate, endDate, IdCedente){
        $.ajax({
            type: "POST",
            url: "../includes/calidad/GetCierres.php",
            data: { 
                Ejecutivo: $("select[name='Ejecutivo']").val(),
                IdCedente: IdCedente,
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
                RecordTable = $('#Cierres').DataTable({
                    data: dataSet,
                    columns: [
                        { data: 'AspectosF' },
                        { data: 'AspectosC' },
                        { data: 'CompromisoE' },
                        { data: 'Date' },
                        { data: 'Visualizar' },
                        { data: 'Imprimir' }
                    ],
                    "columnDefs": [ 
                        {
                            "targets": 4,
                            "data": 'Evaluar',
                            "render": function( data, type, row ) {
                                return "<div style='text-align: center;'><i style='cursor: pointer;' id='Cierre_"+data+"' class='fa fa-pencil Visualizar'></i></div>";
                            }
                        },
                        {
                            "targets": 5,
                            "data": 'Imprimir',
                            "render": function( data, type, row ) {
                                var ToReturn = "";
                                if(row.Status != ""){
                                    ToReturn = "<div style='text-align: center;'><a href='EvaluationResume.php?id="+data+"' target='_blank'><i style='cursor: pointer;' id='Cierre_"+data+"' class='fa fa-print Print'></i></a></div>";
                                }
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
        RecordTable = $('#Cierres').DataTable({
            data: dataSet,
            columns: [
                { data: 'AspectosF' },
                { data: 'AspectosC' },
                { data: 'CompromisoE' },
                { data: 'Date' },
                { data: 'Visualizar' },
                { data: 'Imprimir' }
            ],
            "columnDefs": [ 
                {
                    "targets": 4,
                    "data": 'Evaluar',
                    "render": function( data, type, row ) {
                        return "<div style='text-align: center;'><i style='cursor: pointer;' id='Cierre_"+data+"' class='fa fa-pencil Visualizar'></i></div>";
                    }
                },
                {
                    "targets": 5,
                    "data": 'Imprimir',
                    "render": function( data, type, row ) {
                        var ToReturn = "";
                        if(row.Status != ""){
                            ToReturn = "<div style='text-align: center;'><a href='EvaluationResume.php?id="+data+"' target='_blank'><i style='cursor: pointer;' id='Cierre_"+data+"' class='fa fa-print Print'></i></a></div>";
                        }
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
                { data: 'Nombre_Grabacion' },
                { data: 'Grabacion' },
                { data: 'Ponderacion' },
                { data: 'Nota' }, 
                { data: 'CalificacionPonderada' },
            ],
            "columnDefs": [ 
                {
                    "targets": 1,
                    "data": 'Grabacion',
                    "render": function( data, type, row ) {
                        return "<audio src='"+data+"' preload='auto' controls></audio>";
                    }
                },
            ]
        });
        EvaluationTable.order([3, 'asc']).draw();
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
});