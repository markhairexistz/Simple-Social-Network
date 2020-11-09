<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Home</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
</head>
<!-- sign up here-->




<?php 
include 'connection.php';
 

	if(isset($_POST['login'])){
	$result = mysql_query("Select * from user where username='".$_POST['txtusername']."' and password='".base64_encode($_POST['txtpassword'])."'");
	$checkstatus = mysql_query("Select status from user where username='".$_POST['txtusername']."' and password='".base64_encode($_POST['txtpassword'])."'");
	$status = mysql_fetch_array($checkstatus);
	$rs = mysql_fetch_array($result);
	if($status['status']=='ban'){

echo '<script language=javascript>;
		alert("Your account has been banned from this site.");
		</script>';
	}
	else if(mysql_num_rows($result)>=1){
		session_start();
		$_SESSION['getuser']=$_POST['txtusername'];
		$_SESSION['log']=true;
		$_SESSION['id']=$rs['id'];
		
		echo '
		<script language=javascript>;
		location.href="user_view.php";
		</script>';
	}else{
		echo '<script language=javascript>;
		alert("Invalid Login!");
		</script>';
		
}
}

  ?>
<?php
$sql_user = mysql_query("SELECT * FROM user WHERE username='".$_POST['txtuser']."'");
//$email = $POST['txtemail'];
//$email = filter_var($email, FILTER_VALIDATE_EMAIL);



