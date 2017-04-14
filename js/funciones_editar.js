
$(document).ready(function($) {

$('.subestrategia').click(function(e)
    {
                  e.preventDefault();	
    	          var bid = this.id; // button ID 
                  var trid = $(this).closest('tr').attr('id');
                  console.log(trid);
                  var trid_nivel = '<input type="hidden" value="'+trid+'" id="nivel" name="nivel">';                 
                  $('#divnivel').html(trid_nivel);
                  $('#midiv101').hide();
                  $('#midiv100').show();
                  var data='id='+trid;
                  $.ajax({

					      type: "POST",
						  url: "cambiar.php",
						  data:data, 
						  success: function(response)
							{
                            $('#midiv200').html(response);
							}

		                })

                
                  //$('#demo-dt-basic tr:last').before("<tr><td></td><td></td><td></td><td></td></tr><tr><td></td><td></td><td></td><td></td></tr>");
    	          
                })	           
           
	

	 

});