<?php
// Initialize the session
require_once __DIR__ . '/security.php';
fcusis_start_session();
 
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
    http_response_code(503);
    exit('This service is unavailable.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    fcusis_require_csrf();
    $first = fcusis_post('fname');
    $middle = fcusis_post('mname');
    $last = fcusis_post('lname');
    $address = fcusis_post('address');
    $contact = fcusis_post('contact');
    $email = fcusis_post('email');
    $grade = fcusis_post('grade');
    $section = fcusis_post('section');
    $update = $link->prepare('UPDATE users SET fname=?, mname=?, lname=?, address=?, contact=?, email=?, grade=?, section=? WHERE username=?');
    $update->bind_param('sssssssss', $first, $middle, $last, $address, $contact, $email, $grade, $section, $_SESSION['username']);
    $update->execute();
$message = "Information Modified Successfully";
}
$select = $link->prepare('SELECT * FROM users WHERE username=?');
$select->bind_param('s', $_SESSION['username']);
$select->execute();
$result = $select->get_result();
$row= mysqli_fetch_array($result);

$admincheck = mysqli_query($link,"SELECT * From users WHERE admin = 1");          
$admin = mysqli_fetch_array($admincheck);

            // Close statement


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
<input type="hidden" name="csrf" value="<?php echo fcusis_html(fcusis_csrf_token()); ?>">
<div><?php if(isset($message)) { echo $message; } ?>
</div>

<div class="form-group">
<label>Username: </label>

<?php if($_SESSION['admin'] == 1 ) {
           ?>
<input type="text" name="username" class="form-control" value="<?php echo fcusis_html($row['username']); ?>">
 <?php
       } else {
	?>
<input type="text" name="username" class="form-control" value="<?php echo fcusis_html($row['username']); ?>"readonly>
 <?php
       }
  ?>
</div>

<div class="form-group">
<label>Student ID: </label>
<?php if($_SESSION['admin'] == 1 ) {
           ?>
<input type="text" name="sid" class="form-control" value="<?php echo fcusis_html($row['sid']); ?>">
 <?php
       } else {
	?>
<input type="text" name="sid" class="form-control" value="<?php echo fcusis_html($row['sid']); ?>"readonly>
 <?php
       }
  ?>
</div>

<div class="form-group">
<label>First Name: </label>
<input type="text" name="fname" class="form-control" value="<?php echo fcusis_html($row['fname']); ?>">
</div>
<div class="form-group">
<label>Middle Name :</label>
<input type="text" name="mname" class="form-control" value="<?php echo fcusis_html($row['mname']); ?>">
</div>
<div class="form-group">
<label>Last Name :</label>
<input type="text" name="lname" class="form-control" value="<?php echo fcusis_html($row['lname']); ?>">
</div>
<div class="form-group">
<label>Address :</label>
<input type="text" name="address" class="form-control" value="<?php echo fcusis_html($row['address']); ?>">
</div>
<div class="form-group">
<label>Contact Number :</label>
<input type="text" name="contact" class="form-control" value="<?php echo fcusis_html($row['contact']); ?>">
</div>
<div class="form-group">
<label>Email :</label>
<input type="email" name="email" class="form-control" value="<?php echo fcusis_html($row['email']); ?>">
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