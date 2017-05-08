$.postFormValues = function(url, callback) {
	if ($('.cont-form').length) {
		var count = 0;
		var objs = $('.cont-form').find("input,input[type='checkbox']:checked,input[type='radio']:checked,textarea,select");
		var formValues = new FormData();
		objs.each(function(index, obj) {
			if (obj.hasAttribute('name')) {
				if ($.validate(obj)) {
					formValues.append($(obj).attr('name'), $(obj).val());
					count++;
				}else{
					return false;
				}
			}
		});
		if (objs.length == count) {
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