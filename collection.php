<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/AuCo/";

require_once($path . 'connect.php');
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: sign-in.php");
    exit;
}

$ReadSql = " SELECT * FROM `autographs` WHERE user_id=$_SESSION[id] ";
$res = mysqli_query($connection, $ReadSql);
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
                <form class="balance-form" action="update_balance.php" method="GET">
                    <input type="number" placeholder="Amount" name="amount" min="10" max="10000" step="5"
                        class="user-input" required>
                    <button type="submit" class="tu-btn">Add</button>
                </form>
            </div>
        </div>
        <a class="sign-out-btn" href="sign-in.php">Sign Out</a>
    </header>


    <main class="main-wrapper">
        <section class="main-template">
            <div class="my-body">
                <h1 style="color:#27a29e;font-family: 'Open Sans' ;font-weight: bold;text-align:center;">Hello,
                <b><?php 
			    echo $_SESSION['username'];
        	    ?></b> 	! This is your autograph collection</h1>
                <div class="search">
                    <input type="text" class="searchTerm"
                        placeholder="What are you looking for? Please enter a hey word...">
                    <button type="submit" class="searchButton">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <div class="collections">
                    <?php while($r = mysqli_fetch_assoc($res)){
                    ?>
                    <button><a href="autograph.php?param=<?php echo $r['a_id']; ?>"><?php echo $r['name']; ?></a></button>
                    <br>
                    <?php } ?>
                    <br><br>
                    <button style=" width:20%; padding:10px;"><a href="upload_autograph.php" style="color:white">Add
                            new autograph</a></button>
                </div>
            </div>
        </section>
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