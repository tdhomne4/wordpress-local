<?php
$insert_msg = '';
if (!empty($_POST['search_keyword'])){
	$search_keyword = $_POST['search_keyword'];
	$term = term_exists($search_keyword, 'post_tag');
	if (empty($term)) {
		$term= wp_insert_term( $search_keyword, 'post_tag', $args = array() );
	}
	$args = array(
		'post_type'=> 'post',
		'orderby'    => 'ID',
		'post_status' => 'publish',
		'order'    => 'DESC',
		'posts_per_page' => -1,
		"s" => $search_keyword
	);
	$result = get_posts( $args );
	foreach ($result as $res){
		wp_set_object_terms($res->ID, $search_keyword, 'post_tag', true);
	}
	$insert_msg = 'Post Liinked Successfully';
}
?>
<style>
.alert {
  padding: 20px;
  background-color: #04AA6D;
  color: white;
  margin-top: 20px: 
}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>
<form method = 'post' action = '' >
	<?php
	if(!empty($insert_msg)){ ?>
		<div class="alert">
			<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
			<strong>Success!</strong> Tag Successfully Created
		</div>
	<?php }
	?>
	<h1>Tag Match Settings</h1>

	<table class = "vm_table">
		<tr>
			<!-- <th>Create And Link Tags</th> -->
			<td><input type = 'text' name = 'search_keyword' value = ''><input type = 'submit' class = 'button-primary' value = 'Create And Link Tags'></td>
		</tr>
	</table>

</form>