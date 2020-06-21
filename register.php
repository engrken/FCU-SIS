<?php
// Password protect this content
require_once('protect-this.php');  // Access code is beta

// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate SID
    if(empty(trim($_POST["sid"]))){
        $sid_err = "Please enter your Student ID.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE sid = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_sid);
            
            // Set parameters
            $param_sid = trim($_POST["sid"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $sid_err = "This Student ID is already taken.";
                } else{
                    $sid = trim($_POST["sid"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate EMAIL
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, fname, mname, lname, address, contact, email, grade, section, sid, picture) VALUES (?, ?, '$_POST[fname]','$_POST[mname]','$_POST[lname]','$_POST[address]','$_POST[contact]','$_POST[email]','$_POST[grade]','$_POST[section]','$_POST[sid]','$_POST[picture]')";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_sid = $sid;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: index.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration | FCU Student Information System</title>
    <link rel="stylesheet" href="bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif;
            background-image: url('logo.gif');
            background-repeat: no-repeat;
            background-size: 1020px 1020px;
            background-position: 50% 5%;
        }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper2">
      <center>  <h3>Registration</h3>
        <p>Please fill this form to create an account.</p><br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Student ID</label>
                <input type="text" name="sid" class="form-control" value="<?php echo $sid; ?>" required>
                <span class="help-block"><?php echo $sid_err; ?></span>
            </div> 
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="fname" class="form-control" value="" required>
            </div> 
            <div class="form-group">
		<input type="hidden" name="mname" class="form-control" value="Middle Name">
            </div> 
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lname" class="form-control" value="" required>
            </div> 
            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="" required>
            </div> 
            <div class="form-group">
                <label>Contact Number</label>
                <input type="text" name="contact" class="form-control" value="" required>
            </div> 
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div> 
            <div class="form-group">
                <label>Year/Grade</label>
                <select name="grade" class="form-control" required>
		<option value ="Grade 11">Grade 11</option>
		<option value ="Grade 11">Grade 12</option>
		<option value ="1st Year">1st Year</option>
		<option value ="2nd Year">2nd Year</option>
		<option value ="3rd Year">3rd year</option>
		<option value ="4th Year">4th Year</option>
		</select> 
            </div> 
            <div class="form-group">
                <input type="hidden" name="section" class="form-control" value="Your Section">
            </div> 

            <div class="form-group">
                <input type="hidden" name="picture" class="form-control" value="Capture.PNG">
            </div>

<p>By clicking register you agree to our <a href="#" onClick="MyWindow=window.open('policy.php','MyWindow','width=600,height=300'); return false;">Privacy Policy</a>.</p>
            <div class="form-group">
				<a href="index.php" class="btn btn-primary">Login here</a>
                <input type="submit" class="btn btn-warning" value="Register">
                <input type="reset" class="btn btn-danger" value="Reset">
            </div>
        </form>
    </div>   </center> 
</body>
<div class="footer"><?php include 'footer.php';?></div>
</html>