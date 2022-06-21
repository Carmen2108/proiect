<?php
// Initialize the session
session_start();

// Include config file
require_once "connect.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($connection, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username; 
                            $_SESSION["balance"] = 0;                        
                            
                            // Redirect user to welcome page
                            header("location: home.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($connection);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>AuCo - Sign In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/style.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100&display=swap" rel="stylesheet">
</head>

    <body>
        <header>
            <a class="nav-bar-item" href="sign-up.php"> Sign Up </a>
            <div class="title"> AutographCollector </div>
            <a class="nav-bar-item" href="scholarly.php"> About </a>
        </header>



    <main class="main-login-wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login-wrapper">
            <div class="form-type">
                Sign In
            </div>
            <?php 
                if(!empty($login_err)){
                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                }        
            ?>
            <div class="form-wrapper">
                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Username" name="username" class="user-input <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>

                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Password" name="password" class="user-input <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>

                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
            
                <button type="submit" class="su-btn">Sign In</button>
            </div>
        </form>
    </main>

    <footer>
        <div class="payments">
            <p>Payment Options:</p>
            <div class="payment-types">
                <a href="https://www.mastercard.com"><i class="fa fa-cc-mastercard fa-2x"></i></a>
                <a href="https://www.visa.com"><i class="fa fa-cc-visa fa-2x"></i></a>
                <a href="https://www.paypal.com"><i class="fa fa-cc-paypal fa-2x"></i></a>
            </div>
        </div>
        <div class="authors"> Bejenariu Razvan-Andrei & Gruia Carmen</div>

        <div class="social-media">
            <a href="https://www.facebook.com"> <i class="fa fa-facebook fa-2x"></i></a>
            <a href="https://www.instagram.com"> <i class="fa fa-instagram fa-2x"></i></a>
            <a href="https://www.twitter.com"> <i class="fa fa-twitter fa-2x"></i></a>
            <a href="https://www.linkedin.com"> <i class="fa fa-linkedin fa-2x"></i></a>
        </div>
        </footer>
    </body>
</html>