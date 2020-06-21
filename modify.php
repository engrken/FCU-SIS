<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
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

if(count($_POST)>0) {
mysqli_query($link,"UPDATE users set fname='" . $_POST['fname'] . "', mname='" . $_POST['mname'] . "', lname='" . $_POST['lname'] . "', address='" . $_POST['address'] . "' , contact='" . $_POST['contact'] . "' , email='" . $_POST['email'] . "' , grade='" . $_POST['grade'] . "', section='" . $_POST['section'] . "' WHERE username='" . $_SESSION["username"] . "'");
$message = "Information Modified Successfully";
}
$result = mysqli_query($link,"SELECT * FROM users WHERE username='" . $_SESSION["username"] . "'");
$row= mysqli_fetch_array($result);

$admincheck = mysqli_query($link,"SELECT * From users WHERE admin = 1");          
$admin = mysqli_fetch_array($admincheck);

            // Close statement
            mysqli_stmt_close($stmt);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modify Personal Information</title>
    <link rel="stylesheet" href="bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
	.wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper2">
        <h3>Modify Personal Information</h3>

<form name="frmUser" method="post" action="">
<div><?php if(isset($message)) { echo $message; } ?>
</div>

<div class="form-group">
<label>Username: </label>

<?php if($_SESSION['admin'] == 1 ) {
           ?>
<input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>">
 <?php
       } else {
	?>
<input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>"readonly>
 <?php
       }
  ?>
</div>

<div class="form-group">
<label>Student ID: </label>
<?php if($_SESSION['admin'] == 1 ) {
           ?>
<input type="text" name="sid" class="form-control" value="<?php echo $row['sid']; ?>">
 <?php
       } else {
	?>
<input type="text" name="sid" class="form-control" value="<?php echo $row['sid']; ?>"readonly>
 <?php
       }
  ?>
</div>

<div class="form-group">
<label>First Name: </label>
<input type="text" name="fname" class="form-control" value="<?php echo $row['fname']; ?>">
</div>
<div class="form-group">
<label>Middle Name :</label>
<input type="text" name="mname" class="form-control" value="<?php echo $row['mname']; ?>">
</div>
<div class="form-group">
<label>Last Name :</label>
<input type="text" name="lname" class="form-control" value="<?php echo $row['lname']; ?>">
</div>
<div class="form-group">
<label>Address :</label>
<input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?>">
</div>
<div class="form-group">
<label>Contact Number :</label>
<input type="text" name="contact" class="form-control" value="<?php echo $row['contact']; ?>">
</div>
<div class="form-group">
<label>Email :</label>
<input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>">
</div>
<!-- <div class="form-group">
<label>Year/Grade :</label>
                <select class="form-control" name="grade" readonly>
		<option value ="11">11</option>
		<option value ="12">12</option>
		<option value ="1st Year">1st Year</option>
		<option value ="2nd Year">2nd Year</option>
		<option value ="3rd year">3rd year</option>
		<option value ="4th Year">4th Year</option>
		</select> 
</div>
<div class="form-group">
<label>Section :</label>
                <select class="form-control" name="section" readonly>
		<option value ="A">A</option>
		<option value ="B">B</option>
		<option value ="None">None</option>
		</select>
</div>
-->
<div class="form-group">
<a href="info.php" class="btn btn-danger">Back</a>
<input type="submit" name="submit" value="Submit" class="btn btn-primary">

</div>
</form>
	<br><br>	<br><br><br><br><br><br>
</div>
</body>
<div class="footer"><?php include 'footer.php';?></div>
</html>