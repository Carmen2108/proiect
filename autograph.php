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
$data1=$_GET['param']; 
$ReadSql = "SELECT * FROM `autographs` WHERE a_id=$data1";
$res = mysqli_query($connection, $ReadSql);

$ReadSql1 = "SELECT * FROM users JOIN autographs ON users.id=autographs.user_id WHERE a_id=$data1";
$res1 = mysqli_query($connection, $ReadSql1);

$ReadSql2 = "SELECT * FROM `autographs` WHERE a_id=$data1";
$res2 = mysqli_query($connection, $ReadSql2);

$ReadSql3 = "SELECT * FROM `autographs` WHERE a_id=$data1";
$res3 = mysqli_query($connection, $ReadSql3);

$ReadSql4 = "SELECT * FROM `autographs` WHERE a_id=$data1";
$res4 = mysqli_query($connection, $ReadSql4);

$ReadSql5 = "SELECT * FROM `autographs` WHERE a_id=$data1";
$res5 = mysqli_query($connection, $ReadSql5);
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

    <main>
        <section class="main-template">
            <div class="my-body">
            <?php 
            if($r3 = mysqli_fetch_assoc($res3)){?>
                <div class="buy-button" style="padding-top:10%">
                <button type="submit" class="tu-btn" style="background-color: black; display: block;color: white;border: 2px solid #27a29e;border-radius: 5px;padding: 10px;"><a href="buy_autograph.php?param=<?php echo $r3['a_id']; ?>" style="color:white">Buy this autograph</a></button>
                </div><?php } ?>
                <?php 
                if($r = mysqli_fetch_assoc($res)){?>
                    <h1 style="color:#27a29e;font-family: 'Open Sans' ;font-weight: bold;text-align:center;"><?php 
                    echo $r['name'];?>
                    </h1>
                <?php } ?>
                <?php 
                if($r1 = mysqli_fetch_assoc($res1)){?>
                <h2 style="color:#27a29e;font-family: 'Open Sans' ;font-weight: bold;font-size:15px;padding-left:15%">
                    <?php 
                    echo $r1['username'];
                    ?></h2>
                <?php } ?>
                <div class="image" style="float:left;">
                <?php 
                while($r5 = mysqli_fetch_assoc($res5)){
                    echo $r5['image'];
                    echo "<img src='".$r5["image"]."'>";
                }?></div>
                <?php 
                if($r2 = mysqli_fetch_assoc($res2)){?>
                    <div class="autograph-description">
                        <ol>
                            <p style="padding-right:84px">Domain:</p>
                            <li><?php echo $r2['domain'];?></li><br><br>
                            <p style="padding-right:55px">How I got it:</p>
                            <li><?php echo $r2['provenance'];?></li><br><br>
                            <p style="padding-right:75px;">Location:</p>
                            <li><?php echo $r2['location'];?></li><br><br>
                            <p style="padding-right:20px">The signed object:</p>
                            <li><?php echo $r2['object'];?></li><br><br>
                            <p style="padding-right:25px">Special mentions:</p>
                            <li><?php echo $r2['mentions'];?></li><br><br>
                            <p style="padding-right:25px">Worth:</p>
                            <li><?php echo $r2['worth'];?></li>
                        </ol>
                    </div>
                <?php } ?>
                <?php 
                if($r4 = mysqli_fetch_assoc($res4)){
                   if($r4['user_id']==$_SESSION['id']){?>
                <form method="POST" action="upload.php?param=<?php echo $r4['a_id']; ?>" enctype="multipart/form-data">
            <div class="form-group" style="float:left;background-color: black; display: block;color: white;border: 2px solid #27a29e;border-radius: 5px;padding: 10px;">
                Edit picture
                <input class="form-control" type="file" name="uploadfile" value="" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="upload">UPLOAD</button>
            </div>
        </form> <?php }} ?>
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