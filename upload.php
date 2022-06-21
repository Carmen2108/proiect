<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/AuCo/";

require_once($path . 'connect.php');
// Initialize the session
session_start();

$id_autograph=$_GET["param"];
// If upload button is clicked ...
if (isset($_POST['upload'])) {
 
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "./images/" . $filename;
    $filename1="images/".$filename;
 
    echo $folder;
    // Get all the submitted data from the form
    $Resql = "UPDATE `autographs` SET image='$filename1' WHERE a_id='$id_autograph' ";
 
    // Execute query
    $res= mysqli_query($connection, $Resql);
    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder)) {
        header("location:collection.php");
    } else {
        echo "<h3>  Failed to upload image!</h3>";
    }

}
?>