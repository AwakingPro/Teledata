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
				if ($(obj).val() == "") {
					bootbox.alert('<h3 class="text-center">Disculpe el campo '+$(obj).attr('name')+' es obligatorio.</h3>');
					break;
				}
			default:
				return true;
		}
	}else{
		return true;
	}
}

$.post('../ajax/menu/mainMenu.php', {url: window.location.pathname}, function(data) {
	$('#mainnav-menu').html(data);
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

});

$('.containerHeader').load('../ajax/header/mainHeader.php');


$(document).on('click', '.itemsMenu', function() {
	$(this).siblings('.collapse').slideToggle();
});

$(document).on('click', '.tgl-menu-btn', function(event){
	event.preventDefault();
	if ($('.effect').attr('attr') == 1) {
		$('.effect').addClass('mainnav-sm');
		$('.effect').removeClass('mainnav-lg');
		$('.effect').attr('attr', '');
	}else{
		$('.effect').addClass('mainnav-lg');
		$('.effect').removeClass('mainnav-sm');
		$('.effect').attr('attr', '1');
	}
});