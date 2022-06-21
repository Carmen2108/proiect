<?php
require_once "connect.php";

$username = $password = "";
$username_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    
    if(empty(trim($_POST["username"]))){
        $username_err = " ";
    } else{
        
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($connection, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            
            $param_username = trim($_POST["username"]);
            
            
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = " ";
                } else{
                    $username = trim($_POST["username"]);
                }
            } 

            
            mysqli_stmt_close($stmt);
        }
    }
    
    
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } else{
        $password = trim($_POST["password"]);
    }

    
    if(empty($username_err) && empty($password_err)){
        
        
        $sql = "INSERT INTO users (username, password) VALUES (?,  ?)";
        $stmt = mysqli_prepare($connection, $sql);
        if($stmt){
            
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            
            if(mysqli_stmt_execute($stmt)){
                header("location: sign-in.php");
            }
            
            mysqli_stmt_close($stmt);
        }
    }
    
    
    mysqli_close($connection);
}
?>
 
 <!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>AuCo - Sign Up</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles/style.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100&display=swap" rel="stylesheet">
    </head>

    <body>
        <header>
            <a class="nav-bar-item" href="sign-in.php"> Sign In </a>
            <div class="title"> AutographCollector </div>
            <a class="nav-bar-item" href="scholarly.php"> About </a>
        </header>


    <main class="main-login-wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="signup-wrapper">
            <div class="form-type">
                Sign Up
            </div>
            <div class="form-wrapper">
                <label for="username"><b>Username</b></label>
                <input type="text" name="username" placeholder="" class="user-input <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>

                <label for="password"><b>Password</b></label>
                <input type="password" name="password" placeholder="" autocomplete="off" class="user-input <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>


                <button type="submit" class="su-btn" value="Submit">Sign Up</button>
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