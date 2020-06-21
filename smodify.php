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

$search = $_GET['username'];
$result = mysqli_query($link,"SELECT * FROM users WHERE sid='$search'");
$row= mysqli_fetch_array($result);

if(count($_POST)>1) {
mysqli_query($link,"UPDATE users set fname='" . $_POST['fname'] . "', mname='" . $_POST['mname'] . "', lname='" . $_POST['lname'] . "', address='" . $_POST['address'] . "' , contact='" . $_POST['contact'] . "' , email='" . $_POST['email'] . "' , grade='" . $_POST['grade'] . "', section='" . $_POST['section'] . "', admin='" . $_POST['admin'] . "' WHERE sid='$search'");
echo '<script>alert("Information has been modified successfully!");</script>';

}


$admincheck = mysqli_query($link,"SELECT * From users WHERE admin = 1");          
$admin = mysqli_fetch_array($admincheck);

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>FCU Student Information System</title>

    <!-- Bootstrap core CSS -->

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/font-awesome.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="mystyle.css" />
    <link rel="stylesheet" href="../bootstrap.css">
   
<script>
function myFunction()
{
alert("Information Modified Successfully"); // this is the message in ""
}
</script>


  </head>
  <body><center>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">ACADEMIC RECORDS</a>
<?php 
// Include config file
require_once "config.php";

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$admincheck = mysqli_query($link,"SELECT * From users WHERE admin = 1");          
$admin = mysqli_fetch_array($admincheck);

if($admin == true){
         echo '<a class="navbar-brand" href="academe/add.php">ADD GRADE</a>';
         echo '<a class="navbar-brand" href="academe/search.php">UPDATE GRADE</a>';
         echo '<a class="navbar-brand" href="/showall.php">LIST STUDENTS</a>';
       }
  ?>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <div class="navbar-form navbar-right">
                <label class="text-primary">
                    Hi, <?php echo $_SESSION['fname']; ?>&nbsp;&nbsp;
                </label>
                <a href="../welcome.php"><button type="button" class="btn btn-success" name="submit">Home</button></a>
                <a href="../logout.php"><button type="button" class="btn btn-info" name="submit">Sign Out</button></a>
            </div>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>

    <div class="container" style="margin-top:60px;">
      <!-- Example row of columns -->
    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Modify <?php echo $row['fname']; ?> <?php echo $row['lname']; ?> Information</h2>


</head>

<form name="frmUser" method="post" action="">
<div><?php if(isset($message)) { echo $message; } ?>
</div>

<div class="form-group">

               <table align="center" class="table table-bordered">
                    <thead>
                        <tr class="alert alert-info">
                            <th class="text-center">User Name</th>
                            <th class="text-center">Student ID</th>
                            <th class="text-center">First Name</th>
                            <th class="text-center">Middle Name</th>
                            <th class="text-center">Last Name</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Contact No.</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Year/Grade</th>
                            <th class="text-center">Section</th>
                           <th class="text-center">Admin</th>
                           <th class="text-center">Task</th>
                        </tr>
                    </thead>

<tbody>
                            <tr>
                                <td class="text-center">
					<?php if($admin == true){
						?>
					<input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>">
					<?php
						} else {
						?>
					<input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>"readonly>
					<?php
						}
						?>
				</td>

                                <td class="text-center">
					<?php if($admin == true){
						?>
					<input type="text" name="sid" class="form-control" value="<?php echo $row['sid']; ?>">
					<?php
						} else {
					?>
					<input type="text" name="sid" class="form-control" value="<?php echo $row['sid']; ?>"readonly>
					<?php
						}
						?>
				</td>

                                <td class="text-center">
				<input type="text" name="fname" class="form-control" value="<?php echo $row['fname']; ?>">
				</td>


                                <td class="text-center">
				<input type="text" name="mname" class="form-control" value="<?php echo $row['mname']; ?>">
				</td>

                                <td class="text-center">
				<input type="text" name="lname" class="form-control" value="<?php echo $row['lname']; ?>">
				</td>

                                <td class="text-center">
				<input type="text" name="address" class="form-control" value="<?php echo $row['address']; ?>">
				</td>

                                <td class="text-center">
				<input type="text" name="contact" class="form-control" value="<?php echo $row['contact']; ?>">
				</td>

                                <td class="text-center">
				<input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>">
				</td>

                                <td class="text-center">
                		<select class="form-control" name="grade">
				<option value ="<?php echo $row['grade']; ?>"><?php echo $row['grade']; ?></option>
				<option value ="11">11</option>
				<option value ="12">12</option>
				<option value ="1st Year">1st Year</option>
				<option value ="2nd Year">2nd Year</option>
				<option value ="3rd year">3rd year</option>
				<option value ="4th Year">4th Year</option>
				</select> 
				</td>

                                <td class="text-center">
             			<select class="form-control" name="section">
				<option value ="<?php echo $row['section']; ?>"><?php echo $row['section']; ?></option>
				<option value ="A">A</option>
				<option value ="B">B</option>
				<option value ="None">None</option>
				</select>
				</td>

                                <td class="text-center">
				<?php if($_SESSION['admin'] == 1 ) {
					?>
				<select class="form-control" name="admin">
				<option value ="0">No</option>
				<option value ="1">Yes</option>
				</select>
				<?php
					}
				?>
				</td>

                                <td class="text-center">
                                <input type="submit" name="submit" value="Submit" class="btn btn-primary">


</form></td>
                            </tr>
                    </tbody>
<?php
mysqli_close($link);
?>
</table>
</div>
</body>
                <center><a href="javascript:javascript:history.go(-1)" class="btn btn-danger">Back</a></center>
<div class="footer"><?php include 'footer.php';?></div>
</html>