jQuery(document).ready( function(){         
    jQuery('#content').click('a.rml_bttn', function(e) { 
        e.preventDefault();
        var rml_post_id = jQuery(this).attr("data-id");
      
        jQuery.ajax({
            url : 'http://localhost/nwp/wp-admin/admin-ajax.php',
            type : 'post',
            data : {
                action : 'read_me_later',
                post_id : rml_post_id
            },
           success : function( response ) {
                jQuery('.rml_contents').html(response);
            }
        });
       // jQuery(this).hide();            
    });     
});

