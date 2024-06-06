<?php
//connecting sign up to database
session_start();
include('includes/config.php');
if(isset($_POST['signup']))
{
	$name=$_POST['name'];
	$email=$_POST['email'];
	$password=md5($_POST['password']);

	$query = mysqli_query($conn,"select * from register where email = '$email'")or die(mysqli_error());
	$count = mysqli_num_rows($query);

	if ($count > 0){ ?>
	 <script>
	 alert('Data Already Exist');
	</script>
	<?php
      }else{
        mysqli_query($conn,"INSERT INTO register(fullName, email, password) VALUES('$name','$email','$password')         
		") or die(mysqli_error()); ?>
		<script>alert('Records Successfully  Added');</script>;
		<script>
		window.location = "index.php"; 
		</script>
		<?php   }

}

?>

<!DOCTYPE html> <!-- creating signup website -->
<html lang="en" class="bg-dark">
<head>
  <meta charset="utf-8" />
  <title>Academate</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
  <!-- linking stylesheet css files -->
  <link rel="stylesheet" href="css/bootstrap.css" type="text/css" />
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="css/app.css" type="text/css" />
 
</head>
<body style="background-color: #181818;"> <!-- creating page body -->
  <section style="background-color: #181818;"id="content" class="m-t-lg wrapper-md animated fadeInDown">
    <div style="background-color: #181818;"class="container aside-xxl">
      <a style="background-color: #181818; margin-top: 50px; color: white"class="navbar-brand block" href="signup.php">Academate</a>
      <section class="panel panel-default m-t-lg bg-white">
        <header class="panel-heading text-center">
          <strong>Sign up</strong>
        </header>

        <!-- creating sign up form -->
        <form name="signup" method="POST">
          <div class="panel-body wrapper-lg">
          	 <div class="form-group">
	            <label class="control-label">Name</label>
	            <input name="name" type="text" placeholder="eg. Your name or company" class="form-control input-lg">
	          </div>
	          <div class="form-group">
	            <label class="control-label">Email</label>
	            <input name="email" type="email" placeholder="test@example.com" class="form-control input-lg">
	          </div>
	          <div class="form-group">
	            <label class="control-label">Password</label>
	            <input name="password" type="password" id="inputPassword" placeholder="Type a password" class="form-control input-lg">
	          </div>
	          <div class="line line-dashed"></div>
	          <button style="background-color: #181818;"name="signup" type="submit" class="btn btn-primary btn-block">Sign up</button>
	          <div class="line line-dashed"></div>
	          <p class="text-muted text-center"><small>Already have an account?</small></p>
	          <a href="index.php" class="btn btn-default btn-block">Login</a>
          </div>
        </form>
      </section>
    </div>
  </section>

  <!-- website footer -->
  <footer style="background-color: #181818; padding-bottom: 350px"id="footer">
    <div style="background-color: #181818;"class="text-center padder clearfix">
      <p>
        <small>Notebook Website by John Rafael Abuelo</small>
      </p>
    </div>
  </footer>
>
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/app.js"></script>
  <script src="js/app.plugin.js"></script>
  <script src="js/slimscroll/jquery.slimscroll.min.js"></script>
  
</body>
</html>