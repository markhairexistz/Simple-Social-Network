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
<?php
if(empty($_SESSION)) // if the session not yet started 
   session_start();

if(!isset($_SESSION['getuser'])) { //if not yet logged in
   header("Location:index.php");// send to login page
   exit;
} 
?>
<body style = "background-image:url(img/web-development-banner2.jpg); background-attachment:fixed; background-size:cover;>

<?php 
include 'connection.php'; 
?>
<?php
session_start();
$mysql = mysql_query("Select * from user where id='".$_SESSION['id']."'");
$data= mysql_fetch_array($mysql);
?>



<?php


if(isset($_POST['upload'])){
	
	if(getimagesize($_FILES['image']['tmp_name'])==TRUE){
		if($_POST['txtrepass']==$_POST['txtpassword']){

	

		$image = addslashes($_FILES['image']['tmp_name']);
		$name = addslashes($_FILES['image']['name']);
		$image = file_get_contents($image);
		$image = base64_encode($image);

		$qry = mysql_query("UPDATE user set 
			img = '".$image."',
			fname='".$_POST['txtfname']."',
			lname='".$_POST['txtlname']."',
			nname='".$_POST['txtnname']."',
			contact='".$_POST['txtcellnum']."',
			email='".$_POST['txtemail']."',
			username='".$_POST['txtusername']."',
			password='".base64_encode($_POST['txtpassword'])."'
			 where id = '".$_SESSION['id']."'");

session_start();

		echo '<script language="javascript"> 
			alert("Profile Updated!");
			location.href="user_view.php";
			</script>';
		}else{
			$errpass='Retype password incorrect';
		}

	}else if(getimagesize($_FILES['image']['tmp_name'])==FALSE){
		
if($_POST['txtrepass']==$_POST['txtpassword']){ 

	

		$qry = mysql_query("UPDATE user set 
			
			fname='".$_POST['txtfname']."',
			lname='".$_POST['txtlname']."',
			nname='".$_POST['txtnname']."',
			contact='".$_POST['txtcellnum']."',
			email='".$_POST['txtemail']."',
			username='".$_POST['txtusername']."',
			password='".base64_encode($_POST['txtpassword'])."'
			 where id = '".$_SESSION['id']."'");
session_start();
	
		echo '<script language="javascript"> 
			alert("Profile Updated!");
			location.href="user_view.php";
			</script>';
	}
	else{

		$errpass='Retype password incorrect';
	
		
	}
}
}
	


 ?>


  <!-- Start your project here-->
  
  	<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">

	<button class="navbar-toggler" data-toggle="collapse" data-target="#collapse_target">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="collapse_target">
		<span class="navbar-text">SCC Community</span>
			<ul class="navbar-nav">

        <li CLass="nav-item">
          <a class="nav-link" href = "user_view.php">Home</a>
        </li>
        <li CLass="nav-item">
          <a class="nav-link" href = "user_profile.php">Profile</a>
        </li>
        		
				
				<li CLass="nav-item">
					<a class="nav-link" href = "logout.php">Log out</a>
				</li>

        
			</ul>
	</div>
</nav>


<div class="container-responsive" style="">
	<div class="row">
	<!--SIDE BAR-->
	<div class="col-md-3">
	<div class="container" style=" background-color:#e4e3e3;width:300px; height:700px; margin-top:60px; margin-left:15px; border-radius:5px;">
	<form id="sidebar" name="sidebar" method="post" enctype = "multipart/form-data" action="">
		<label class="label control-label" style=" position:absolute;"><?php echo $imgresult;?></label>
		<a href="user_update.php?x=<?php echo $data['id']?>/updatedata">
		<?php 
		
		echo '		
		<img src="data:image;base64,'.$data[0].'" class="img-responsive img-thumbnail" style="height:110px; width:125px;margin-top:-40px;margin-left:5px;">';
	

			?>
		</a>
		<label class="label control-label" style="color:black; position:absolute;margin-top: 10px; margin-left:10px;"><?php echo $data['nname'];?></label>
		

		<label class="label control-label" style="color:black; position:absolute;margin-top: 40px; margin-left:10px;"><?php echo $data['fname'];?> <?php echo $data['lname'];?></label>

		

		<input type="file" name="image" style="margin-top:px; width:px; margin-left:20px;">
		
		<label class="label control-label" style="color:black; position:;margin-top: 0px; margin-left: 0px;">Firstname</label>
		<input type="text" class="form-control" name="txtfname" maxlength="12" value="<?php echo $data['fname']?>" required="required">
		<label class="label control-label" style="color:black; position:;margin-top: 0px; margin-left: 0px;">Lastname</label>
		<input type="text" class="form-control" name="txtlname" maxlength="12" value="<?php echo $data['lname']?>" required="required">
		<label class="label control-label" style="color:black; position:;margin-top: 0px; margin-left: 0px;">Nickname</label>
		<input type="text" class="form-control" name="txtnname" maxlength="12"  value="<?php echo $data['nname']?>" required="required">
		<label class="label control-label" style="color:black; position:;margin-top: 0px; margin-left: 0px;">Contact #</label>
		<input type="number" class="form-control" name="txtcellnum" value="<?php echo $data['contact']?>" required="required">
		<label class="label control-label" style="color:black; position:;margin-top: 0px; margin-left: 0px;">E-mail</label>
		<input type="text" class="form-control" name="txtemail"  value="<?php echo $data['email']?>" required="reuired">
		<label class="label control-label" style="color:black; position:;margin-top: 0px; margin-left: 0px;">Username</label>
		<input type="text" class="form-control" name="txtusername"  value="<?php echo $data['username']?>" required="required">
		<label class="label control-label" style="color:black; position:;margin-top: 0px; margin-left: 0px;">Password</label>
		<input type="password" class="form-control" name="txtpassword"  value="<?php echo base64_decode($data['password'])?>" required="required">
		<label class="label control-label" style="color:black; position:;margin-top: 0px; margin-left: 0px;">Retype-password <font color="red"><?php echo $errpass;?></font></label>
		<input type="password" class="form-control" name="txtrepass"placeholder="Retype your password" required="required">
<center>
		<input type="submit" name="upload" value="save" class= "btn btn-success"/> 
		<input type="submit" name="cancel" value="cancel" class= "btn btn-warning"/>
</center>
 	</form>  	
 	</div>
	</div>
	<!--SIDEBAR-->

	<div class="col-md-6" style="margin-top:60px;">

		<?php
	$selectfollower=mysql_query("SELECT * FROM follow WHERE follow_by = '".$_SESSION['id']."' ") ;
	$follow= mysql_fetch_array($selectfollower)

	


	

?>

	
	<?php 

	$selectpost=mysql_query("SELECT * FROM post JOIN user ON user.id=post.user_id  WHERE post.user_id = '".$data['id']."' ORDER BY post.date_posted ASC") ;

		while($viewpost= mysql_fetch_array($selectpost)){ ?>


<?php 
$com_num = mysql_query("SELECT COUNT(*) as totalcomment FROM comments join post on post.post_id=comments.post_id WHERE post.user_id = '".$data['id']."'");
$com_num_result = mysql_fetch_assoc($com_num);

		?>

	<form id="viewhome" name="viewhome" method="post" enctype = "multipart/form-data" action="">

 	<div class="col-md-12 container-responsive " style="background-color:#e4e3e3;border-radius:5px; margin-top:0px;">
 		<a href="delete_confirm.php?x=<?php echo $viewpost['post_id'];?>/del_post">
 		<button type="button" class="close">&times;</button> 
 	</a>
		<?php echo '		
		<img src="data:image;base64,'.$viewpost['img'].'" class="img-responsive img-thumbnail" style="height:70px; width:80px;margin-left:5px; margin-top:-40px;">'?>
		<label class="label control-label" style="color:black; margin-top: 10px; margin-left:10px;"><?php echo $viewpost['nname'];?></label>
		<label class="label control-label" style="color:black; float:right; margin-top:10px;">Posted on <?php echo $viewpost['date_posted']?></label><br/>
		<label class="label control-label" style="color:black; "><?php echo $viewpost['title']?></label><br/>
		<label class="label control-label" style="font-size:12px; color:black;"><?php echo $viewpost['description']?></label>
          <?php echo '		
		<img src="data:image;base64,'.$viewpost['img_posted'].'" class="img-responsive img-thumbnail" style="height:300px; width:630px;margin-left:5px; margin-top:0px;">'?>
	<a href="user_comment.php?x=<?php echo $viewpost['post_id'];?>/com_post">
		<label class="label control-label" style = "color:black;">Comment (<?php echo $com_num_result['totalcomment']; ?>)</label>
	</a>
	</div>	
	
</form>

		<br/>
		<br/>
       <?php } ?> 
	

	</div>
	
<?php 
if (isset($_POST['search'])){
$viewusers = mysql_query("SELECT * FROM user  WHERE nname LIKE '%".$_POST['txtuser']."%' and id !='".$_SESSION['id']."'");
$viewusernum = mysql_query("SELECT COUNT(*) as totalfollowed FROM user  WHERE nname LIKE '%".$_POST['txtuser']."%' and id !='".$_SESSION['id']."'");
$label='Result/s:';
$usernum= mysql_fetch_assoc($viewusernum);
}else{
	$viewusers = mysql_query("SELECT * FROM follow join user on user.id=follow.user_id WHERE follow_by = '".$_SESSION['id']."'");
	$viewusernum = mysql_query("SELECT COUNT(*) as totalfollowed FROM follow join user on user.id=follow.user_id WHERE follow_by = '".$_SESSION['id']."'");
	$label='People Youve Followed:';
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
		<a href="view_profile.php?x=<?php echo $users['id'];?>/view_profile">
		<?php echo '		
		<img src="data:image;base64,'.$users['img'].'" class="img-responsive img-thumbnail" style="height:70px; width:80px;margin-top:10px;margin-left:-10px;">'?></a>
		<label class="label control-label" style="color:black; position:absolute; margin-top:30px; margin-left:5px;"><?php echo $users['nname'];?></label><br/>
		
		<a href="view_profile.php?x=<?php echo $users['id'];?>/view_profile">
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

<div id="Modal" class="modal" role="dialog">
    <div class="modaldialog float-left" >
      <div class="modal-content">
        <div class="modal-header">
        	<h4 class="modal-title" style="position:absolute; margin-left:190px	;">Profile</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>

        <form id="sidebar" name="sidebar" method="post" enctype = "multipart/form-data" action="">
       <div class="modal-body">
		<?php echo '
		<img src="data:image;base64,'.$data[0].'" class="img-responsive img-thumbnail" data-toggle="modal" data-target="#Modal" style="height:110px; width:125px;margin-top:-40px;margin-left:5px;">'?>
		<label class="label control-label" style=" position:absolute;margin-top: 10px; margin-left:10px;"><?php echo $data['nname'];?></label>
		

		<label class="label control-label" style=" position:absolute;margin-top: 30px; margin-left:10px;"><?php echo $data['fname'];?></label>

		<label class="label control-label" style=" position:absolute;margin-top: 50px; margin-left: 10px;"><?php echo $data['lname'];?></label>
       </div>
   		</form>
      </div>
    </div>
  </div>
