
<!DOCTYPE HTML>
<html>
<head>
<title>Planet Hosting a Hosting Category Flat Bootstrap Responsive Website Template | Account :: w3layouts</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Planet Hosting Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="account.js"></script>
<script src="js/bootstrap.js"></script>
<!---fonts-->
<link href='//fonts.googleapis.com/css?family=Voltaire' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!---fonts-->
<!--script-->
<link rel="stylesheet" href="css/swipebox.css">
			<script src="js/jquery.swipebox.min.js"></script> 
			    <script type="text/javascript">
					jQuery(function($) {
						$(".swipebox").swipebox();
					});
				</script>
<!--script-->
</head>
<body>
	<!---header--->
	<?php include 'header.php';?>
	<!---header--->
		<!---login--->
			<div class="content">
				<!-- registration -->
	<div class="main-1">
		<div class="container">
			<div class="register">
		  	  <form name="signupform" action="#"> 
				 <div class="register-top-grid">
					<h3>personal information</h3>
					 <div>
						<span>Email<label>*</label></span>
						<input  type="email" id="email"  placeholder="someone@gmail.com" required> 
					 </div>
					 <div>
						<span>Name<label>*</label></span>
						<input type="text" id="name" onkeypress="return alphaonly(event)" required> 
					 </div>
					 <div>
						 <span>Mobile<label>*</label></span>
						 <input type="number" onkeypress="return onlynum(event)" pattern="\d{2}" required style="width:524px;height:36px;border:1px solid black; "> 
					 </div>
					 <div>
					 	 <span>Security Question<label>*</label></span>
						<select style="width:524px;height:36px;background:transparent;border:1px solid black; " required>
						    <option>-Select a security question</option>
							<option value="nickname">-What was your childhood nickname?</option>
							<option value="friend">-What is the name of your favourite childhood friend?</option>
							<option value="place">-What was your favourite place to visit as a child?</option>
							<option value="job">-What was your dream job as a child?</option>
							<option value="teacher">-What is your favourite teacher's nickname?</option>
						</select>
					 </div>
					 <div>
						 <span>Security Answer<label>*</label></span>
						 <input type="text" required> 
					 </div>
					 <div class="clearfix"> </div>
					   <a class="news-letter" href="#">
						 <label class="checkbox"><input type="checkbox" name="checkbox" ><i> </i>Sign Up for Newsletter</label>
					   </a>
					 </div>
				     <div class="register-bottom-grid">
						    <h3>login information</h3>
							 <div>
								<span>Password<label>*</label></span>
								<input type="password" minlength="8" maxlength="16" onkeypress="return pass(event)" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$" title="1 UPPERCASE 1lowercase 1 special character " required>
							 </div>
							 <div>
								<span>Confirm Password<label>*</label></span>
								<input type="password"  minlength="8" maxlength="16" onkeypress="return pass(event)" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$" required>
							 </div>
					 </div>
					 <input type="submit" value="submit" id="sign">
				</form>
				<div class="clearfix"> </div>
				<div class="register-but">
				   <form>
					   
					   <div class="clearfix"> </div>
				   </form>
				</div>
		   </div>
		 </div>
	</div>
<!-- registration -->

			</div>
<!-- login -->
				<!---footer--->
			<?php include 'footer.php';?>
			<!---footer--->
<script type="text/javascript">
	var count=0; 
	function alphaonly(button) {
  	// console.log(button.which);
        var code = button.which;
        if(count>0 && code==32){
        	var code = button.which;
        	count=0;
        	return true;
        }
        if ((code > 64 && code < 91) || (code < 123 && code > 96)|| (code==08)){
        	count++;
            return true; 
        }
            
        else{
        	return false;
        	} 
    	}

    
    var em=1;
    $("#email").bind("keypress", function (e) {
	
    var keyCode = e.which ? e.which : e.keyCode
    if(em=0 && keycode==190){
    	em=1;
    	return false;
    }
    if (!(keyCode==46) && !(keyCode >= 48 && keyCode <= 57) && !(keyCode >= 64 && keyCode <= 90) && !(keyCode >= 97 && keyCode <= 122)) {
        //console.log(keycode);
        em--;
        alert("Invalid email format please match the format");
        return false;
    }
}); 
    function onlynum(button){
    var code = button.which;
    if (code > 31 && (code < 48 || code > 57)) 
        return false; 
    return true;
    
}
 function pass(button){
 	var code = button.which;
 	if(code==32){
 		return false;
 	}
 	else{
 		return true;
 	}
 }
</script>			
</body>
</html>