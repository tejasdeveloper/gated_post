jQuery(document).ready(function($){		
	function isEmail(email) {
	  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  return regex.test(email);
	}
	$('#gatedsubmit').click(function(event) {							  
		event.preventDefault();
		var useremail = $("input[name='gatedemail").val();
		if (!useremail) {
			alert("please enter your email");
			return false;
		}else if( !isEmail(useremail) ){
			alert("please enter valid email");
			return false;
		}
		
		
		jQuery.ajax({
			type: "post",
			dataType: "json",
			url: my_ajax_object.ajax_url,
			 data : {action: "get_gated_form", useremail: useremail},
			success: function(msg){
				console.log(msg);
			}
		});
	  
	  $(".gatedcontent").show();
	  $(".gatedpostform").hide();
	});
});
	