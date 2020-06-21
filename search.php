<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: welcome.php");
    exit;
}

// Check if the user is admin, if not then redirect him to welcome page
if(isset($_SESSION["admin"]) && $_SESSION["admin"] !== 1){
    header("location: welcome.php");
    exit;
}

?>

<?php
// Include config file
require_once "config.php";

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


$admincheck = mysqli_query($link,"SELECT * From users WHERE admin = 1");          
$admin = mysqli_fetch_array($admincheck);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modify Student Information</title>
    <link rel="stylesheet" href="bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
	.wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div align="center" class="page-header">
        <h2>Hi, <b><?php echo htmlspecialchars($_SESSION["fname"]); ?></b>. Welcome to FCU Student Information System.</h2>
    </div>
    <div class="wrapper2">
        <h3>Modify Student Information</h3>

<form action="smodify.php" method="get">
<label for="username">Enter Student ID:</label>
<input class="form-control" type="text" name="username">
<br><br>
<a href="javascript:javascript:history.go(-1)" class="btn btn-danger">Back</a>
<a href="welcome.php" class="btn btn-info">Home</a>
<input type="submit" name="submit" value="Search" class="btn btn-primary">
<br><br><br>
</div>
</form>

</div>
</body>
<div class="footer"><?php include 'footer.php';?></div>
</html>