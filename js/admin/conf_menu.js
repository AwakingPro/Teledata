$(document).ready(function(){
    $.ajax({
        type: "POST",
        url: "../includes/admin/getDatatableMenu.php",
        dataType: 'html',
        success: function(data){

            data = JSON.parse(data)

            $.each(data.headers, function( index, array ) {
                $('#TableMenu_thead').append('<th class="min-desktop"><center>'+array+'</center></th>')
            });

            $.each(data.menus, function( index, menus ) {
                $('#TableMenu_tbody').append('<tr id='+index+'>')
                $.each(menus, function( i, array ) {
                    if(i > 1){
                        $('#'+index).append('<td><center>'+array+'</center></td>')
                    }else{
                        $('#'+index).append('<td>'+array+'</td>')
                    }
                });

                $('#TableMenu_tbody').append('</tr>')
            });

            TableMenu = $('#TableMenu').DataTable({
                "bPaginate": false,
                "bFilter": false,
                "bInfo": false
            });

        },
        error: function(response){
            console.log(response);
        }
    });
});

$(document).on('change', 'input[type=checkbox]', function() {
    if($(this).is(":checked")) {
        $.ajax({
            type: "POST",
            url: "../includes/admin/crear_privilegio.php",
            data:"&id="+$(this).attr('id'),
            success: function(data){
                console.log('success privilegio');
            },
            error: function(response){
                console.log('error privilegio');
            }
        });
    }else{
        $.ajax({
            type: "POST",
            url: "../includes/admin/eliminar_privilegio.php",
            data:"&id="+$(this).attr('id'),
            success: function(data){
                console.log('success privilegio');
            },
            error: function(response){
                console.log('error privilegio');
            }
        });
    }
});