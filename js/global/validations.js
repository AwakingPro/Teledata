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