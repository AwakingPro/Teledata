$(document).ready(function(){
    
    function ReadOnly()
    {
        $('#SeleccioneTipoEstrategia').prop( "disabled", true );
        $('#SeleccioneTipoEstrategia').val('').selectpicker('refresh');
        $('#SeleccioneTabla').prop( "disabled", true );
        $('#SeleccioneTabla').val('').selectpicker('refresh');
        $('#SeleccioneColumna').prop( "disabled", true );
        $('#SeleccioneColumna').val('').selectpicker('refresh');
        $('#SeleccioneLogica').prop( "disabled", true );
        $('#SeleccioneLogica').val('').selectpicker('refresh');
        $('#SeleccioneValor').prop( "disabled", true );
        $('#SeleccioneValor').val('');
        $('#SeleccioneValor').val('').selectpicker('refresh');
        $('.IntegerValidar').prop( "disabled", true );
        $('.IntegerValidar').val('');
        $('#NombreCola').prop( "disabled", true );
        $('#NombreCola').val('');
        $('#CrearEstrategia').prop( "disabled", true );
        $('#CrearEstrategia').val('');
       
    }

    function ReadOnlyTablas()
    {
        $('#SeleccioneTabla').prop( "disabled", true );
        $('#SeleccioneTabla').val('').selectpicker('refresh');
        $('#SeleccioneColumna').prop( "disabled", true );
        $('#SeleccioneColumna').val('').selectpicker('refresh');
        $('#SeleccioneLogica').prop( "disabled", true );
        $('#SeleccioneLogica').val('').selectpicker('refresh');
        $('#SeleccioneValor').prop( "disabled", true );
        $('#SeleccioneValor').val('');
        $('.IntegerValidar').prop( "disabled", true );
        $('.IntegerValidar').val('');
        $('#NombreCola').prop( "disabled", true );
        $('#NombreCola').val('');
        $('#CrearEstrategia').prop( "disabled", true );
        $('#CrearEstrategia').val('');
    }

    function ReadOnlyColumnas()
    {
        $('#SeleccioneColumna').prop( "disabled", true );
        $('#SeleccioneColumna').val('').selectpicker('refresh');
        $('#SeleccioneLogica').prop( "disabled", true );
        $('#SeleccioneLogica').val('').selectpicker('refresh');
        $('#SeleccioneValor').prop( "disabled", true );
        $('#SeleccioneValor').val('');
        $('.IntegerValidar').prop( "disabled", true );
        $('.IntegerValidar').val('');
        $('#NombreCola').prop( "disabled", true );
        $('#NombreCola').val('');
        $('#CrearEstrategia').prop( "disabled", true );
        $('#CrearEstrategia').val('');
    }

    function ReadOnlyLogica()
    {
        $('#SeleccioneLogica').prop( "disabled", true );
        $('#SeleccioneLogica').val('').selectpicker('refresh');
        $('#SeleccioneValor').prop( "disabled", true );
        $('#SeleccioneValor').val('');
        $('.IntegerValidar').prop( "disabled", true );
        $('.IntegerValidar').val('');
        $('#NombreCola').prop( "disabled", true );
        $('#NombreCola').val('');
        $('#CrearEstrategia').prop( "disabled", true );
        $('#CrearEstrategia').val('');
    }

    function ReadOnlyValor()
    {

        $('#SeleccioneValor').prop( "disabled", true );
        $('#SeleccioneValor').val('');
        $('.IntegerValidar').prop( "disabled", true );
        $('.IntegerValidar').val('');
        $('#NombreCola').prop( "disabled", true );
        $('#NombreCola').val('');
        $('#CrearEstrategia').prop( "disabled", true );
        $('#CrearEstrategia').val('');
    }
    function ReadOnlyCola()
    {

        $('#NombreCola').prop( "disabled", true );
        $('#NombreCola').val('');
        $('#CrearEstrategia').prop( "disabled", true );
        $('#CrearEstrategia').val('');
    }

    function ReadOnlyBoton()
    {

        $('#CrearEstrategia').prop( "disabled", true );
        $('#CrearEstrategia').val('');
    }

    function ReadOnlyTipo()
    {
        $('#SeleccioneTabla').prop( "disabled", true );
        $('#SeleccioneTipoEstrategia').selectpicker('refresh'); 
        $('#SeleccioneColumna').prop( "disabled", true );
        $('#SeleccioneTipoEstrategia').selectpicker('refresh');  
        $('#SeleccioneLogica').prop( "disabled", true );
        $('#SeleccioneTipoEstrategia').selectpicker('refresh');  
    }

    function NoReadOnly()
    {
        $('#SeleccioneTipoEstrategia').prop("disabled", false);
        $('#SeleccioneTipoEstrategia').selectpicker('refresh');  
    }
    var IdEstrategia = $('#IdEstrategia').val();
    var DataIdEstrategia = "IdEstrategia="+IdEstrategia;

    function MostrarEstrategias(DataIdEstrategia)
    {
        $.ajax(
        {
            type: "POST",
            url: "../includes/estrategia/VerEstrategias.php",
            data:DataIdEstrategia,
            success: function(response)
            {
                if(response==0)
                {
                    $('#DivMostrarEstrategias').html('<icon class="fa fa-warning"> </icon> Debe Crear una Estrategia');
                    $('#Deshacer').prop( "disabled", true );

                    NoReadOnly();
                }
                else
                {
                    ReadOnly();
                    $('#DivMostrarEstrategias').html(response);

                }
            }
        });   
    }
    MostrarEstrategias(DataIdEstrategia);
    
    
    var IdCedente = $('#IdCedente').val();
    var DataTotal = "IdCedente="+IdCedente;
    
    function Registros(DataTotal)
    {
        $.ajax(
        {
            type: "POST",
            url: "../includes/estrategia/Total.php",
            data:DataTotal,
            success: function(response)
            {
                $("#DivRegistros").html(response);
            }
        });   
    }
    Registros(DataTotal);
    
    $(document).on('change', '#SeleccioneTipoEstrategia', function()
    {

        var IdTipoEstrategia = $('#SeleccioneTipoEstrategia').val();
        if(IdTipoEstrategia=='-1')
        {
            ReadOnlyTablas();
        }
        else
        {
            var IdCedente = $('#IdCedente').val();
            var IdEstrategia = $('#IdEstrategia').val();
            var DataIdCedente = "IdCedente="+IdCedente+"&IdTipoEstrategia="+IdTipoEstrategia+"&IdEstrategia="+IdEstrategia;
            $.ajax(
            {
                type: "POST",
                url: "../includes/estrategia/MostrarTabla.php",
                data:DataIdCedente,
                success: function(response)
                {
                    if(response==0)
                    {
                        $.niftyNoty(
                        {
                            type: 'danger',
                            icon : 'fa fa-close',
                            message : 'Debe crear una estrategia Estatica!' ,
                            container : 'floating',
                            timer : 2000
                        });
                        ReadOnlyTablas();
                        
                    }
                    
                    else
                    {
                        $('#DivTabla').html(response);
                        $('#SeleccioneTabla').selectpicker('refresh');
                    }
                    
                }
            }); 
        }
        
    });
    
    

    $(document).on('change', '#SeleccioneTabla', function()
    {
        var IdTabla = $('#SeleccioneTabla').val();
        if(IdTabla=='-1')
        {
           ReadOnlyColumnas();
        }
        else
        {
            var DataIdTabla = "IdTabla="+IdTabla;
            $.ajax(
            {
                type: "POST",
                url: "../includes/estrategia/MostrarColumna.php",
                data:DataIdTabla,
                success: function(response)
                {
                    $('#DivColumna').html(response);
                    $('#SeleccioneColumna').selectpicker('refresh');
                }
            });  
        }
             
    });   

    $(document).on('change', '#SeleccioneColumna', function()
    {
        var IdColumna = $('#SeleccioneColumna').val();
        if(IdColumna=='-1')
        {
           ReadOnlyLogica();
        }
        else
        {
            var DataIdColumna = "IdColumna="+IdColumna;
            $.ajax(
            {
                type: "POST",
                url: "../includes/estrategia/MostrarLogica.php",
                data:DataIdColumna,
                success: function(response)
                {
                    $('#DivLogica').html(response);
                    $('#SeleccioneLogica').selectpicker('refresh');
                }
            }); 
        }
              
    }); 

    $(document).on('change', '#SeleccioneLogica', function()
    {
        var IdLogica = $('#SeleccioneLogica').val();
        if(IdLogica=='-1')
        {
            ReadOnlyValor();
        }
        else
        {
            var Id = $('#SeleccioneColumna').val();
            var DataIdLogica = "IdLogica="+IdLogica+"&Id="+Id;
            $.ajax(
            {
                type: "POST",
                url: "../includes/estrategia/MostrarValor.php",
                data:DataIdLogica,
                success: function(response)
                {
                    if(response==1)
                    {
                        $('#DivValor').html('<div id="demo-dp-component"><div class="input-group date"><input type="text" class="form-control" id="SeleccioneValor"><span class="input-group-addon"><i class="fa fa-calendar fa-lg"></i></span></div></div><br>');
                        $('#SeleccioneValor').datepicker({autoclose:true,format: "yyyy-mm-dd", weekStart: 1, language: 'es'});
                    }
                    else if(response==0)
                    {
                        $('#DivValor').html('<input type="text" class="form-control IntegerValidar" ><br>');
                    }
                    else
                    {
                        $('#DivValor').html(response);
                        $('#SeleccioneValor').selectpicker('refresh');
                    }
                }
            });    
        }
           
    }); 

    $(document).on('change', '#SeleccioneValor', function()
    {
        
        var IdValor = $('#SeleccioneValor').val();
        if(IdValor=='-1' || IdValor=='')
        {
            ReadOnlyCola();
        }
        else
        {
            $('#DivCola').html('<input type="text" class="form-control" id="NombreCola">');
        }
        
    });

    $(document).on('change', '#NombreCola', function()
    {
        var IdCola = $('#NombreCola').val();
        if(IdCola=='')
        {
            ReadOnlyBoton();
        }
        else
        {
            $('#CrearEstrategia').prop( "disabled", false );
        }    
    });

     $(document).on('click', '#CrearEstrategia', function()
    {
        $('body').addClass("loading");
        var Valor = '';
        var NombreCola = $('#NombreCola').val();
        var Logica = $('#SeleccioneLogica').val();
        var IdColumna = $('#SeleccioneColumna').val();
        var IdCedente = $('#IdCedente').val();
        var IdEstrategia = $('#IdEstrategia').val();
        var IdSubQuery = $('#IdSubQuery').val();
        var IdTabla = $('#SeleccioneTabla').val();
        
        if($('.IntegerValidar').length > 0 )
        {
            var IntValor = $('.IntegerValidar').val(); 
            Valor = IntValor.replace(/\./g,'');
           
        }
        else
        {
             Valor = $('#SeleccioneValor').val();
        }
        var DataQuery = "Valor="+Valor+"&Logica="+Logica+"&NombreCola="+NombreCola+"&IdColumna="+IdColumna+"&IdCedente="+IdCedente+"&IdEstrategia="+IdEstrategia+"&IdSubQuery="+IdSubQuery+"&IdTabla="+IdTabla;
        $.ajax(
        {
            type: "POST",
            url: "../includes/estrategia/CrearQuery.php",
            data:DataQuery,
            success: function(response)
            {
                $('#DivMostrarEstrategias').html(response);
                $('body').removeClass("loading");
                ReadOnly();
                $('#Deshacer').prop( "disabled", false );
                
            }
        });    
    });

    $(document).on('click', '.SubEstrategia', function()
    {
        var IdSubQuery = $(this).closest('tr').attr('id');
        $('#IdSubQuery').val(IdSubQuery);
        var NewIdSubQuery = $('#IdSubQuery').val();
        var DataMover = "IdSubQuery="+NewIdSubQuery;
        $.ajax(
        {
            type: "POST",
            url: "../includes/estrategia/MoverGrupo.php",
            data:DataMover,
            success: function(response)
            {
                $.niftyNoty(
                {
                    type: 'primary',
                    icon : 'fa fa-check',
                    message : response ,
                    container : 'floating',
                    
                    timer : 2000
                });
                $("#DivRegistros").html(response);
                NoReadOnly();
            }
        });  
        

    });

    $(document).on('change', '.Prioridad', function()
    {
        var Prioridad = $(this).closest('tr').attr('id');
        var ValorPrioridad = $('#P'+Prioridad).val();
        var DataPrioridad = 'Id='+Prioridad+"&ValorPrioridad="+ValorPrioridad;
        $.ajax(
        {
            type: "POST",
            url: "../includes/estrategia/ActualizarPrioridad.php",
            data:DataPrioridad,
            success: function(response)
            {
                $.niftyNoty(
                {
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Prioridad Actualizada' ,
                    container : 'floating',
                    timer : 2000
                });
            }
        });  
    });

    $(document).on('change', '.Comentario', function()
    {
        var Comentario = $(this).closest('tr').attr('id');
        var ValorComentario = $('#C'+Comentario).val();
        var DataComentario = 'Id='+Comentario+"&ValorComentario="+ValorComentario;
        $.ajax(
        {
            type: "POST",
            url: "../includes/estrategia/ActualizarComentario.php",
            data:DataComentario,
            success: function(response)
            {
                $.niftyNoty(
                {
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Comentario Actualizado' ,
                    container : 'floating',
                    timer : 2000
                });
            }
        });  
    });

    $(document).on('change', '.Cola', function()
    {
        var Cola = $(this).closest('tr').attr('id');
        var ValorCola= $('#K'+Cola).val();
        var DataCola = 'Id='+Cola+"&ValorCola="+ValorCola;
        $.ajax(
        {
            type: "POST",
            url: "../includes/estrategia/ActualizarCola.php",
            data:DataCola,
            success: function(response)
            {
                $.niftyNoty(
                {
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Nombre Grupo Actualizado.' ,
                    container : 'floating',
                    timer : 2000
                });
            }
        });  
    });


    $(document).on('keyup', '.IntegerValidar', function()
    {
        
        this.value = (this.value + '').replace(/[^0-9]/g, '').replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
        var IntValidar = this.value;
        
        if(IntValidar=='')
        {
            $('#NombreCola').prop( "disabled", true);
            $('#NombreCola').val('');
        }
        else
        {            
            $('#DivCola').html('<input type="text" class="form-control" id="NombreCola">');
        }
        
    });

    $(document).on('click', '.Terminal', function()
	{
    	var IdTerminal = $(this).closest('tr').attr('id');
        var Terminal = '#T'+IdTerminal;
		if ($(Terminal).is(':checked')) 
		{ 
            var DataTerminal = "IdTerminal="+IdTerminal+"&Check=1";
            $.ajax(
            {
                type: "POST",
                url: "../includes/estrategia/Terminal.php",
                data:DataTerminal,
                success: function(response)
                {
                    
                    $.niftyNoty(
                    {
                        type: 'success',
                        icon : 'fa fa-check',
                        message : "Cola Terminal Activada" ,
                        container : 'floating',
                        timer : 2000
                    });
                    
                }
            });  
        }
        else
        {
            var DataTerminal = "IdTerminal="+IdTerminal+"&Check=0";
            $.ajax(
            {
                type: "POST",
                url: "../includes/estrategia/Terminal.php",
                data:DataTerminal,
                success: function(response)
                {
                    
                    $.niftyNoty(
                    {
                        type: 'warning',
                        icon : 'fa fa-check',
                        message : "Cola Terminal Desactivada!" ,
                        container : 'floating',
                        timer : 2000
                    });
                    
                }
            });  
        }    

        
    });

    $('#Deshacer').on('click', function()
    {
		var IdEstrategia = $('#IdEstrategia').val();
        var DataDeshacer = 'IdEstrategia='+IdEstrategia;
        bootbox.confirm("Esta Seguro de Deshacer la Última Segmentación?", function(result) 
        {
			if (result) 
            {
				
                $.ajax(
                {
                    type: "POST",
                    url: "../includes/estrategia/Deshacer.php",
                    data:DataDeshacer,
                    success: function(response)
                    {
                        $.niftyNoty(
                        {
                            type: 'warning',
                            icon : 'fa fa-check',
                            message : 'Última División Eliminada' ,
                            container : 'floating',
                            timer : 2000
                        });
                        MostrarEstrategias(DataDeshacer);
                        $('#IdSubQuery').val(0);
                        Registros(DataTotal);
                    }
                });  
			}
            else
            {

			};

		});
	});

    $('#crear_estrategia').submit(function(e)
    {
        e.preventDefault();
        if($("#nombre_estrategia").val().length < 5)
        {
	        $.niftyNoty(
            {
                type: 'danger',
                icon : 'fa fa-check',
                message : 'El nombre debe tener como mínimo 5 caracteres' ,
                container : 'floating',
                timer : 2000
            });
        }
        else
        {
		    var nombre_estrategia = $('#nombre_estrategia').val();
		    var tipo_estrategia = $('#tipo_estrategia').val();
		    var comentario_estrategia = $('#comentario_estrategia').val();
		    var usuario = $('#usuario').val();
		    var cedente = $('#cedente').val();
            var idUsuario = $('#idUsuario').val();
		    console.log(usuario);
		    var datos_estrategia = 'nombre_estrategia='+nombre_estrategia+'&comentario_estrategia='+comentario_estrategia+'&tipo_estrategia='+tipo_estrategia+'&cedente='+cedente+'&usuario='+usuario+'&idUsuario='+idUsuario;
     		$.ajax(
	   		{
			  type: "POST",
				url: "../includes/estrategia/crear_estrategia.php",
				data:datos_estrategia,
				success: function(response)
				{
	                window.location.replace("VerEstrategias.php");
				}
			});
   		}
    });

    $('#Actualizar').on('click', function(){
        $('body').addClass("loading");
        var IdCedente = $('#IdCedente').val();
        $.ajax({
            type: "POST",
            url: "../includes/estrategia/recalculaQueryCedente.php",
            data:"IdCedente="+IdCedente,
            success: function(response){
                    $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Estrategia Actualizada' ,
                    container : 'floating',
                    timer : 2000
                });
                $('body').removeClass("loading");
                window.location.replace("VerEstrategias.php");
            }
		});
    });

    



});