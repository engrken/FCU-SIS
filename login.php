<?php
    /* Your password */
    $password = 'beta';

    /* Redirects here after login */
    $redirect_after_login = 'index.php';

    /* Will not ask password again for */
    $remember_password = strtotime('+3 days'); // 3 days
    if (isset($_POST['password']) && $_POST['password'] == $password) {
        setcookie("password", $password, $remember_password);
        header('Location: ' . $redirect_after_login);
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
    var adfly_id = 464945;
    var popunder_frequency_delay = 0;
	var adfly_google_compliant = true;
</script>
<script src="https://cdn.adf.ly/js/display.js"></script> 
    <meta charset="UTF-8">
<title>RESTRICTED</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="bootstrap.css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style type="text/css">
body,html {
    background-image: url('limit.jpg');
 background-repeat: no-repeat;
 background-size: cover;
}

#profile-img {
    height:300px;
}

    </style>

</head>
<center><body><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>



    <div>
        <div>
<!--            <img id="profile-img" class="rounded-circle profile-img-card" src="access.gif" />
            <p id="profile-name" class="profile-name-card"></p> -->
            <form method="POST">
			
                <input type="password" name="password" class="form-control" placeholder="ACCESS CODE" required>
			<br>
                <button class="btn btn-primary" type="submit">ENTER</button>
			
            </form><!-- /form -->
        </div>
    </div>


</body></center>
<!-- <div class="footer" style="background-color: black;"><?php include 'footer.php';?></div> -->
</html>