if(isset($_POST['signup'])){
	if(mysql_num_rows($sql_user)>0){
	$erruser=":Username Taken!";
	//}else if(!$email){
	//	$erremail = "Invalid Email Address!";
	//}
	}else if($_POST['txtpass']!=$_POST['txtrepass']){
		$errrepass=":Retype password Incorrect!";
	}else{

			mysql_query("INSERT INTO user(fname,lname,nname,gender,contact,email,username,password) 
	values('".$_POST['txtfname']."',
			'".$_POST['txtlname']."',
			'".$_POST['txtnname']."',
			'".$_POST['txtgender']."',
			'".$_POST['txtcellnum']."',
			'".$_POST['txtemail']."',
			'".$_POST['txtuser']."',
			'".base64_encode($_POST['txtpass'])."')");
		
	
	echo '<script language="javascript"> 
			alert("successfully registered!");
			location.href="index.php";
			</script>';
				}
			}

	?>




<!-- sign up here-->

<body style = "background-image:url(img/web-development-banner2.jpg); background-attachment:fixed; background-size:cover; ">

  <!-- Start your project here-->
 <!-- this is my shitty header-->
 <!--
 <div class="jumbotron" style="margin-bottom:0px;" >
 	<h1 class="text-center">SOCIAL NETWORK</h1>
 	<p class="text-center" style="font-size:14px; ">by: Markhair "ExistZ" Asim</p>


 </div>
  -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">

	<button class="navbar-toggler" data-toggle="collapse" data-target="#collapse_target">
		<span class="navbar-toggler-icon"></span>
	</button>

	

	<div class="collapse navbar-collapse" id="collapse_target">
		<span class="navbar-text">SOCIAL NETWORK</span>
			<ul class="navbar-nav">

        
        <li CLass="nav-item">
          <a class="nav-link" href = "" data-toggle="modal" data-target="#loginModal"><span class="fa fa-plus-circle fa-md"></span> Login</i></a>
        </li>
				
				
        
			</ul>
	</div> 


</nav>


<br/>
<div class="container-responsive">
	<div class="row">
	
		
	
	<div class="col-md-4 ">
	</div>

	<div class="col-md-4">
	<h3 class="title text-center" style = "color:white;">Create your account here.</h3>
	<form id="registration" name="registration" method="post" action="">

<label class="label control-label" style = "color:white;">Firstname</label>
	<input type="text" class="form-control" name="txtfname" placeholder="Firstname" required="required" value="<?php if(isset($_POST['txtfname'])){ echo $_POST['txtfname'];}?>">
	
<label class="label control-label" style = "color:white;">Lastname</label>
	<input type="text" class="form-control" name="txtlname" placeholder="Username" required="required" value="<?php if(isset($_POST['txtlname'])){ echo $_POST['txtlname'];}?>">
	

<label class="label control-label" style = "color:white;">Nickname</label>
	<input type="text" class="form-control" name="txtnname" placeholder="Nickname" required="required"value="<?php if(isset($_POST['txtnname'])){ echo $_POST['txtnname'];}?>">


<label class="label control-label" style = "color:white;">Gender</label>
	<select name="txtgender" class="form-control" value="<?php if(isset($_POST['txtgender'])){ echo $_POST['txtgender'];}?>">
		<option>Male</option>
		<option>Female</option>
	</select>


<label class="label control-label" style = "color:white;">Cellphone Number</label>
	<input type="number" class="form-control" name="txtcellnum" placeholder="Cellphone #" required="required" value="<?php if(isset($_POST['txtcellnum'])){ echo $_POST['txtcellnum'];}?>">


<label class="label control-label" style = "color:white;">Email</label>
	<input type="email" class="form-control" name="txtemail" placeholder="Email" required="required" value="<?php if(isset($_POST['txtemail	'])){ echo $_POST['txtemail'];}?>">

	<label class="label control-label" style = "color:white;">Username</label>
	<label class="label control-label text-danger"><?php echo $erruser; ?></label>
	<input type="text" class="form-control" name="txtuser" placeholder="Username" required="required" value="<?php if(isset($_POST['txtuser'])){ echo $_POST['txtuser'];}?>">
	

	<label class="label control-label" style = "color:white;">Password</label>
	<input type="password" class="form-control" name="txtpass" placeholder="Password" required="required" value="<?php if(isset($_POST['txtpass'])){ echo $_POST['txtpass'];}?>">

	<label class="label control-label" style = "color:white;">Retype Password</label>
	<label class="label control-label text-danger"><?php echo $errrepass; ?></label>
	<input type="password" class="form-control" name="txtrepass" placeholder="Re-type your password" required="required" value="<?php if(isset($_POST['txtrepass'])){ echo $_POST['txtrepass'];}?>">
	
	<center>

	<button type="submit" name="signup" id="signup" class="btn btn-primary" >Signup</button>

</center>
</form>
	</div>
	
	<div class="col-md-4">
		
	</div>
 
	</div>
</div>
<!-- /Start your project here-->
  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
</br>
  <center><p class="text-white">Developed and Designed by: Markhair Asim & Muad Abdulgafar.</p></center>
</body>

</html>
<!--
<div id="loginModal" class="modal" role="dialog">
    <div class="modaldialog float-right" >
      <div class="modal-content">
        <div class="modal-header">
        	<h4 class="modal-title text-center">Login</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>
        <form name="login" id="login" method="post" action="">
       <div class="modal-body">
        <label>Username</label>
        <input type="text" name="txtusername" id="username" class="form-control"/>
         <br/>
        <label>Password</label>
        <input type="Password" name="txtpassword" id="password" class="form-control"/>
        <br/>
        <input type="submit" name="login" id="login" class="btn btn-success" value="login"/>
       </div>
   		</form>
      </div>
    </div>
  </div>
-->

  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-sm modal-notify modal-primary rounded" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <p class="heading ">Login</p> <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!--Body-->
      <div class="modal-body">

        <form name="login" id="login" method="post" action="">
       <div class="modal-body">
        <label>Username</label>
        <input type="text" name="txtusername" id="username" class="form-control"/>
         <br/>
        <label>Password</label>
        <input type="Password" name="txtpassword" id="password" class="form-control"/>
        <br/>
        <input type="submit" name="login" id="login" class="btn btn-success" value="login"/>
       </div>
   		</form>

      </div>

      <!--Footer-->
      
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: modalConfirmDelete-->
 


