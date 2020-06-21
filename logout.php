<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$datestring = date('F j, Y, g:i a', $_SERVER['REQUEST_TIME']);
mysqli_query($link,"UPDATE users set lastlogin='$datestring', ip='" . $_SERVER['REMOTE_ADDR'] . "' WHERE username='" . $_SESSION["username"] . "'");

// Close connection
mysqli_close($link);


// Unset all of the session variables
$_SESSION = array();

session_unset();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: index.php");
exit;
?>