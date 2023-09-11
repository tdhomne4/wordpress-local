(function( $ ) {
	$(function() {

		$(document).on("click",".category_btn",function(e) {
			e.preventDefault();
			var href = $(this).data("href");
			var prod_id = $(this).data("product-id");
			var term_slug = $('.term_slug').val();
			var processor = $('.processor').val();

			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: redirect_ajax_url,
				data: {
						'href' : href,
						'prod_id' : prod_id,
						'term_slug' : term_slug,
						'processor' : processor,
				},
				success: function(result){
					window.location.href = result.href;
				}
			});
	    });

	});
})(jQuery);