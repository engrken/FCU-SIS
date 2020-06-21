<?php

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

// Check if the user is admin, if not then redirect him to welcome page
if(isset($_SESSION["admin"]) && $_SESSION["admin"] !== 1){
    header("location: welcome.php");
    exit;
}

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FCU Student Information System</title>
    <link rel="stylesheet" href="bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h2>Hi, <b><?php echo htmlspecialchars($_SESSION["fname"]); ?></b>. Welcome to FCU Student Information System.</h2>
    </div>
<b>Admin Panel:</b>
<p>This page will display administration panels (add/modifies subject & grades to user).</p>
<br><br>
<br>

    <p>
	<a href="welcome.php" class="btn btn-info">Home</a>
	<a href="search.php" class="btn btn-warning">Modify Student</a>
	<a href="academe/search.php" class="btn btn-primary">Modify Grade</a>
       	 <a href="showall.php" class="btn btn-danger">Show all users</a>
    </p>
</body>
<div class="footer"><?php include 'footer.php';?></div>
</html>