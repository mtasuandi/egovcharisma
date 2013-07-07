jQuery(document).ready(function(){

	jQuery('#egov_ts_favicon_button').click(function(){
		
		wp.media.editor.send.attachment = function(props, attachment){
			jQuery('#egov_ts_favicon').val(attachment.url);
		}

		wp.media.editor.open(this);
		return false;
	});

	jQuery('#egov_ts_logo_button').click(function(){
		
		wp.media.editor.send.attachment = function(props, attachment){
			jQuery('#egov_ts_logo').val(attachment.url);
		}

		wp.media.editor.open(this);
		return false;
	});

});