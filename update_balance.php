<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/AuCo/";

require_once($path . 'connect.php');
// Initialize the session
session_start();

$balance=$_SESSION["balance"];
$amount= $_GET["amount"];
 
$_SESSION["balance"]=$balance+$amount;


$ReadSql = "UPDATE users SET balance=$_SESSION[balance] WHERE id=$_SESSION[id]";
$res = mysqli_query($connection, $ReadSql);

header("location: home.php");
mysqli_fetch_assoc($res);

?>
