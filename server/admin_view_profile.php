<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Profile</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="css/style.css" rel="stylesheet">
</head>
<?php
if(empty($_SESSION)) // if the session not yet started 
   session_start();

if(!isset($_SESSION['getuser'])) { //if not yet logged in
   header("Location:index2.php");// send to login page
   exit;
} 
?>
<body style = "background-image:url(img/web-development-banner2.jpg); background-attachment:fixed; background-size:cover; ">
	<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">

	<button class="navbar-toggler" data-toggle="collapse" data-target="#collapse_target">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="collapse_target">
		<span class="navbar-text">SCC Community</span>
			<ul class="navbar-nav">
        		
				<li CLass="nav-item">
					<a class="nav-link" href = "SGOD.php">Home</a>
				</li>

				<li CLass="nav-item">
					<a class="nav-link" href = "logout2.php">Log out</a>
				</li>

        
			</ul>
	</div>
</nav>

<?php 
include 'connection.php'; ?>
<?php
$getx = explode("/",$_GET['x']);
session_start();
$mysql = mysql_query("SELECT * FROM user WHERE id = '".$getx[0]."'");
$data= mysql_fetch_array($mysql);
?>

<?php

if(isset($_POST['post'])){
	$image = addslashes($_FILES['postimage']['tmp_name']);
		$name = addslashes($_FILES['postimage']['name']);
		$image = file_get_contents($image);
		$image = base64_encode($image);

	mysql_query("INSERT INTO post (title,img,description,user_id) 
	values('".$_POST['txttitle']."',
			'".$image."',
			'".$_POST['txtdescription']."',
			'".$data['id']."')");
		
	
	echo '<script language="javascript"> 
			alert("successfully Posted!");
			location.href="user_view.php";
			</script>';
				
			}

	?>

<?php
	$mysql=mysql_query("SELECT * FROM post JOIN user ON user.id=post.user_id  WHERE post.user_id = '".$data['id']."' ORDER BY post.date_posted DESC") ;
	
?>


  <!-- Start your project here-->
  <?php
  /*
$checkfollow = mysql_query("SELECT * FROM follow WHERE user_id = '".$getx[0]."' and follow_by = '".$_SESSION['id']."'");
$check = mysql_fetch_array($checkfollow);
if ($check['follow_by']!=$_SESSION['id']){
$button = 'Follow';
	$color = 'btn-info';

}else if($check['follow_by']==$_SESSION['id']){
	$button = 'Unfollow';
	$color = 'btn-warning';
}

   ?>
}
}

<?php 

if($_POST['follow'] == 'Follow'){
mysql_query("INSERT INTO follow (user_id,follow_by) 
	//values('".$getx[0]."', 
			'".$_SESSION['id']."')");
		
	
	echo '<script language="javascript"> 
			location.href="user_view.php";
			</script>';
		}else if($_POST['follow']=='Unfollow'){

			mysql_query("DELETE FROM follow where user_id = '".$getx[0]."'");
		
	
	echo '<script language="javascript"> 
			location.href="user_view.php";
			</script>';
		}
		*/
?>

<?php 
if(isset($_POST['confirm'])){
mysql_query("UPDATE user SET status = 'ban' WHERE id = '".$getx[0]."'");
echo '<script language="javascript"> 
			location.href="SGOD.php";
			</script>';
		}
	
if(isset($_POST['unban'])){
mysql_query("UPDATE user SET status = '' WHERE id = '".$getx[0]."'");
echo '<script language="javascript"> 
			location.href="SGOD.php";
			</script>';
		}

$checkstatus = mysql_query("SELECT status,nname FROM user WHERE id = '".$getx[0]."'");
$status=mysql_fetch_array($checkstatus);
if ($status['status']=='ban'){
$button = 'Unban';
	$color = 'btn-warning';
	$target = '#unbanmodal';

}else if($status['status']!='ban'){
	$button = 'ban';
	$color = 'btn-danger';
	$target = '#loginModal';
}

?>
<div class="container-responsive" style="">
	<div class="row">
	<!--SIDE BAR-->
	<div class="col-md-3">
	<div class="col-md-12 container" style="background-color:#e4e3e3; border-radius:5px; height:120px; margin-top:60px;">
	<form id="sidebar" name="sidebar" method="post" enctype = "multipart/form-data" action="">
		<?php echo '		
		<img src="data:image;base64,'.$data[0].'" class="img-responsive img-thumbnail" style="height:110px; width:125px;margin-top:-40px;margin-left:5px;">'?>
		<label class="label control-label" style="color:black; margin-top: 10px; margin-left:10px;"><?php echo $data['nname'];?></label><br/>

		<label class="label control-label" style="color:black;margin-top: 5px; margin-left:10px;"><?php echo $data['fname'];?></label>

		<label class="label control-label" style="color:black;margin-top: 5px; margin-left: 10px;"><?php echo $data['lname'];?></label>
		<a class="nav-link" href = "" data-toggle="modal" data-target="<?php echo $target; ?>">
	<input type="submit" name="ban" class="btn-sm <?php echo $color; ?>" value="<?php echo $button;?>" style="margin-top:-40px; position:absolute; margin-left:190px;">
</a>
 	</form>  	
 	</div>
	</div>
	
	<!--SIDEBAR-->

	<div class="col-md-6" style="margin-top:40px;">
		<?php while($post= mysql_fetch_array($mysql)){ ?>
		
<form id="viewpost" name="viewpost" method="post" enctype = "multipart/form-data" action="">
 	<div class="col-md-12 container-responsive " style="background-color:#e4e3e3;border-radius:5px; margin-top:20px;">
		<?php echo '		
		<img src="data:image;base64,'.$data[0].'" class="img-responsive img-thumbnail" style="height:70px; width:80px;margin-left:5px; margin-top:-40px;">'?>
		<label class="label control-label" style="color:black; margin-top: 10px; margin-left:10px;"><?php echo $post['nname'];?></label>
		<label class="label control-label" style="color:black; float:right; margin-top:10px;">Posted on <?php echo $post['date_posted']?></label><br/>
		<label class="label control-label" style="color:black; "><?php echo $post['title']?></label><br/>
		<label class="label control-label" style="font-size:12px; color:black;"><?php echo $post['description']?></label>
          <?php echo '		
		<img src="data:image;base64,'.$post[2].'" class="img-responsive img-thumbnail" style="height:300px; width:630px;margin-left:5px; margin-top:0px;">'?>
	</div>	
</form>
		<br/>
		<br/>
        
	<?php }?>

	</div>
	

<?php 
if (isset($_POST['search'])){
$viewusers = mysql_query("SELECT * FROM user  WHERE nname LIKE '%".$_POST['txtuser']."%' and id !='".$_SESSION['id']."'");
$viewusernum = mysql_query("SELECT COUNT(*) as totalfollowed FROM user  WHERE nname LIKE '%".$_POST['txtuser']."%' and id !='".$_SESSION['id']."'");
$label='Result(s):';
$usernum= mysql_fetch_assoc($viewusernum);
}else{
	$viewusers = mysql_query("SELECT * FROM follow join user on user.id=follow.user_id WHERE follow_by = '".$getx[0]."'");
	$viewusernum = mysql_query("SELECT COUNT(*) as totalfollowed FROM follow join user on user.id=follow.user_id WHERE follow_by = '".$getx[0]."'");
	$label='Following:';
	$usernum= mysql_fetch_assoc($viewusernum);
}
?>


	<div class="col-md-3" style="margin-top:50px;">

		<form id="ss" name="ss" method="post" enctype = "multipart/form-data" action="">

		<input type="text" class="form-control" name="txtuser" placeholder="Search User" required="required"   style="width:240px; margin-left:-5px; margin-top:10px;">
		<input type="submit" name="search" id="search" class="btn-sm btn-success" value = "Search" style="position:absolute; margin-top:-35px; margin-left:240px;"></br>
	</form>

	</br>		
	<label class="label control-label" style="color:white; position:absolute; margin-top:-20px; margin-left:-5px;"><?php echo $label; ?> <font style="font-size: 24px;"color="white">(<?php echo $usernum['totalfollowed'];?>)</font></label>

		<?php while($users= mysql_fetch_array($viewusers)){ ?>
		<div class="col-md-12 container" style="background-color:#e4e3e3; border-radius:5px; height:110px; margin-top:10px; margin-left:-5px;">
		<form id="rightsidebar" name="rightsidebar" method="post" enctype = "multipart/form-data" action="">
		<a href="admin_view_profile.php?x=<?php echo $users['id'];?>/view_profile">
		<?php echo '		
		<img src="data:image;base64,'.$users['img'].'" class="img-responsive img-thumbnail" style="height:70px; width:80px;margin-top:10px;margin-left:-10px;">'?></a>
		<label class="label control-label" style="color:black; position:absolute; margin-top:30px; margin-left:5px;"><?php echo $users['nname'];?></label><br/>
		
		<a href="admin_view_profile.php?x=<?php echo $users['id'];?>/view_profile">
		<label class="label control-label" style="font-size:12px; margin-left: 5px; margin-top:10px;">VIEW PROFILE</label>
		</a>
 	 </form>
 	 </div>
 	<?php }?>

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
	<center>
    <div class="modaldialog" style="width:550px;" >
      <div class="modal-content">
        <div class="modal-header bg-primary">
        	 <?php echo '		
		<img src="data:image;base64,'.$data[0].'" class="img-responsive img-thumbnail" style="height:80px; width:90px;margin-left:5px;">'?>
		<label style="height:60px; width:70px;margin-left:10px; margin-top:15px; color:white;"><?php echo $data['nname'];?></label>
          <button type="button" class="close" data-dismiss="modal">&times;</button> 

        </div>
        <form name="login" id="login" method="post" action="">
       <div class="modal-body">
       
        <br/>
        	<label>Note: Banning this user will make him/her unable to log in to his/her account!.</label>
        <input type="submit" name="confirm" id="confirm" class="btn btn-danger" value="ban"/>
       </div>
   		</form>
      </div>
    </div></center>
  </div>



<div id="unbanmodal" class="modal" role="dialog">
	<center>
    <div class="modaldialog" style="width:550px;" >
      <div class="modal-content">
        <div class="modal-header bg-primary">
        	 <?php echo '		
		<img src="data:image;base64,'.$data[0].'" class="img-responsive img-thumbnail" style="height:80px; width:90px;margin-left:5px;">'?>
		<label style="height:60px; width:70px;margin-left:10px; margin-top:15px; color:white;"><?php echo $data['nname'];?></label>
          <button type="button" class="close" data-dismiss="modal">&times;</button> 

        </div>
        <form name="login" id="login" method="post" action="">
       <div class="modal-body">
       
        <br/>
        	<label>Note: Unbanning this user will make him/her able to log in back to his/her account!.</label>
        <input type="submit" name="unban" id="unban" class="btn btn-info" value="Confirm"/>
       </div>
   		</form>
      </div>
    </div></center>
  </div>

