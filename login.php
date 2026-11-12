<?php
require_once __DIR__ . '/security.php';
fcusis_start_session();

$accessHash = getenv('FCU_SIS_ACCESS_PASSWORD_HASH');
if (!$accessHash) {
    http_response_code(503);
    exit('This service is unavailable.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    fcusis_require_csrf();
    if (password_verify(fcusis_post('password'), $accessHash)) {
        session_regenerate_id(true);
        $_SESSION['legacy_site_access_until'] = time() + 3600;
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>RESTRICTED</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="bootstrap.css">
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
<input type="hidden" name="csrf" value="<?php echo fcusis_html(fcusis_csrf_token()); ?>">
			
                <input type="password" name="password" class="form-control" placeholder="ACCESS CODE" required>
			<br>
                <button class="btn btn-primary" type="submit">ENTER</button>
			
            </form><!-- /form -->
        </div>
    </div>


</body></center>
<!-- <div class="footer" style="background-color: black;"><?php include 'footer.php';?></div> -->
</html>