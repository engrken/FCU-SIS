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

<?php

if (isset($_GET['page_no']) && $_GET['page_no']!="") {
    $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
        }

$total_records_per_page = 5;

$offset = ($page_no-1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";


// Include config file
require_once "config.php";

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$result_count = mysqli_query($link,"SELECT COUNT(*) As total_records FROM `users` WHERE admin=0");
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1; // total pages minus 1

$result = mysqli_query($link,"SELECT * FROM `users` WHERE admin=0 ORDER BY id DESC LIMIT $offset, $total_records_per_page");

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FCU Student Information System</title>
    <link rel="stylesheet" href="bootstrap.css">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/font-awesome.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="mystyle.css" />
    <link rel="stylesheet" href="../bootstrap.css">

<style type="text/css">
	body{ 
		font: 14px sans-serif; 
		text-align: center; 
	}
   #img_div{
		width: 96px;
		margin: 15px auto;
		border: 1px solid #cbcbcb;
   }
   #img_div:after{
		content: "";
		display: block;
		clear: both;
   }
</style>

</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="academe/index.php">ACADEMIC RECORDS</a>
<?php 

if($_SESSION['admin'] == 1 ) {
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
       	 	<a onclick="window.location.href=this" class="btn btn-danger">Refresh</a>
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
            <h2 class="text-center">Student Records</h2>
            <div class="">
                <table align="center" style="width:80%" class="table table-bordered">

   <thead>
                        <tr class="alert alert-info">
                            <th class="text-center">Picture</th>
                            <th class="text-center">Student ID</th>
                            <th class="text-center">First Name</th>
                            <th class="text-center">Middle Name</th>
                            <th class="text-center">Last Name</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Contact No.</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Grade/Year</th>
                            <th class="text-center">Section</th>
							<th class="text-center">Last Login</th>
                            <th class="text-center">Task</th>
                        </tr>
                    </thead>

 <?php
while($rowtwo = mysqli_fetch_array($result)){
  echo '<tbody><tr>
	<td style="vertical-align: middle"><img width=100px height=100px src="images/'.$rowtwo["picture"].'"></td>
	<td style="vertical-align: middle">' .$rowtwo['sid'].'</td>
	<td style="vertical-align: middle">' .$rowtwo['fname'].'</td>
	<td style="vertical-align: middle">' .$rowtwo['mname'].'</td>
	<td style="vertical-align: middle">' .$rowtwo['lname'].'</td>
	<td style="vertical-align: middle">' .$rowtwo['address'].'</td>
	<td style="vertical-align: middle">' .$rowtwo['contact'].'</td>
	<td style="vertical-align: middle">' .$rowtwo['email'].'</td>
	<td style="vertical-align: middle">' .$rowtwo['grade'].'</td>
	<td style="vertical-align: middle">' .$rowtwo['section'].'</td>
	<td style="vertical-align: middle">' .$rowtwo['lastlogin'].'</td>
	<td style="vertical-align: middle">

		<form action="smodify.php" method="get">
                <label for="username"></label>
                <input type="hidden" name="username" value="' .$rowtwo['sid'].'">
                <input type="submit" name="submit" value="UPDATE INFO" class="btn btn-primary">
		</form>
	';

	if($_SESSION['admin'] == 1 ) {
         echo '
		<form action="academe/search.php" method="get">
                <label for="studentid"></label>
                <input type="hidden" name="studentid" value="' .$rowtwo['sid'].'">
                <input type="submit" name="submit" value="UPDATE GRADE" class="btn btn-primary">
		</form>

		<form action="academe/add.php" method="get">
                <label for="studentid"></label>
                <input type="hidden" name="studentid" value="' .$rowtwo['sid'].'">
                <input type="submit" name="submit" value="ADD GRADE" class="btn btn-primary">
		</form>

	</td>
        </tr></tbody>';
}
}
echo '</table>';
?>

<?php
mysqli_close($link);
?>

<strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
</div>

<ul class="pagination">
	<?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>
    
	<li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>Previous</a>
	</li>
       
    <?php 
	if ($total_no_of_pages <= 10){  	 
		for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}
        }
	}
	elseif($total_no_of_pages > 10){
		
	if($page_no <= 4) {			
	 for ($counter = 1; $counter < 8; $counter++){		 
			if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}
        }
		echo "<li><a>...</a></li>";
		echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
		echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
		}

	 elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {		 
		echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {			
           if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                  
       }
       echo "<li><a>...</a></li>";
	   echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
	   echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";      
            }
		
		else {
        echo "<li><a href='?page_no=1'>1</a></li>";
		echo "<li><a href='?page_no=2'>2</a></li>";
        echo "<li><a>...</a></li>";

        for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
          if ($counter == $page_no) {
		   echo "<li class='active'><a>$counter</a></li>";	
				}else{
           echo "<li><a href='?page_no=$counter'>$counter</a></li>";
				}                   
                }
            }
	}
?>
    
	<li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
	<a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>>Next</a>
	</li>
    <?php if($page_no < $total_no_of_pages){
		echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
		} ?>
</ul>    <br><br><br><br>  
</body>
<div class="footer"><?php include 'footer.php';?></div>
</html>