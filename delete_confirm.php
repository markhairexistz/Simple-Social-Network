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
if(empty($_SESSION)) // if the session not yet started 
   session_start();

if(!isset($_SESSION['getuser'])) { //if not yet logged in
   header("Location:index.php");// send to login page
   exit;
} 
?>
<?php
$getx = explode("/",$_GET['x']);
session_start();
?>
<?php 
include 'connection.php';
 
/*
	if(isset($_POST['login'])){
	$result = mysql_query("Select * from admin where user='".$_POST['txtuser']."' and pass='".$_POST['txtpass']."'");
	$rs = mysql_fetch_array($result);
	 if(mysql_num_rows($result)>=1){
		session_start();
		$_SESSION['getuser']=$_POST['txtuser'];
		$_SESSION['log']=true;
		$_SESSION['id']=$rs['id'];
		
		echo '
		<script language=javascript>;
		location.href="SGOD.php";
		</script>';
	}else{
		echo '<script language=javascript>;
		alert("Invalid Login!");
		</script>';
		
}
}


*/  ?>
<?php
/*
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
*/
	?>



<body>
<!-- sign up here-->

<body style = "background-image:url(img/web-development-banner2.jpg); background-attachment:fixed; background-size:cover; ">

  <!-- Start your project here-->

 
  
<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">

	<button class="navbar-toggler" data-toggle="collapse" data-target="#collapse_target">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="collapse_target">
		<span class="navbar-text">SCC Community</span>
			<ul class="navbar-nav">
				
			</ul>
	</div>
</nav>


<br/>
<div class="container-responsive">
	<div class="row">
	
		
	
	<div class="col-md-3">
		

	</div>
	
<?php
$mysql = mysql_query("SELECT * FROM post WHERE post_id = '".$getx[0]."'");
$data= mysql_fetch_array($mysql);
?>
<?php
if(isset($_POST['del'])){


$sql1=mysql_query("DELETE FROM comments WHERE post_id = '".$getx[0]."'");

$sql2=mysql_query("DELETE FROM post WHERE post_id = '".$getx[0]."'");


echo '<script language="javascript"> 
			location.href="user_profile.php";
			</script>';
}
	?>

	<div class="col-md-6">
	<div class="container-responsive bg-white" style="border-radius: 10px;">

<form name="viewdelpost" method="post" enctype = "multipart/form-data">
	<a href="user_profile.php">
	<button type="button" class="close">&times;</button> 
</a>
<center>
        	 <?php echo '		
		<img src="data:image;base64,'.$data['img_posted'].'" class="img-responsive img-thumbnail" style="height:190px; width:250px;margin-left:5px; margin-top:5px;">'?></br>
		<label class="label control-label" style="color:black; font-weight: bold;"> <?php echo $data['title'];?></label></br>
		<label class="label control-label"style="color:black; font-weight: bold;"><?php echo $data['description'];?></label></br>

          
<label class="label control-label" style="">Do you want to permanently delete this post?</label></br>

          <input type="submit" name="del" class="btn btn-danger" value="delete post">
</center>
       
   </form>

		</div>

	</div>
	
	<div class="col-md-3">
		
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
</body>

</html>

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

