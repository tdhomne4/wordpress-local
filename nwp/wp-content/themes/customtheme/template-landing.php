<?php
/*
Template Name: Become a Vendor
*/
if(!empty($_POST['submit']) && isset($_POST['submit'])) {
    $company_name = $_POST['company_name'];
    $contact_name = $_POST['contact_name'];
    echo $company_name; echo $contact_name;
  unset($_POST['submit']);
}


?>
<style>
    .email-opt{
			color: #827d7d;
  			font-size: 12px;
		}		
	label.error {
	    color: red;
	    font-size: 1rem;
	    display: block;
	    margin-top: 5px;
	}
	.required:after {
	    content:" *";
	    color: red;
	}
</style>
	<h2>Landing Page</h2>
    <div class='custom-form'>
        <form id="landing-form" action="<?php the_permalink();?>" method="post" >
            <label for="name">Name:</label><br>
  			<input type="text" id="name" name="contact_name" aria-required="true" aria-invalid="false"  value="" placeholder="Enter name.."><br>


                            <input type="text" name="company_name" value="" size="40" id="company_name" aria-required="true" aria-invalid="false" placeholder="Company Name">
                       
                        <input type="submit" name="submit" value="Submit" ><span class="wpcf7-spinner"></span>
              
        </form>
    </div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script>
$(document).ready(function() {
  $("#landing-form").validate({
    errorClass: "error fail-alert",
    validClass: "valid success-alert",
    rules: {
      	contact_name : {
        	required: true
        },
      	
      	whats_number: {
	        required: true,
	        number: true,
	        min: 0
        }
      },
    messages : {
      contact_name: {
        required: "Please enter your name"
      },
      whats_number: {
        required: "Please enter your whatsapp numer",
        number: "Please enteryour whatsapp numer as a numerical value",
      }
    }
  });
});

</script>