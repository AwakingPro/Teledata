if (($('#demo-dp-component .input-group.date').size() > 0) || ($('.input-daterange').size() > 0)) {
	$.fn.datepicker.dates['es'] = {
		days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"],
		daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb", "Dom"],
		daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa", "Do"],
		months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
		monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
		today: "Hoy"
	};

	$('#demo-dp-component .input-group.date').datepicker({ autoclose: true, format: "yyyy-mm-dd", weekStart: 1, language: 'es' });

	$('.input-daterange').datepicker({
		format: "yyyy/mm/dd",
		weekStart: 1,
		todayBtn: "linked",
		autoclose: true,
		todayHighlight: true,
		language: 'es'
	});
}

$.ajax({
	type: "POST",
	url: "../includes/facturacion/uf/getValue.php",
	success: function(response) {
		$('.ValorUF').text(response)
		ValorUF = response
	}
});

$.postFormValues = function(url, form,callback) {
	if ($(form).length) {
		var countObjs = 0;
		var countValidates = 0;
		var objs = $(form).find("input,input[type='checkbox']:checked,input[type='radio']:checked,textarea,select");
		var formValues = new FormData();
		objs.each(function(index, obj) {
			if (obj.hasAttribute('name')) {
				countObjs++;
				if ($.validate(obj)) {
					formValues.append($(obj).attr('name'), $(obj).val());
					countValidates++;
				}else{
					return false;
				}
			}
		});
		if (countObjs == countValidates) {
			$.ajax({
				url: url,
				type: 'POST',
				data: formValues,
				processData: false,
				contentType: false,
				success: function(data) {
					callback(data);
				}
			});
		}
	}else{
		return false;
	}
}

$.validate = function(obj) {
	if (obj.hasAttribute('validate')) {
		switch($(obj).attr('validate')) {
			case 'not_null':
				$('#guardarContacto').attr('disabled', false);
				if ($(obj).val() == "") {

					label = $(obj).siblings('label').html()

					if(label){
						$(obj).parent('.form-group').addClass('has-error');
					}else{
						label = $(obj).parent().siblings('label').html()
						$(obj).closest('.form-group').addClass('has-error');
					}

					bootbox.alert('<h3 class="text-center">Disculpe el campo '+label+' es obligatorio.</h3>');
				}else{
					return true;
				}
				break;
			case 'email':
				emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
				if (emailRegex.test($(obj).val())) {
					return true;
				} else {
					$(obj).parent('.form-group').addClass('has-error');
					bootbox.alert('<h3 class="text-center">Disculpe el campo correo no es correcto.</h3>');
				}
				break;
			default:
				return true;
		}
	}else{
		return true;
	}
}

$('input').blur(function() {
	$(this).closest('.form-group').removeClass('has-error');
});

$('.effect').attr('attr', '');
$('.menu-items').hover(function() {
	if ($('.effect').attr('attr') == '') {
		$('.hover-menu').remove()
		var x = $(this).position();
		var top = x.top + 41;
		$('body').append('<span class="hover-menu" style="top:'+top+'px;">'+$(this).html()+'</span>')
	}else{
		$('.menu-items').click(function() {
			if ($(this).find('ul').hasClass('in')){
			    $(this).find('ul').removeClass('in');
			}else{
			    $(this).find('ul').addClass('in');
			}
		});
	}
}, function(){
	$('.hover-menu').hover(function(){}, function() {
		$('.hover-menu').remove()
	});
});


$(document).on('click', '.itemsMenu', function() {
	$(this).siblings('.collapse').slideToggle();
});

$(document).on('click', '.tgl-menu-btn', function(event){
	event.preventDefault();
	if ($('.effect').attr('attr') == 1) {
		$('.effect').addClass('mainnav-sm');
		$('.effect').removeClass('mainnav-in');
		$('.effect').attr('attr', '');
	}else{
		$('.effect').addClass('mainnav-in');
		$('.effect').removeClass('mainnav-sm');
		$('.effect').attr('attr', '1');
	}
});