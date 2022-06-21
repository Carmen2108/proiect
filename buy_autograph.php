<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/AuCo/";

require_once($path . 'connect.php');
// Initialize the session
session_start();

$id_autograph=$_GET["param"];

// Update the balance of the buyer
$ReadSql = "UPDATE `autographs` SET user_id=$_SESSION[id] WHERE a_id=$id_autograph";
$res = mysqli_query($connection,$ReadSql);
header("location:home.php");
$r=mysqli_fetch_assoc($res);
?>
