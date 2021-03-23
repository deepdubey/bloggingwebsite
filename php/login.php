<?php

$loginError = $formEmail= $formPass = "";

if( isset( $_POST['login'] ) ) {
    
    // build a function to validate data
    function validateFormData( $formData ) {
        $formData = trim($formData);
        $formData = stripslashes($formData);
        $formData = htmlspecialchars($formData);
        return $formData;
    }
    
    // create variables
    // wrap the data with our function
    $formEmail = validateFormData( $_POST['email'] );
    $formPass = validateFormData( $_POST['password'] );
    
    // connect to database
    include('dbConn.php');
    
    // create SQL query
    $query = "SELECT email, password FROM user WHERE email='$formEmail'";
    
    // store the result
    $result = $conn -> query($query );
    
    // verify if result is returned
    if( $result -> num_rows > 0 ) {
        
        // store basic user data in variables
        while( $row = $result -> fetch_assoc() ) {
            $email      = $row['email'];
            $hashedPass = $row['password'];
        }
        
        // verify hashed password with the typed password
        if( password_verify( $formPass, $hashedPass ) ) {
            
            // correct login details!
            // start the session
            session_start();
            
            // store data in SESSION variables
            $_SESSION['loggedInEmail'] = $email;
            
            header("Location: ../");
        
        } else { // hashed password didn't verify
            
            // error message
            $loginError = "<div class='error-alert'><p>Wrong username / password combination. Try again.</p></div>";
            
        }
        
    } else { // there are no results in database
        
        $loginError = "<div class='error-alert'><p>No such user. Please Create Account.</p></div>";
        
    }
    
    // close the mysql connection
    $conn -> close();
    
}

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Author Login</title>
        <link rel="stylesheet" href="../css/login.css">
        <!-- <link rel="shortcut icon" href="../img/chessfree.png" type="image/x-icon"> -->
    </head>
    <body>
       <!-- <header>
            <?php //require_once('statusBar.php'); ?>
       </header> -->
    	<div class="login">
    	
    			<div class="fpart">
    				<div id="image">
    					<img src="https://socialmediaweek.org/wp-content/blogs.dir/1/files/brand-blog-feature.jpg">
    				</div>
    			</div>
    
    			<div class="spart">
                    <form action="<?php echo htmlspecialchars( $_SERVER['PHP_SELF'] ); ?>" method="post">  
                        <h2>Member Login</h2><br><br>
                        <div id="inputwithicons">
                            <i class="fa fa-envelope" aria-hidden="true"></i><input type="email" class="ip2" id="emailin" name="email" placeholder="Email" >
                        </div>
                        <br><br>
                        <div id="inputwithicons">
                            <i class="fa fa-lock"></i><input type="password" class="ip2" id="password" name="password" placeholder="Password" >
                        </div>
                           
                        <?php echo $loginError; ?>
                        <button type="submit" name="login">Login</button>
                    </form>
                    
                    <div class="create">
                        <h4>Not a member!</h4>
                        <a href="signup.php"><button type="button">Create Account</button></a>
                    </div>
    			</div>
    
    	</div>
    
    </body>
</html>