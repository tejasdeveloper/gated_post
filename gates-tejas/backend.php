<?PHP 
	add_action( 'add_meta_boxes', 'add_featured_checkbox_function' );

	function add_featured_checkbox_function() {
	   add_meta_box('featured_checkbox_id','Gated post', 'featured_checkbox_callback_function', 'post', 'normal', 'high');
	}
	
	function featured_checkbox_callback_function( $post ) {
	   global $post;
	   $is_gated	= get_post_meta( $post->ID, 'is_gated', true );
	?>
	   
	   <input type="checkbox" id="gatedcheck" name="is_gated" value="yes" <?php echo (($is_gated=='yes') ? 'checked="checked"': '');?>/> 
	   <label for="gatedcheck">YES</label>
	<?php
	}

	add_action('save_post', 'save_featured_post'); 
	function save_featured_post($post_id){ 
	   if(isset($_POST['is_gated'])){
	   	$is_gated = $_POST['is_gated'];
	  	 update_post_meta( $post_id, 'is_gated', $is_gated);
	   
	   }
	}

	
 ?>