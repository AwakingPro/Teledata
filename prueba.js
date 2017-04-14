$(document).ready(function() 
{
	$('.mas').click(function(){
		var id = $(this).closest('tr').attr('id');
		//$('#demo-dt-basic tr:last').remove();
		$("#uno table tbody tr td:first-child").next("td")
	});
});