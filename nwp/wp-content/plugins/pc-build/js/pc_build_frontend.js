(function( $ ) {
	$(function() {
		
		$('input[name="brand_filter[]"]:checked').each(function(){
			$(this).prop('checked',false);
		});

		$('input[name="rating"]').prop('checked', false);

		var dataTable = $('#empTable').DataTable({
			'processing': true,
			'serverSide': true,
			'serverMethod': 'post',
			//'searching': false, // Remove default Search Control
			'ajax': {
				'url':ajax_url,
				'data': function(data){
					// Read values
					var title = $('#searchByTile').val();
					var minprice = $('#lower').val();
					var maxprice = $('#upper').val();
					var rating = $('input[name="rating"]:checked').val();
					var term_slug = $('.term_slug').val();
					var processor = $('.processor').val();
					var empty_processor = $('.empty_processor').val();
					var brand_filter = new Array();
					$('input[name="brand_filter[]"]:checked').each(function(){
						brand_filter.push($(this).val());
					});

					// Append to data
					data.title = title;
					data.minprice = minprice;
					data.maxprice = maxprice;
					data.rating = rating;
					data.term_slug = term_slug;
					data.processor = processor;
					data.brand_filter = brand_filter;
					data.empty_processor = empty_processor;
				}
			},
		});

		var size_li = $("#myList li").length;
		if(size_li <= 5){
			$('#showLess').hide();
			$('#loadMore').hide();
		}
		var x=5;
		$('#myList li:lt('+x+')').show();
		$('#loadMore').click(function () {
			$('#myList li:lt('+size_li+')').show();
			$('#showLess').show();
			$('#loadMore').hide();
		});
		$('#showLess').click(function () {
			if(size_li <= 5){
				x = size_li;
			}else{
				x= size_li-(size_li - 5);
			}
			$('#myList li').not(':lt('+x+')').hide();
			$('#loadMore').show();
			$('#showLess').hide();
		});

		$('input[name="rating"]').click(function(){
			var ratingVal = $(this).val();
			if(ratingVal == 0){
				ratingVal = 'All';
			}
			$('.display-hidden').show();
			$('.rating-hidden').show();
			$('.rating-hidden').css('display','content');
			$('.rating-filter-val').text(ratingVal);
			dataTable.draw();
		});

		$('.brand-check').click(function(){
			var brand_filter_click = new Array();
			$('input[name="brand_filter[]"]:checked').each(function(){
				brand_filter_click.push('<span class="brand-hidden"><span class="tag label label-info brand-info"><span>Brand: <span class="brand-filter-val">'+$(this).val()+'</span></span><a><i class="remove-brand glyphicon glyphicon-remove-sign glyphicon-white fa fa-close"></i></a></span></span>');
			});
			$('.brand-div').html(brand_filter_click);
			$('.brand-hidden').show();
			dataTable.draw();
		});

		$(document).on("click",".remove-brand",function(e) {
			var uncheck = $(this).closest('a').prev('span').find('.brand-filter-val').text();
			$('input:checkbox[value="' + uncheck + '"]').prop('checked', false);
			$(this).closest('.brand-hidden').remove();
			dataTable.draw();
	    });

		$( ".price-slider" ).slider({
			range: true,
			min: 0,
			max: $('#upper').val(),
			values: [ 0, $('#upper').val() ],
			slide: function( event, ui ) {
				$('.price-hidden').show();
				$('.price-hidden').css('display','content');
				$('.display-hidden').show();
				$( ".price-value" ).text( "£" + ui.values[ 0 ] + " - £" + ui.values[ 1 ] );
				$('.price-filter-val').text("£" + ui.values[ 0 ] + " - £" + ui.values[ 1 ]);
				$('#lower').val(ui.values[ 0 ]);
				$('#upper').val(ui.values[ 1 ]);
				dataTable.draw();
			}
		});
		$( ".price-value" ).text( "£" + $( ".price-slider" ).slider( "values", 0 ) + " - £" + $(".price-slider" ).slider( "values", 1 ) );

		$('.remove-rating').click(function(){
			$('.rating-hidden').hide();
			$('input[name="rating"]').prop('checked', false);
			var rating = $('input[name="rating"]:checked').val();
			dataTable.draw();
		});

		$('.remove-price').click(function(){
			$('.price-hidden').hide();
			$('#upper').val($('#max-val').val());
			$( ".price-slider" ).slider({
				range: true,
				min: 0,
				max: $('#upper').val(),
				values: [ 0, $('#upper').val() ],
			});
			$( ".price-value" ).text( "£0 - £"+$('#upper').val() );
			$('#lower').val(0);
			$('#upper').val($('#upper').val());
			dataTable.draw();
		});

		$('.clear-filter').click(function(){
			$('.rating-hidden').hide();
			$('.brand-div').html('');
			$('input[name="brand_filter[]"]:checked').each(function(){
				$(this).prop('checked',false);
			});
			$('input[name="rating"]').prop('checked', false);
			var rating = $('input[name="rating"]:checked').val();
			$('.price-hidden').hide();
			$('#upper').val($('#max-val').val());
			$( ".price-slider" ).slider({
				range: true,
				min: 0,
				max: $('#upper').val(),
				values: [ 0, $('#upper').val() ],
			});
			$( ".price-value" ).text( "£0 - £"+$('#upper').val() );
			$('#lower').val(0);
			$('#upper').val($('#upper').val());
			dataTable.draw();
		});

	});
})(jQuery);