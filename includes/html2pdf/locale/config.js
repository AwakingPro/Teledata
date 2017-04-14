jQuery(document).ready(function($){
	var height = $(window).height();
	var width = $(window).width();
	if(width > 800){
	$(".m_resize").css("min-height", height-80);
	$(".resize").css("height", height-80);
	$("#home").css("height", height);
	}
	$(window).resize(function(){
		var height = $(window).height();
		var width = $(window).width();
		if(width > 800){
		$(".m_resize").css("min-height", height-80);
		$(".resize").css("height", height-80);
		$("#home").css("height", height);
		} else {
			$(".m_resize").attr("style", "");
			$(".resize").attr("style", "");
			$("#home").attr("style", "");			
		}
	});
	/* LOADING */			
	$(window).load(function(){
		setTimeout(function() { $("#loading").fadeOut(1000); }, 500);
	});

	/*Registro*/
	$(".r_button").click(function(){
		$("#registrar").toggleClass("active");
	});

	/*Responsive menu button */
	$("#mbutton").click(function(){
		$("header nav").toggleClass("active");
	});


	/* SAME HEIGHT */

	equalheight = function(container){

		var currentTallest = 0,
		     currentRowStart = 0,
		     rowDivs = new Array(),
		     $el,
		     topPosition = 0;
		$(container).each(function() {

		    $el = $(this);
		    $($el).height('auto')
		    topPostion = $el.position().top;

		   	if (currentRowStart != topPostion) {
			    for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
			       	rowDivs[currentDiv].height(currentTallest);
			    }
			    rowDivs.length = 0; // empty the array
			    currentRowStart = topPostion;
			    currentTallest = $el.height();
			    rowDivs.push($el);
		  	} else {
		    	rowDivs.push($el);
		    	currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
		  	}
		  	for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
		     	rowDivs[currentDiv].height(currentTallest);
		  	}
		});
	}

		$(window).load(function() {
		  equalheight('#about article');
		});


		$(window).resize(function(){
		  equalheight('#about article');
		});

	$(function() {
    	var scntDiv = $('#p_scents');
        var i = $('#p_scents h2').size() + 1;
        var row = 2;
        $('#addScnt').on('click', function() {
                $('<div class="group"><h2><label for="p_scnts"><input type="text" class="p_scnt" size="20" row="'+row+'" name="eccs[]" value="" placeholder="Elemento complementario clave de su servicio" /></label> <button type="button" class="rmvScnt">Eliminar</button></h2><h3><select row="'+row+' name="ieccs[]"><option value="1">Poco importante</option><option value="2">Ligeramente importante</option><option value="3">Medianamente importante</option><option value="4">Muy importante</option><option value="5">Sumamente importante</option><option value="6">No aplica</option><option value="7">No sabe</option></select></h3></div>').appendTo(scntDiv);
                i++;
				row++;
                return false;
        });
        $('#addGrp').on('click', function() {
                $('<div class="group"><h2><label for="p_scnts"><input type="text" class="p_scnt" size="20" name="eccs[]" value="" placeholder="Otro factor no controlable" /></label> <button type="button" class="rmvScnt">Eliminar</button></h2><p><label><input type="radio" name="fnc" value="1">No aplica en su mercado.</label></p><p><label><input type="radio" name="fnc" value="2">No influye, ni amenaza ni oportunidad.</label></p><h3>¿Que tanto AFECTA cada factor a sus objetivos y acciones comerciales?</h3><p><select name="afecta[]"><option value="1">Afecta muy poco.</option><option value="2">Afecta poco.</option><option  value="3">Afecta medianamente.</option><option value="4">Afecta Mucho.</option><option value="5">Afecta Muchisimo.</option></select></p><h3>¿Que tan preparada está SU MARCA para CONTRARESTAR esta amenaza?</h3><p><select name="contrarestar[]"><option value="1">Muy mal preparada.</option><option value="2">Mal preparada.</option><option value="3">Ligeramente preparada.</option><option value="4">Medianamente preparada.</option><option value="5">Bien preparada.</option><option value="6">Muy bien preparada.</option></select></p><h3>¿Que tanto FAVORECE cada factor a sus objetivos y acciones comerciales?</h3><p><select name="contrarestar[]"><option value="1">Favorece muy poco.</option><option value="2">Favorece poco.</option><option value="3">Favorece medianamente.</option><option value="4">Favorece Mucho.</option><option value="5">Favorece Muchisimo.</option></select></p><h3>¿Que tan preparada está SU MARCA para APROVECHAR esta oportunidad?</h3><p><select name="aprovechar[]"><option value="1">Muy mal preparada.</option><option value="2">Mal preparada.</option><option value="3">Ligeramente preparada.</option><option value="4">Medianamente</option><option value="5">Bien preparada.</option><option value="6">Muy bien preparada.</option></select></p></div>').appendTo(scntDiv);
                i++;
                return false;
        });        
        
	});
	$(function() {
		$(document).on("click","button", function(e) {
			$(this).closest(".group").remove();
			e.preventDefault();
		});
	});


});
	