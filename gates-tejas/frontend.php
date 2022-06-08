<?PHP 
	add_filter( 'the_content', "gated_post_hide" );
	function gated_post_hide($content){
		global $post;
		
		
			
		$postID 	= $post->ID;
		$is_gated	= get_post_meta( $postID, 'is_gated', true );
		
		if($is_gated=='yes'){
			ob_start();?>
		
				<div class="gatedpostform">
					<div class="formheader">
						<h4>To view this content please enter your email</h4>                    
					</div>
					<div class="gatedemailform">
						<input type="email" placeholder="Enter Email" name="gatedemail" id="gatedemail" />
						<input type="button" name="gatedsubmit" id="gatedsubmit" value="Submit"  />
					</div>
				</div>
				<div class="gatedcontent">
					<?PHP echo $content; ?>
				</div>
			
		<?PHP	
			$return_content = ob_get_clean();
			return $return_content;//"IDDD->".$postID.$content;	
		}
		else{
			return $content;
		}
			
			
		
		
	}
	
	add_action( 'wp_ajax_get_gated_form', 'get_gated_form' );    // If called from admin panel
	add_action( 'wp_ajax_nopriv_get_gated_form', 'get_gated_form' );
	function get_gated_form(){
	
		$useremail = $_POST["useremail"];	
		$plugin_dir = WP_PLUGIN_DIR . '/gates-tejas';
		$content = $useremail.PHP_EOL;
		$fp = fopen($plugin_dir. "/useremails.txt","a");
		fwrite($fp,$content);
		fclose($fp);
	}

	
 ?>