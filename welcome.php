<?php

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

// Include config file
require_once "config.php";

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$last = mysqli_query($link,"SELECT lastlogin, ip FROM users WHERE username='" . $_SESSION["username"] . "'");
while($get = mysqli_fetch_array($last)){
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to FCU Student Information System</title>
    <link rel="stylesheet" href="bootstrap.css">
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script>$(document).ready(function(){


$(".readMore").click(function(){
var This=$(this);    
$(this).next().toggle(function(){
    if(This.text()=="Read"){
      This.text("Hide") 
    }
    else{
        This.text("Read") 
    }
})
});})</script>

<script>
if (document.addEventListener) {
  document.addEventListener('contextmenu', function(e) {
//    alert("You've tried to open context menu"); //here you draw your own menu
    e.preventDefault();
  }, false);
} else {
  document.attachEvent('oncontextmenu', function() {
//    alert("You've tried to open context menu");
    window.event.returnValue = false;
  });
}
</script>

    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
		.notice:first-child{
    margin-top:10px;
    }
.notice {
    padding: 15px;
    background-color: #fafafa;
    border-left: 6px solid #7f7f84;
    margin-bottom: 10px;
    -webkit-box-shadow: 0 5px 8px -6px rgba(0,0,0,.2);
       -moz-box-shadow: 0 5px 8px -6px rgba(0,0,0,.2);
            box-shadow: 0 5px 8px -6px rgba(0,0,0,.2);
}
.notice-sm {
    padding: 10px;
    font-size: 80%;
}
.notice-lg {
    padding: 35px;
    font-size: large;
}
.notice-success {
    border-color: #80D651;
}
.notice-success>strong {
    color: #80D651;
}
.notice-info {
    border-color: #45ABCD;
}
.notice-info>strong {
    color: #45ABCD;
}
.notice-warning {
    border-color: #FEAF20;
}
.notice-warning>strong {
    color: #FEAF20;
}
.notice-danger {
    border-color: #d73814;
}
.notice-danger>strong {
    color: #d73814;
}
.notice>.desc{
    display:none;
    }
.readMore{
    cursor:pointer;
}
    </style>
</head>
<body>
    <div class="page-header">
        <h2>Hi, <b><?php echo htmlspecialchars($_SESSION["fname"]); ?></b>. Welcome to FCU Student Information System.</h2>
	<?php
		echo "<h5 class='text-center text-danger'>Your last login was on " . $get['lastlogin'] . " and the last IP you used was " . $get['ip'] . "</h5>";
		}
		?>
    </div>



<b>Welcome Page:</b>
<p>This website is created for FCU students to track their academic records.</p>

<div class="container" style="width:800px">
    <div class="notice notice-danger" style="text-align: left;">
        <strong>ATTENTION</strong> (Last Update: June 9, 2020)  <span class="pull-right text-danger readMore">Read</span>
         <div class="desc">
            <p>
               Attention!
            </p>        
        </div>
    </div>
	
    <div class="notice notice-success" style="text-align: left;">
        <strong>ANNOUNCEMENTS</strong> (Last Update: June 9, 2020)<span class="pull-right text-success readMore">Read</span>
        <div class="desc">
           <p>
               No announcements for now.
            </p>        
        </div>
    </div>
<?php if($_SESSION['admin'] == 1 || $_SESSION['grade'] == 'Grade 11' || $_SESSION['grade'] == 'Grade 12' ) {
         echo '
    <div class="notice notice-info" style="text-align: left;">
        <strong>SENIOR HIGH SCHOOL E-MODULES</strong> (Last Update: June 12, 2020)  <span class="pull-right text-info readMore">Read</span>
		         <div class="desc">
				';
			}
?>

<?php if($_SESSION['admin'] == 1 || $_SESSION['grade'] == 'Grade 11' ) {
         echo '
				<b>TVL - Grade 11</b>
					<ul>
						<li>Module 1
							<ul>
							<li><a href="https://youtu.be/oX1mgTCfNcI" target="_blank">Topic 1</a><i> released 06/12/2020</i></li>
							<li><a href="#" target="_blank">Topic 2</a></li>
							<li><a href="#" target="_blank">Topic 3</a></li>
							<li><a href="#" target="_blank">Topic 4</a></li>
							<li><a href="#" target="_blank">Worksheet 1</a></li>
							</ul>
						</li>
						<li>Module 2
							<ul>
							<li><a href="#" target="_blank">Topic 1</a></li>
							<li><a href="#" target="_blank">Topic 2</a></li>
							<li><a href="#" target="_blank">Topic 3</a></li>
							</ul>
						</li>
					</ul>
				';
			}
?>

<?php if($_SESSION['admin'] == 1 || $_SESSION['grade'] == 'Grade 12' ) {
         echo '
				<b>TVL - Grade 12</b>
					<ul>
						<li>Module 1
							<ul>
							<li><a href="#" target="_blank">Topic 1</a></li>
							<li><a href="#" target="_blank">Topic 2</a></li>
							<li><a href="#" target="_blank">Topic 3</a></li>
							<li><a href="#" target="_blank">Topic 4</a></li>
							<li><a href="#" target="_blank">Worksheet 1</a></li>
							</ul>
						</li>
						<li>Module 2
							<ul>
							<li><a href="#" target="_blank">Topic 1</a></li>
							<li><a href="#" target="_blank">Topic 2</a></li>
							<li><a href="#" target="_blank">Topic 3</a></li>
							</ul>
						</li>
					</ul>
				
				
				';
			}
?>
        </div>
    </div>
<?php if($_SESSION['admin'] == 1 || $_SESSION['grade'] == '1st Year' || $_SESSION['grade'] == '2nd Year' || $_SESSION['grade'] == '3rd Year' || $_SESSION['grade'] == '4th Year' ) {
         echo '
    <div class="notice notice-warning" style="text-align: left;">
        <strong>BSECE E-MODULES</strong> (Last Update: June 10, 2020)  <span class="pull-right text-warning readMore">Read</span>
          <div class="desc">
            
            <p>
               <ul>
				<li>Computer Programming - (EComp1)
					<ul>
					<li><a href="http://adf.ly/464945/www.google.com" target="_blank">Module 1</a></li>
					<li><a href="http://adf.ly/464945/www.google.com" target="_blank">Module 2</a></li>
					</ul>
				</li>
				</ul>
            </p>        
        </div>
    </div>
				';
			}
?>
<!--    <div class="notice notice-lg">
        <strong>Big Heading</strong> notice-lg  <span class="pull-right readMore">Read</span>
          <div class="desc">
            
            <p>
               Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
               Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
               in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
               sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>        
        </div>
    </div>
    <div class="notice notice-sm">
        <strong>Small Heading</strong> notice-sm  <span class="pull-right readMore">Read</span>
         <div class="desc">
            
            <p>
               Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
               Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
               in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
               sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>        
        </div>
    </div>
	-->
</div>
    <p>
	<a href="info.php" class="btn btn-info">Personal Information</a>
	<a href="academe" class="btn btn-primary">Academic Records</a>
        <a href="logout.php" class="btn btn-danger">Log Out</a>

    </p>
</body>
<div class="footer"><?php include 'footer.php';?></div>

	<?php
		mysqli_close($link);
		?>
</html>