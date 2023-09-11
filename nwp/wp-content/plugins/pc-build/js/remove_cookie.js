(function( $ ) {
	$(function() {

		$(".email_btn").off('click').on('click',function(){
			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			var emailVal = $('.email_field').val();
			if(!regex.test(emailVal) || emailVal == ''){
				$('.error-msg').show();
			}else{
				var mailTable = $('#tableId').prop('outerHTML');

				$.ajax({
					type: 'POST',
					url: mail_js,
					data: {
						'mail_table' : mailTable,
						'mail_email' : emailVal,
					},
					success: function(result){
						if(result == 'send'){
							$('.error-msg').show();
							$('.msg').html('Mail sent');
						}else{
							$('.error-msg').show();
							$('.msg').html('Some error occured');
						}
						setTimeout(function() {
							$("#myModal").hide();
							$('.error-msg').hide();
							$('.msg').html('Email is not valid or empty.');
						}, 3000);
					}
				});
			}
		});

		$(mailTableFunction);
		function mailTableFunction() {
			var trHTML = '';
			var amazonLink = '';
			var totalPrice = 0;
			$('#mailTable').empty();
			amazonLink += 'https://www.amazon.com/gp/aws/cart/add.html?AWSAccessKeyId=AKIAJUT4WYDA23J2KOUA&AssociateTag=sunnyhova-20&';
			trHTML += '<table id ="tableId" border="1"> <tbody><tr><th>Component</th><th>Image</th><th>Title</th><th>Rating</th><th>Quantity</th><th>Price</th></tr>';
			var i = 1;
			$("table.table-list-sec tr").each(function(){
				var currentRow=$(this);
				var component = currentRow.find("td:eq(0)").text();
				var img_url = currentRow.find("td:eq(2)").find('img').attr('src');
				var title = currentRow.find("td:eq(3)").text();
				var rating = currentRow.find("td:eq(4)").text();
				var price = currentRow.find("td:eq(5)").text();
				var quantity = currentRow.find("td:eq(6)").find('.quantity_val').val();
				var asin = currentRow.find("td:eq(6)").find('.asin_val').val();
				if(rating != ''){
					$('.btn-group-sec').css('display','flex');
					var priceValue = price.replace('$', '');
					totalPrice += Number(priceValue)*Number(quantity);
					trHTML += '<tr><td>'+component+'</td><td><img src='+img_url+'></td><td>'+title+'</td><td>'+rating+'</td><td>'+quantity+'</td><td>'+price+'</td></tr>';
					amazonLink += 'ASIN.'+i+'='+asin+'&Quantity.'+i+'='+quantity+'&';
					i++;
				}
			});
			amazonLink += 'add=Buy+From+Amazon';
			trHTML += '<tr class="tr__total tr__total--final"><td></td><td></td><td></td><td></td><td class="td__label">Total:</td><td class="td_total_price">$'+totalPrice.toFixed(2)+'</td></tr>';
			trHTML += '<tr><td colspan="6" style="text-align:right;"><a href='+amazonLink+' style="text-decoration: none; font-weight:800; color: black;">Buy From Amazon</a></td></tr>';
			trHTML += '</table>';
			$('#mailTable').html(trHTML);
		}

		$(document).on("click","#btnCopy",function(e) {
			e.preventDefault();
			$(this).prev('.action-tooltiptext').html('Copied');
			copyToClipboard(document.getElementById("mailTable"));
		});

		$(document).on("mouseover","#btnCopy",function(e) {
			$(this).prev('.action-tooltiptext').html('Copy Html Markup!');
		});

		$(document).on("mouseover","#cpybtn",function(e) {
			$(this).prev('.action-tooltiptext').html('Copy Text Markup!');
		});

		$(document).on("click","#cpybtn",function(e) {
			e.preventDefault();
			$('#mailTable').show();
			$(this).prev('.action-tooltiptext').html('Copied');
			selectElementContents( document.getElementById('tableId') );
		});

		function selectElementContents(el) {
			var body = document.body, range, sel;
			if (document.createRange && window.getSelection) {
				range = document.createRange();
				sel = window.getSelection();
				sel.removeAllRanges();
				try {
					range.selectNodeContents(el);
					sel.addRange(range);
				} catch (e) {
					range.selectNode(el);
					sel.addRange(range);
				}
				document.execCommand("copy");
			} else if (body.createTextRange) {
				range = body.createTextRange();
				range.moveToElementText(el);
				range.select();
				range.execCommand("Copy");
			}
			setTimeout(function() {document.getElementById('mailTable').style.display = 'none';}, 500);
		}
 
		function copyToClipboard(elem) {
			var targetId = "_hiddenCopyText_";
			var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
			var origSelectionStart, origSelectionEnd;
			if (isInput) {
				target = elem;
				origSelectionStart = elem.selectionStart;
				origSelectionEnd = elem.selectionEnd;
			} else {
				target = document.getElementById(targetId);
				if (!target) {
					var target = document.createElement("textarea");
					target.style.position = "absolute";
					target.style.left = "-9999px";
					target.style.top = "0";
					target.id = targetId;
					document.body.appendChild(target);
				}
				target.textContent = elem.innerHTML;
			}
			var currentFocus = document.activeElement;
			target.focus();
			target.setSelectionRange(0, target.value.length);
			var succeed;
			try {
				succeed = document.execCommand("copy");
			} catch (e) {
				succeed = false;
			}
			if (currentFocus && typeof currentFocus.focus === "function") {
				currentFocus.focus();
			}
 
            if (isInput) {
                elem.setSelectionRange(origSelectionStart, origSelectionEnd);
            } else {
                target.textContent = "";
            }
            return succeed;
        }

		var total = 0;
		$('.price_val').each(function(i, obj) {
			var totalValue = obj.innerText.replace('$', '');
			var quantValue = $(this).closest('td').next('td').find('.quantity_val').val();
			if(totalValue != 0){
				total += Number(totalValue)*Number(quantValue);
				$('.td_total_price').text('$'+total.toFixed(2));
			}
		});

		$(document).on("click",".remove-button",function(e) {
			e.preventDefault();
			var remove_key = $(this).data("remove-key");
			var remove_id = $(this).data("remove-id");

			$.ajax({
				type: 'POST',
				// dataType: 'json',
				url: remove_cookie_js,
				data: {
					'remove_key' : remove_key,
					'remove_id' : remove_id,
				},
				success: function(result){
					location.reload(true);
				},
			});
		});

		$(document).on("click","#mail_btn",function(e) {
			e.preventDefault();
			$("#myModal").show();
		});

		$(document).on("click",".social-link",function(e) {
			e.preventDefault();
			var href = $(this).attr('href');
			var weburl = window.location.href; 
			var shareUrl = href + weburl;
			window.open(shareUrl, '_blank');
		});

		$(document).on("click","#mail_btn",function(e) {
			e.preventDefault();
			$("#myModal").show();
		});

		// When the user clicks on <span> (x), close the modal
		$(document).on("click",".close",function(e) {
			$("#myModal").hide();
		});

		$(document).on("change",".quantity_val",function(e) {
			var hrefLink = $(this).closest('td').next('td').find('a.amazon-link').data("href");
			var newLink = hrefLink.slice(0, -9);
			var newUrl = newLink+parseInt($(this).val())+"&add=add";
			$(this).closest('td').next('td').find('a.amazon-link').attr("href", newUrl);
			var total = 0;
			$('.price_val').each(function(i, obj) {
				var totalValue = obj.innerText.replace('$', '');
				var quantValue = $(this).closest('td').next('td').find('.quantity_val').val();
				if(totalValue != 0){
					total += Number(totalValue)*Number(quantValue);
					$('.td_total_price').text('$'+total.toFixed(2));
				}
			});

			$(mailTableFunction);
		});

	});
})(jQuery);