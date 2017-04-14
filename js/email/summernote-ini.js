$(document).on('ready', function() {

	// MAILBOX-COMPOSE.HTML
	// =================================================================
	if ($('#summernote').length) {


		// SUMMERNOTE
		// =================================================================
		// Require Summernote
		// http://hackerwins.github.io/summernote/
		// =================================================================
		$('#summernote').summernote({
			height:300
		});
	}    

});
