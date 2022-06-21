<?php
// Initialize the session
session_start();

// Include config file
require_once "connect.php";
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: sign-in.php");
    exit;
}

// Define variables and initialize with empty values
$name = $domain = $provenance = $location = $object = $mentions = $worth = $image = "";
$name_err = $domain_err = $provenance_err = $location_err = $object_err = $mentions_err = $worth_err = $image_err ="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if name is empty
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter author's name.";
    } else{
        $name = trim($_POST["name"]);
    }
    
    // Check if domain is empty
    if(empty(trim($_POST["domain"]))){
        $domain_err = "Please enter the domain.";
    } else{
        $domain = trim($_POST["domain"]);
    }

    // Check if provenance is empty
    if(empty(trim($_POST["provenance"]))){
        $provenance_err = "Please enter the provenance.";
    } else{
        $provenance = trim($_POST["provenance"]);
    }

    // Check if location is empty
    if(empty(trim($_POST["location"]))){
        $location_err = "Please enter the location.";
    } else{
        $location = trim($_POST["location"]);
    }
    
    // Check if object is empty
    if(empty(trim($_POST["object"]))){
        $object_err = "Please enter the object.";
    } else{
        $object = trim($_POST["object"]);
    }
    
    // Check if worth is empty
    if(empty(trim($_POST["worth"]))){
        $worth_err = "Please enter the worth.";
    } else{
        $worth = trim($_POST["worth"]);
    }

    // Check if image is empty
    if(empty(trim($_POST["image"]))){
        $image_err = "Please enter the worth.";
    } else{
        $image = trim($_POST["image"]);
    }

    // Validate credentials
    if(empty($name_err) && empty($domain_err) && empty($provenance_err) && empty($location_err) && empty($object_err) && empty($worth_err) ){
        $sql = "INSERT INTO autographs (name,domain,provenance,location,object,mentions,worth,user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $sql);
        if($stmt){
            mysqli_stmt_bind_param($stmt, "sssssssi", $param_name, $param_domain, $param_provenance, $param_location, $param_object, $param_mentions, $param_worth, $param_user);
            
            $param_name = $name;    
            $param_domain = $domain; 
            $param_provenance = $provenance; 
            $param_location = $location; 
            $param_object = $object; 
            $param_mentions = $mentions; 
            $param_worth = $worth;   
            $param_user = $_SESSION['id'];                         
                
            if(mysqli_stmt_execute($stmt)){
                header("location: collection.php");
                    
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
    <title>AuCo - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/style.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <a class="nav-bar-item" href="home.php"> Home </a>
        <a class="nav-bar-item" href="leaderboards.php?param=all"> Leaderboards </a>
        <a class="nav-bar-item" href="collection.php"> My Collection </a>
        <div class="title"> AutographCollector </div>
        <div class="user">
            <a href="collection.php"> 
            <b><?php 
			    echo $_SESSION['username'];
        	?></b> 	
            </a>
            <div class="balance">
                <p id="value">balance:<?php 
			    echo $_SESSION['balance'];
        	    ?> $</p>
                <button id="toggleBtn"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></button>
                <form class="balance-form" action="" method="POST">
                    <input type="number" placeholder="Amount" name="amount" min="10" max="10000" step="5"
                        class="user-input" required>
                    <button type="submit" class="tu-btn">Add</button>
                </form>
            </div>
        </div>
        <a class="sign-out-btn" href="sign-in.php">Sign Out</a>
    </header>


    <main class="main-wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="main-template">
            <div class="my-body">
                <h1 style="color:#27a29e;font-family: 'Open Sans' ;font-weight: bold;text-align:center;">X'Autograph
                </h1>
                <br><br>
                <div class="autograph-informations">
                    <p style="margin-top:30%">Autograph's author:</p>
                    <input type="text" placeholder="" name="name" class="user-input <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                    <span class="invalid-feedback" style="color:white"><?php echo $name_err; ?></span><br><br>
                    <p>Domain:</p>
                    <input type="text" placeholder="" name="domain" class="user-input <?php echo (!empty($domain_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $domain; ?>">
                    <span class="invalid-feedback" style="color:white"><?php echo $domain_err; ?></span><br><br>
                    <p>How you got it:</p>
                    <input type="text" placeholder="" name="provenance" class="user-input <?php echo (!empty($provenance_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $provenance; ?>">
                    <span class="invalid-feedback" style="color:white"><?php echo $provenance_err; ?></span><br><br>
                    <p>Location:</p>
                    <input type="text" placeholder="" name="location" class="user-input <?php echo (!empty($location_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $location; ?>">
                    <span class="invalid-feedback" style="color:white"><?php echo $location_err; ?></span><br><br>
                    <p>The signed object:</p>
                    <input type="text" placeholder="" name="object" class="user-input <?php echo (!empty($object_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $object; ?>">
                    <span class="invalid-feedback" style="color:white"><?php echo $object_err; ?></span><br><br>
                    <p>Special mentions:</p>
                    <input type="text" placeholder="" name="mentions" class="user-input <?php echo (!empty($mentions_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $mentions; ?>">
                    <span class="invalid-feedback" style="color:white"><?php echo $mentions_err; ?></span><br><br>
                    <p>How much is it worth?</p>
                    <input type="number" placeholder="" name="worth" class="user-input <?php echo (!empty($worth_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $worth; ?>">
                    <span class="invalid-feedback" style="color:white"><?php echo $worth_err; ?></span><br><br>
                </div>  
                <br><br><br>
               
                <div class="wrapper">
                    <button>Upload</button>
                </div>
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
    <script src="js/main.js"></script>
</body>

</html>