function ValidarCorreo(Correo) {
    var sw1 = 0;
    var emailreg = /^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/;

    if (!emailreg.test(Correo)) {
        $.niftyNoty({
            type: 'danger',
            icon : 'fa fa-check',
            message : 'El correo no es valido ',
            container : 'floating',
            timer : 3000
        });

        sw1 = 1;
    }else if(Correo.trim() == "" ){

        $.niftyNoty({
            type: 'danger',
            icon : 'fa fa-check',
            message : 'Debe llenar el campo Correo',
            container : 'floating',
            timer : 3000
        });

        sw1 = 1;
    }

    if (sw1 == 1) {
        return false;
    } else {
        return true;
    }
};

function ValidarString(Text, Input) {
    var sw1 = 0;
    if (Text.trim() == "") {
        $.niftyNoty({
            type: 'danger',
            icon : 'fa fa-check',
            message : 'Debe llenar el campo '+Input,
            container : 'floating',
            timer : 3000
        });

        sw1 = 1;
    }
    if (sw1 == 1) {
        return false;
    } else {
        return true;
    }
};

$.postFormValues = function(url, form,callback) {
    if ($(form).length) {
        var countObjs = 0;
        var countValidates = 0;
        var objs = $(form).find("input,input[type='checkbox']:checked,input[type='radio']:checked,textarea,select");
        var formValues = new FormData();
        objs.each(function(index, obj) {
            if (obj.hasAttribute('name')) {
                countObjs++;
                if ($.validation(obj)) {
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

$.validation = function(obj) {
    if (obj.hasAttribute('validation')) {
        switch($(obj).attr('validation')) {
            case 'not_null':
                if ($(obj).val() == "") {

                    $.niftyNoty({
                        type: 'danger',
                        icon : 'fa fa-check',
                        message : 'Debe llenar el campo '+$(obj).data('nombre'),
                        container : 'floating',
                        timer : 3000
                    });

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
});

$('.containerHeader').load('../ajax/header/mainHeader.php');


$(document).on('click', '.itemsMenu', function() {
    $(this).siblings('.collapse').slideToggle();
});