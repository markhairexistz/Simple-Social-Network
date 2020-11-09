<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Admin</title>
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

  ?>

<?php

if(empty($_SESSION)) // if the session not yet started 
   session_start();

if(!isset($_SESSION['getuser'])) { //if not yet logged in
   header("Location:index2.php");// send to login page
   exit;
} 

$selectadmin = mysql_query("SELECT * FROM admin WHERE id = '".$_SESSION['id']."'");
$admin = mysql_fetch_array($selectadmin);
 ?>

<body>
<!-- sign up here-->

<body >

  <!-- Start your project here-->

 <div class="jumbotron" style="margin-bottom:0px; background-color:black; ">
 	<h1 class="text-center" style="color:white;">Administrator</h1>
 	<p class="text-center" style="color:grey	;">Only Administrator can access this page.</p>
 </div>
  
<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">

	<button class="navbar-toggler" data-toggle="collapse" data-target="#collapse_target">
		<span class="navbar-toggler-icon"></span>
	</button>



	<div class="collapse navbar-collapse" id="collapse_target">
		<span class="navbar-text">SCC Community</span>
		

<ul class="navbar-nav">
		<li CLass="nav-item">
          <a class="nav-link" href = ""><span class="fa fa-user"></span> <?php Echo $admin['name']?></a>
        </li>
</ul>
			<ul class="navbar-nav">
			
					
				</li>
				<li CLass="nav-item">
					<a class="nav-link" href = "logout2.php"><span class="fa fa-sign out"></span> Logout</a>
				</li>
			</ul>

	</div>
</nav>


<br/>
<div class="container-responsive">
	<div class="row">
	
		
	
	<div class="col-md-12 ">
	</div>

	<div class="col-md-12">
	
	<form id="registration" name="registration" method="post" action="">
<style type=text/css>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 0px solid #dddddd;
  text-align: center;
  padding: 3px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<?php
if (isset($_POST['search'])){
  $selectuser = mysql_query("SELECT * FROM user WHERE nname like '%".$_POST['txtuser']."%'");
  $selectusernum = mysql_query("SELECT count(*) as count FROM user WHERE nname like '%".$_POST['txtuser']."%'");
 $count= mysql_fetch_assoc($selectusernum);
 $countn ='Result(s):';
}else{
$selectuser = mysql_query("SELECT * FROM user");
 $selectusernum = mysql_query("SELECT count(*) as count FROM user");
 $count= mysql_fetch_assoc($selectusernum);
 $countn ='No. of User(s):';
}

if(isset($_POST['ban'])){
}
?>
<form id="ss" name="ss" method="post" enctype = "multipart/form-data" action="">

    <input type="text" class="form-control" name="txtuser" placeholder="Search User" required="required"   style="width:240px; margin-left:10px; margin-top:10px;">
    <button type="submit" name="search" id="search" class="btn-sm btn-success" value = "Search" style="position:absolute; margin-top:-35px; margin-left:260px;"><span class="fa fa-search"></span> Search</button></br>
<a href="print.php">
<button type="button" name="print" id="print" class="btn-sm btn-success" value = "print" style="position:absolute; margin-top:-35px; margin-left:265px;"><span class="fa fa-print"></span></button></a></br>


  </form>
  <center>
<p style="font-weight: bold;"><?php echo $countn;?> <?php echo $count['count'];;?></p></center>
<table style="width:100%;" >
  <tr style=" font-weight: bold; color:white; " class="bg-dark">
  	<th><p style="font-weight: bold;">Image</p></th>
    <th><p style="font-weight: bold;">Firstname</p></th>
    <th><p style="font-weight: bold;">Lastname</p></th> 
    <th><p style="font-weight: bold;">Nickname</p></th>
    <th width="120px"><p style="font-weight: bold;">Action</p></th>
    <th width="120px"><p style="font-weight: bold;">Date Created</p></th>
    <th width="90px"><p style="font-weight: bold; text-align: center;">Status</p></th>
  </tr>
  <?php while($user= mysql_fetch_array($selectuser)) { 
  	?>
  	<?php if($user['status']==''){$status = 'ok'; $color = 'black';}else if($user['status']=='ban'){ $status = 'banned'; $color='red';}?>
  	<tr>
  	<td>
<a href="admin_view_profile.php?x=<?php echo $user['id'];?>/view_profile">
  		<?php echo '		
		<img src="data:image;base64,'.$user['img'].'" class="img-responsive img-thumbnail" style="height:50px; width:60px;">'?>
</a>
	</td>
    <td><?php echo $user['fname']; ?></td> 
    <td><?php echo $user['fname']; ?></td>
    <td><?php echo $user['nname']; ?></td>
    <td><center>
<a href="admin_view_profile.php?x=<?php echo $user['id'];?>/view_profile"> 
    	<p class="btn-sm btn-primary" style="width:80px; "><span class="fa fa-edit"></span> VIEW</p>
</a></center>
    	</td>
      <td><?php echo $user['date_created']; ?></td>
    	<td width="90px"><p style="font-weight: bold; text-align: center; color:blue;<?php echo $color;?>;"><?php echo $status;?></p></td>
  </tr>
<?php } ?>
</table>

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

