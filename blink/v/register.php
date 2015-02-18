<h3 class="center">Sign up</h3>
<div class="divider"  id="register-divider"><img src="images/divider.png" class="img-responsive" /></div>
<div class="form-content">
    <form method="post" id="register-form">
        <input type="name" class="form-control" id="fldFirstName" name="fldFirstName" placeholder="First Name">
        <input type="name" class="form-control" id="fldLastName" name="fldLastName" placeholder="Last Name">
        <input type="email" class="form-control" id="pkEmail" name="pkEmail" placeholder="Email">
        <input type="password" class="form-control" id="fldPassword" name="fldPassword" placeholder="Password">
        <input type="password" class="form-control" id="fldPasswordCheck" name="fldPasswordCheck" placeholder="Re-enter Password">
        <div class="styled-select">
            <select name="fldSecurityQuestion1" id="fldSecurityQuestion1" class="form-control">
                <option value=""></option>
                <option value="1">What city were you born in?</option>
                <option value="2">What was the name of your first pet?</option>
                <option value="3">What is your favorite color?</option>
            </select> 
        </div>
        <input class="form-control" id="fldSecurityAnswer1" name="fldSecurityAnswer1" placeholder="Answer">
        <div class="styled-select">
            <select name="fldSecurityQuestion2" id="fldSecurityQuestion2" class="form-control">
                <option value=""></option>
                <option value="4">What is your favorite sports team?</option>
                <option value="5">What is your mothers maiden name?</option>
                <option value="6">Who is your favorite actor/actress?</option>
            </select> 
        </div>
        <input class="form-control" id="fldSecurityAnswer2" name="fldSecurityAnswer2" placeholder="Answer">
        <input class="form-control" id="fldPin" name="fldPin" placeholder="Bracelet Pin">
        <?php /*<div id="errors">
            <label class="error" for="fldFirstName" generated="true"></label>
            <label class="error" for="fldLastName" generated="true"></label>
            <label class="error" for="pkEmail" generated="true"></label>
            <label class="error" for="fldPassword" generated="true"></label>
            <label class="error" for="fldPasswordCheck" generated="true"></label>
            <label class="error" for="fldSecurityQuestion1" generated="true"></label>
            <label class="error" for="fldSecurityQuestion2" generated="true"></label>
            <label class="error" for="fldSecurityAnswer1" generated="true"></label>
            <label class="error" for="fldSecurityAnswer2" generated="true"></label>
            <label class="error" for="fldPin" generated="true"></label>
        </div> */ ?>
        <a class="btn btn-default" id="submit-btn">Submit</a>
    </form>
</div>
<script>
$(document).ready(function() {
	//$('.selectpicker').selectpicker();
	// validate the comment form when it is submitted
	//$("#commentForm").validate();
	$('#submit-btn').on('mousedown', function(){
    	if($('#register-form').valid()) {
			var data = $('#register-form').serializeArray();
			//var dataString = new Array();
			var dataString = {};
			$.each(data, function(i, field) {
				if(field.name != "fldPasswordCheck")
				dataString[field.name] = field.value;
			});
			
			var dataEncoded = JSON.stringify(dataString);
			//$.each()
			$.ajax({  
			  type: "POST",  
			  url: "/~cdavenp1/blink/api/user",
			  contentType: "application/json",  
			  data: dataEncoded,  
			  success: function() {  
				$('div#register-overlay-content').children().fadeOut();
				$('div#register-overlay-content').append('<h4 class="center">Thank you for registering!</h4>').fadeIn();
			  },
			  error: function() {
				$('div#register-overlay-content').children().fadeOut();
				$('div#register-overlay-content').append('<h4 class="center">Something went wrong. Try registering again.</h4>').fadeIn();
			  }
			});  
			return false; 
		}
	});
	// validate signup form on keyup and submit
	$("#register-form").validate({
		rules: {
			fldFirstName: {
				required: true,
				minlength: 2
			},
			fldLastName: {
				required: true,
				minlength: 2
			},
			pkEmail: {
				required: true,
				email: true
			},
			fldPassword: {
				required: true,
				minlength: 5
			},
			fldPasswordCheck: {
				required: true,
				minlength: 5,
      			equalTo: "#fldPassword"
			},
			fldPin: {
				required: true,
				minlength: 4,
				maxlength: 4
			},
			fldSecurityQuestion1: {
				required: true
			},
			fldSecurityQuestion2: {
				required: true
			},
			fldSecurityAnswer1: {
				required: true,
				minlength: 3
			},
			fldSecurityAnswer2: {
				required: true,
				minlength: 3
			}
		},
		errorPlacement: function(error,element) {
    		return true;
  		}/*,
		messages: {
			fldFirstName: "Please enter your firstname",
			fldLastName: "Please enter your lastname",
			pkEmail: "Please enter a valid email address",
			fldPassword: "Please enter a valid password",
			fldPasswordCheck: "Please re-enter a valid password",
			fldSecurityQuestion1: "Please choose security question #1",
			fldSecurityQuestion2: "Please choose security question #2",
			fldSecurityAnswer1: "Please enter an answer to question #1",
			fldSecurityAnswer2: "Please enter an answer to question #2",
			fldPin: "Please enter a valid pin"
		}*/
	});
	
});
</script>
