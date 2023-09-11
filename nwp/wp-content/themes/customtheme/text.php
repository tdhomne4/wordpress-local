<?php
/**
 * Template used for Custom data file upload
 * that don't have a specific template.
 * Template Name: HCPC File Generate
 * @package Avada
 * @subpackage Templates
 */
get_header();
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}



 
 if(isset($_POST['submit'])){
 //This is not a good file upload code sample. You have to improve it.
   $image=$_FILES["hcpc_file"]["tmp_name"];
   print_r(__DIR__.'/uploads'); 
   $imageName = $_FILES["hcpc_file"]["name"];
   move_uploaded_file($image,__DIR__.'/uploads'.$imageName );

	error_reporting(E_ALL);

	$pagename = 'my_page1';

	$newFileName = __DIR__.'/uploads/'.$pagename.".php";
	$newFileContent = '<?php echo "something..."; ?>';

	if (file_put_contents($newFileName, $newFileContent) !== false) {
	    echo "File created (" . basename($newFileName) . ")";
	} else {
	    echo "Cannot create file (" . basename($newFileName) . ")";
	}
}

?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<style>
.form-control {
    width: 38%;
}
	</style>
	<div class="container">
		<form  action="" method="post" enctype="multipart/form-data">
			<div class="mb-3">
			  <label for="formFile" class="form-label">Upload hcpc default format file</label>
			  <input class="form-control" type="file" name="hcpc_file" id="formFile"><br>
			  <input type="submit" name="submit" class="btn btn-success" value="Upload File">
			</div>
		</form>

</div>
<br />
<br />
<br />
<br />
<h2>***********************************************************************************************</h2>
<button class='click_me'>click me</button>

<script type="text/javascript">
	jQuery(document).ready(function() {
		let clickCount = 0;
		
		jQuery('.click_me').click(function(){
			console.log('clicked');
			 clickCount++;

	       	if (clickCount === 3) {
	       		console.log('clicked 3 times');
	       	} else if (clickCount === 4) {
	       		var data = 'payment done';
	       		console.log('clicked 4 times');
				jQuery.ajax
				({
					url : 'http://localhost/nwp/wp-admin/admin-ajax.php',
					type :'post',
					data : { data : data,action: "click_payment_status"},
					success: function(data)
					{
						console.log(data);
					}
				}); //ajax close
	       	}
	    });  
	    console.log(clickCount);
    });


</script>

<?php get_footer();