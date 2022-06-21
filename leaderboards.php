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

$filter=$_GET['param'];
$ReadSql = "SELECT * FROM `autographs` ORDER BY worth DESC";
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
                    <input type="number" placeholder="Amount" name="amount" min="1000" max="10000" step="100"
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
        	    ?></b> 	! Here are the tops of our autographs</h1>
                <div id="myBtnContainer" style="float:left; padding-top:2%;">
                    <button class="btn" onclick="filterSelection('all')"> Show all</button>
                    <button class="btn" onclick="filterSelection('0')"> &lt 1000$</button>
                    <button class="btn" onclick="filterSelection('1000')"> 1001 $ - 2000$</button>
                    <button class="btn" onclick="filterSelection('2000')"> 2001 $ - 3000$</button>
                    <button class="btn" onclick="filterSelection('3000')"> 3001 $ - 4000$</button>
                    <button class="btn" onclick="filterSelection('4000')"> &gt 4000 $</button>
                </div>
                <div class="download">
                    <label>Download statistics in format:
                        <input list="formats" name="myFormats" />
                    </label>
                    <datalist id="formats">
                        <option value="RSS">
                        <option value="CSV">
                        <option value="PDF">
                    </datalist>
                </div>
                <br><br>
                <div class="container" style="padding-top:5%">
                <?php while($r = mysqli_fetch_assoc($res)) {?>
                    <?php if($filter == "all") {?>
                        <div class="collections" style="padding-left:0%;">
                        <button><a href="autograph.php?param=<?php echo $r['a_id']; ?>"><?php echo $r['name']; ?>'s autograph <?php echo $r['worth']; ?> $ </a></button>
                        <br>
                        </div>
                    <?php } ?>
                    <?php if($filter<4000 && $r['worth']>$filter && $r['worth']<=$filter+1000){?>
                        <div class="collections" style="padding-left:0%;">
                        <button><a href="autograph.php?param=<?php echo $r['a_id']; ?>"><?php echo $r['name']; ?>'s autograph <?php echo $r['worth']; ?> $ </a></button>
                        <br>
                        </div>
                   <?php } ?>
                   <?php if($filter== 4000 && $r['worth']>$filter ){?>
                        <div class="collections" style="padding-left:0%;">
                        <button><a href="autograph.php?param=<?php echo $r['a_id']; ?>"><?php echo $r['name']; ?>'s autograph <?php echo $r['worth']; ?> $ </a></button>
                        <br>
                        </div>
                   <?php } ?>
                <?php } ?>
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
    <script>
        function filterSelection(c) {
        if (c == "all") 
            window.location.replace("leaderboards.php?param=all");
        else if(c == 0)
            window.location.replace("leaderboards.php?param=0");
        else if(c == 1000)
            window.location.replace("leaderboards.php?param=1000");
        else if(c == 2000)
            window.location.replace("leaderboards.php?param=2000");
        else if(c == 3000)
            window.location.replace("leaderboards.php?param=3000");
        else if(c == 4000)
            window.location.replace("leaderboards.php?param=4000");
        }

        
        // Get the container element
        var btnContainer = document.getElementById("myBtnContainer");

        // Get all buttons with class="btn" inside the container
        var btns = btnContainer.getElementsByClassName("btn");

        // Loop through the buttons and add the active class to the current/clicked button
        for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
        }

    </script>
</body>

</html>