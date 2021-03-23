<?php
	include "dbConn.php";
	$email = $password = $message = $emailError = $passwordError = $cpasswordError = $collegeError = $confirmed_password = "";

	if( isset($_POST['login']) ){
		function validateFormData($formData){
			$formData = trim( stripslashes( htmlspecialchars( $formData ) ) );
			return $formData;
		}

		if( !$_POST['fname'] ){
			$passwordError = "<div class='error-alert'><p>Please enter First Name</p></div>";
		}else{
			$fname = validateFormData( $_POST['fname'] );
		}

    if( !$_POST['lname'] ){
			$passwordError = "<div class='error-alert'><p>Please enter Last Name</p></div>";
		}else{
			$lname = validateFormData( $_POST['lname'] );
		}

		if( !$_POST['email'] ){
			$emailError = "<div class='error-alert'><p>Please enter email</p></div>";
		}else{
			$emailData = validateFormData( $_POST['email'] );
			if( !filter_var($emailData, FILTER_VALIDATE_EMAIL) ){
				$emailError = "<div class='error-alert'><p>Please enter valid email</p></div>";
			}

			$query = "SELECT email FROM user WHERE email='$emailData'";
			$result = $conn->query($query);

			if( $result -> num_rows > 0){
				$emailError = "<div class='error-alert'><p>Email already exist</p></div>";
			}else{
				$email = $emailData;
			}	
		}

		$passwordData = validateFormData( $_POST['password'] );
		//ctype_alnum($passwordData) && strlen($passwordData)>=8 && preg_match('/a-z/', $passwordData) && preg_match('/A-Z/',$passwordData) && preg_match('/0-9/', $passwordData)
		if( !$_POST['password'] ){
			$passwordError = "<div class='error-alert'><p>Please enter password</p></div>";
		}else{
			if( !(preg_match("#[a-z]+#", $passwordData) && preg_match("#[0-9]+#", $passwordData) && strlen($passwordData) >= 8 ) ){
				$passwordError = "<div class='error-alert'><p>Password must contain atleast 8 character and combination of characters and numbers</p></div>";
			}else{
				$password = password_hash( $passwordData, PASSWORD_DEFAULT );
			}
		}

		if( !$_POST['cpassword'] ){
			$cpasswordError = "<div class='error-alert'><p>Please retype password</p></div>";
		}else{
			$confirmed_password = validateFormData( $_POST['cpassword'] );
			if( $confirmed_password != ( $password || $passwordData) ){
				$cpasswordError = "<div class='error-alert'><p>Password do not match.Please type carefully</p></div>";
			}
		}

		if( $email && $password ){
			$query = "INSERT INTO user(fname, lname, email, password) VALUES('$fname','$lname', '$email', '$password');";
			$result = $conn->query($query);
			if( $result ){
				$message = "<div class='error-alert'><p>You successfully logged in. Check your profile. And do participate in Games</p></div>";
				session_start();
				$_SESSION['userData'] = $message;
				$_SESSION['loggedInEmail'] = $email;
				header( "Location: .." );
			}else{
				echo "Error: ". $query ." ". $conn -> error;
			}
		}

	}
?>

<!DOCTYPE html>
<html class="lg-html">
<head>
<title>Login Form</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel = "stylesheet" href = "../css/login.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" 
		integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" 
		crossorigin="anonymous">
</head>
<body>

	<div class="login">	
			<div class="fpart">
				<div id="image">
					<img src="https://socialmediaweek.org/wp-content/blogs.dir/1/files/brand-blog-feature.jpg">
				</div>
			</div>

			<div class="spart">
                <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">  
                    <h2>Create account</h2><br><br>
                    <div id="inputwithicons">
                        <i class="fas fa-signature" aria-hidden="true"></i><input type="text" id="fname" name="fname" placeholder="First Name" >
                    </div>
                    <br><br>
                    <div id="inputwithicons">
                        <i class="fas fa-signature" aria-hidden="true"></i><input type="text" id="lname" name="lname" placeholder="Last Name" >
                    </div>
                    <br><br>
                    <div id="inputwithicons">
                        <i class="fa fa-envelope" aria-hidden="true"></i><input type="email" id="email" name="email" placeholder="youremail@email.com" >
                    </div>
                    <br><br>
                    <div id="inputwithicons">
                        <i class="fa fa-lock"></i><input type="password" id="password" name="password" placeholder="Password" >
					</div><br><br>
					<div id="inputwithicons">
                        <i class="fa fa-lock"></i><input type="password" id="cpassword" name="cpassword" placeholder="Confirm password" >
                    </div><br>
						
					<?php if($emailError ) { ?>
						<p><?php echo $emailError ?></p>
					<?php }else if($passwordError){ ?>
						<p><?php echo $passwordError ?></p>
					<?php }elseif($cpasswordError) {?>
						<p><?php echo $cpasswordError ?></p>
					<?php }else{?>
						<p><?php echo $message ?>
					<?php } ?>
              <button type="submit" name="login">Sign up</button>
          </form>
			</div>
	</div>
</body>
</html>
<?php // require_once('script.php'); ?>