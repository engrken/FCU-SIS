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
    http_response_code(503);
    exit('This service is unavailable.');
}
 
$profile = $link->prepare('SELECT * FROM users WHERE sid=?');
$profile->bind_param('s', $_SESSION['sid']);
$profile->execute();
$result = $profile->get_result();

echo "<b><center>PERSONAL INFORMATION</center></b>";
echo "<br>";

    while ($row = mysqli_fetch_array($result)) {
      echo "<div id='img_div'>";
      	echo "<img src='images/".rawurlencode(basename($row['picture']))."' >";
      echo "</div>";


  ?>

  <form method="POST" action="" enctype="multipart/form-data">
<input type="hidden" name="csrf" value="<?php echo fcusis_html(fcusis_csrf_token()); ?>">
  	<input type="hidden" name="size" value="1000000">
  	<div>
	<input type="file" name="image"> <br>
  	<button class="btn btn-default" type="submit" name="upload">Upload Photo</button>
  	</div>
  </form>

  <?php

echo "<table align='center'>";


echo "<tr>";
echo "<td align='left'><b>Student ID:</b> " . fcusis_html($row['sid']) . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align='left'><b>First Name:</b> " . fcusis_html($row['fname']) . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align='left'><b>Middle Name:</b> " . fcusis_html($row['mname']) . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align='left'><b>Last Name:</b> " . fcusis_html($row['lname']) . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align='left'><b>Address:</b> " . fcusis_html($row['address']) . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align='left'><b>Contact:</b> " . fcusis_html($row['contact']) . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align='left'><b>Email:</b> " . fcusis_html($row['email']) . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align='left'><b>Year/Grade:</b> " . fcusis_html($row['grade']) . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td align='left'><b>Section:</b> " . fcusis_html($row['section']) . "</td>";
echo "</tr>";
}
echo "</table>";

if (isset($_POST['upload'])) {
    fcusis_require_csrf();
    $upload = $_FILES['image'] ?? [];
    if (($upload['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK
        || ($upload['size'] ?? 0) > 1048576 || !is_uploaded_file($upload['tmp_name'])
        || !function_exists('imagecreatefromstring')) {
        http_response_code(400);
        exit('Upload a valid image under 1 MB.');
    }
    $imageInfo = @getimagesize($upload['tmp_name']);
    if (!$imageInfo || $imageInfo[0] > 2048 || $imageInfo[1] > 2048
        || !in_array($imageInfo[2], [IMAGETYPE_JPEG, IMAGETYPE_PNG], true)) {
        http_response_code(400);
        exit('Use a JPEG or PNG no larger than 2048 × 2048 pixels.');
    }
    $image = @imagecreatefromstring(file_get_contents($upload['tmp_name']));
    $filename = bin2hex(random_bytes(20)) . '.png';
    if (!$image || !imagepng($image, __DIR__ . '/images/' . $filename)) {
        http_response_code(400);
        exit('Unable to save the photo.');
    }
    imagedestroy($image);
    $update = $link->prepare('UPDATE users SET picture=? WHERE sid=?');
    $update->bind_param('ss', $filename, $_SESSION['sid']);
    $update->execute();
    echo "<meta http-equiv='refresh' content='0'>";
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