$.postFormValues = function(url) {
	if ($('.cont-form').length) {
		var formValues = new FormData();
		$('.cont-form').find("input,input[type='checkbox']:checked,input[type='radio']:checked,textarea,select").each(function(index, obj) {
			if (obj.hasAttribute('name')) {
				formValues.append($(obj).attr('name'), $(obj).val());
			}
		});
		$.ajax({
			url: url,
			type: 'POST',
			data: formValues,
			processData: false,
			contentType: false,
			success: function(e) {
				alert('Esta es la respuesta del ajax'+ e);
			}
		});
	}
}