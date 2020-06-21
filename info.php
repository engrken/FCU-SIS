<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: welcome.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Information</title>
    <link rel="stylesheet" href="bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>

<style type="text/css">
   #content{
   	width: 210px;
   	margin: 20px auto;
   	border: 1px solid #cbcbcb;
   }
   form{
   	width: 210px;
   	margin: 20px auto;
   }
   form div{
   	margin-top: 5px;
   }
   #img_div{
   	width: 210px;
   	margin: 15px auto;
   	border: 1px solid #cbcbcb;
   }
   #img_div:after{
   	content: "";
   	display: block;
   	clear: both;
   }
   img{
   	float: left;
   	margin: 5px;
   	width: 200px;
   	height: 200px;
   }
</style>

</head>
<body>
    <div class="page-header">
        <h2>Hi, <b><?php echo htmlspecialchars($_SESSION["fname"]); ?></b>. Welcome to FCU Student Information System.</h2>
    </div>




<?php
// Include config file
require_once "config.php";

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
$result = mysqli_query($link,"SELECT * FROM users WHERE sid='" . $_SESSION["sid"] . "'");

echo "<b><center>PERSONAL INFORMATION</center></b>";
echo "<br>";

    while ($row = mysqli_fetch_array($result)) {
      echo "<div id='img_div'>";
      	echo "<img src='images/".$row['picture']."' >";
      echo "</div>";


  ?>

  <form method="POST" action="" enctype="multipart/form-data">
  	<input type="hidden" name="size" value="1000000">
  	<div>
	<input type="file" name="image"> <br>
  	<button class="btn btn-default" type="submit" name="upload">Upload Photo</button>
  	</div>
  </form>

  <?php

echo "<table align='center'>";


echo "<tr>";
echo "<td align='left'><b>Student ID:</b> " . $row['sid'] . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align='left'><b>First Name:</b> " . $row['fname'] . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align='left'><b>Middle Name:</b> " . $row['mname'] . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align='left'><b>Last Name:</b> " . $row['lname'] . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align='left'><b>Address:</b> " . $row['address'] . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align='left'><b>Contact:</b> " . $row['contact'] . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align='left'><b>Email:</b> " . $row['email'] . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align='left'><b>Year/Grade:</b> " . $row['grade'] . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align='left'><b>Section:</b> " . $row['section'] . "</td>";
echo "</tr>";
}
echo "</table>";

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
                //get file extension.
                $ext = pathinfo($_FILES['image']['name'])['extension'];
                //generate the new random string for filename and append extension.
                $nFn = generateRandomString().".$ext";
		move_uploaded_file($_FILES['image']['tmp_name'],"images/".$nFn);

	mysqli_query($link,"UPDATE users set picture= '{$nFn}' WHERE sid= '{$_SESSION['sid']}'");
	echo "<meta http-equiv='refresh' content='0'>";
  }

function generateRandomString($length = 15) {
    return substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $length);
}

mysqli_close($link);
?>

<br><br><br>
    <p>
	<a href="welcome.php" class="btn btn-info">Home</a>
        <a href="modify.php" class="btn btn-primary">Edit</a>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out</a>
    </p>
</body>
<div class="footer"><?php include 'footer.php';?></div>
</html>