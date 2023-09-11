jQuery( document ).ready(function() {
	jQuery("#acf-field_64d1f30ad2710").change(function () {
	   console.log('test');
	   var address = jQuery(this).val();
	   console.log(address);
	   jQuery('.acf-admin-pmap').html('<iframe width="100%" height="385" frameborder="0" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q='+address+'&z=14&output=embed&amp;z=5"></iframe>');

	});
	function initAutocomplete() {
		autocomplete = new google.maps.places.Autocomplete(
			jQuery('#acf-field_64d1f30ad2710'),{types:['geocode']});
	}
});