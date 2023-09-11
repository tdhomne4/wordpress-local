jQuery(function($){
	$( "#frm_niwoovd_setting" ).submit(function( event ) {
		
		jQuery("#niwoovd-notice").html("<p><strong>Please Wait.</strong></p>");
		jQuery("#niwoovd-notice").addClass("notice-info").removeClass("notice-success");
		jQuery("#niwoovd-notice").fadeIn();

		
		
		$.ajax({
			url:niwoovd_ajax_object.niwoovd_ajaxurl,
			data: $(this).serialize(),
			success:function(response) {
				
				jQuery("#niwoovd-notice").removeClass("notice-info").addClass("notice-success");
				jQuery("#niwoovd-notice").html("<p><strong>Settings saved.</strong></p>");
				//jQuery(".ajax_cog_content").html(response);	
				
			},
			error: function(errorThrown){
				console.log(errorThrown);
				//alert("e");
			}
		}); 
		return false; 
	});
});