<?php 

    include('../config.php'); 

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../index.php");
    exit;
}

// Check if the user is admin, if not then redirect him to welcome page
if(isset($_SESSION["admin"]) && $_SESSION["admin"] !== 1){
    header("location: ../welcome.php");
    exit;
}

if(count($_POST)>0) {
$sql = "INSERT INTO acad (sid, sy, sem, scode, stitle, prelim, midterm, prefi, final, equi, remarks) VALUES ('$_POST[sid]','$_POST[sy]','$_POST[sem]','$_POST[scode]','$_POST[stitle]','$_POST[prelim]','$_POST[midterm]','$_POST[prefi]','$_POST[final]','$_POST[equi]','$_POST[remarks]')";


mysqli_query($link, $sql);
$message = "Information Modified Successfully";
}



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

    <title>Academe</title>

    <!-- Bootstrap core CSS -->

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/font-awesome.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="stylesheet" href="mystyle.css" />
    <link rel="stylesheet" href="../bootstrap.css">
   
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

if($_SESSION['admin'] == 1 ) {
         echo '<a class="navbar-brand" href="add.php">ADD GRADE</a>';
         echo '<a class="navbar-brand" href="search.php">UPDATE GRADE</a>';
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
            <h2 class="text-center">Add Student Grade</h2>


<form name="frmUser" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<div><?php if(isset($message)) { echo $message; } ?>
</div>

<div class="form-group">
<label>Student ID: </label>
<input class="form-control" type="text" name="sid" value="<?php echo $_GET['studentid']; ?>" required>
</div>
<div class="form-group">
<table align="center" style="width:80%" class="table table-bordered">
                    <thead>
                        <tr class="alert alert-info">
                            <th class="text-center">School<br>Year</th>
                            <th style="vertical-align: middle" class="text-center">Semester</th>
                            <th class="text-center">Subject<br>Code</th>
                            <th style="vertical-align: middle" class="text-center">Subject Title</th>
                            <th class="text-center">1st<br>Quarter *</th>
                            <th class="text-center">2nd<br>Quarter *</th>
                            <th class="text-center">3rd<br>Quarter *</th>
                            <th class="text-center">4th<br>Quarter *</th>
                            <th class="text-center">Average /<br>Final Grade</th>
                           <th style="vertical-align: middle" class="text-center">Remarks</th>
                           <th style="vertical-align: middle" class="text-center">Task</th>
                        </tr>
                    </thead>
</div>
                    <tbody>
                            <tr>
                                <td class="text-center"><select class="form-control" name="sy">
		<option value =""></option>
		<option value ="Summer">Summer</option>
		<option value ="2019-2020">2019-2020</option>
		<option value ="2020-2021">2020-2021</option>
		</select></div></td>
                                <td class="text-center"><select class="form-control" name="sem">
		<option value =""></option>
		<option value ="Summer">Summer</option>
		<option value ="1st Sem">1st Sem</option>
		<option value ="2nd Sem">2nd Sem</option>
		</select></td>
                                <td class="text-center"><select class="form-control" name="scode">
		<option value =""></option>
		<option value ="ECE 2">ECE 2</option>
		<option value ="EComp 1">EComp 1</option>
		<option value ="ECE 424">ECE 424</option>
		</select> </td>
                                <td class="text-center"><select class="form-control" name="stitle">
		<option value =""></option>
		<option value ="ADVANCED ENGG MATHEMATICS (FOR ECE)">ADVANCED ENGG MATHEMATICS (FOR ECE)</option>
		<option value ="COMPUTER PROGRAMMING">COMPUTER PROGRAMMING</option>
		<option value ="ECE Computer Applications">ECE Computer Applications</option>
		</select></td>
                                <td class="text-center"><input class="form-control" type="text" name="prelim" value="N/A"></td>
                                <td class="text-center"><input class="form-control" type="text" name="midterm" value="N/A"></td>
                                <td class="text-center"><input class="form-control" type="text" name="prefi" value="N/A"></td>
                                <td class="text-center"><input class="form-control" type="text" name="final" value="N/A"></td>
                                <td class="text-center"><input class="form-control" type="text" name="equi" value=""></td>
                                <td class="text-center"><select class="form-control" name="remarks">
		<option value =""></option>
		<option value ="PASSED">PASSED</option>
		<option value ="FAILED">FAILED</option>
		<option value ="NO PERMIT">NO PERMIT</option>
		<option value ="INC">INC</option>
		</select> </td>
                                <td class="text-center">
                                    <input type="submit" name="submit" value="Submit" class="btn btn-primary">
</td>
</div>

                            </tr>
                    </tbody>
</form>
            </div>
                    </table>
    </div>

<h5 class="text-center text-danger">* Quarterly result is for Senior High School Students Only</h5>

<!-- <a href="javascript:javascript:history.go(-1)" class="btn btn-danger">Back</a> -->



  </body>
<div class="footer"><?php include '../footer.php';?></div>
</html>

