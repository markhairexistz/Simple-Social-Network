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
   header("Location:index.php");// send to login page
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

<?php 
include 'connection.php'; ?>
<?php
session_start();
$mysql = mysql_query("Select * from user where id='".$_SESSION['id']."'");
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
	$getx = explode("/",$_GET['x']);
	$mysql=mysql_query("SELECT * FROM post JOIN user ON user.id=post.user_id WHERE post.post_id = '".$getx[0]."'") ;
	$post= mysql_fetch_array($mysql);

	if(isset($_POST['comment'])){
	

	mysql_query("INSERT INTO comments(post_id,user_id,com_detail,date_com) 
	values('".$post['post_id']."',
			'".$data['id']."',
			'".$_POST['txtcomment']."',
			'".date('F d, Y')."')");
			
	echo '<script language="javascript"> 
			location.href="";
			</script>';
	
				}
		


?>
<?php
	
	?>

  <!-- Start your project here-->

<div class="container-responsive" style="">
	<div class="row">
	<!--SIDE BAR-->
	<div class="col-md-3">
	<div class="col-md-12 container " style="background-color:#e4e3e3; border-radius:5px; height:120px; margin-top:60px;">
	<form id="sidebar" name="sidebar" method="post" enctype = "multipart/form-data" action="">
		<a href="user_update.php?x=<?php echo $data['id']?>/updatedata">
		<?php echo '		
		<img src="data:image;base64,'.$data[0].'" class="img-responsive img-thumbnail" style="height:110px; width:125px;margin-top:-40px;margin-left:5px;">'?></a>
		<label class="label control-label" style="color:black; margin-top: 10px; margin-left:10px;"><?php echo $data['nname'];?></label><br/>

		<label class="label control-label" style="color:black;margin-top: 5px; margin-left:10px;"><?php echo $data['fname'];?></label>

		<label class="label control-label" style="color:black;margin-top: 5px; margin-left: 10px;"><?php echo $data['lname'];?></label>

		
 	</form>  	
 	</div>
	</div>
	<!--SIDEBAR-->

	<div class="col-md-6" style="margin-top:40px;">
		
		
<form id="viewpost" name="viewpost" method="post" enctype = "multipart/form-data" action="">
 	<div class="col-md-12 container-responsive " style=" background-color:#e4e3e3; border-radius:5px; margin-top:20px;">
		<?php echo '		
		<img src="data:image;base64,'.$post['img'].'" class="img-responsive img-thumbnail" style="height:70px; width:80px;margin-left:5px; margin-top:-40px;">'?>
		<label class="label control-label" style="color:black; margin-top: 10px; margin-left:10px;"><?php echo $post['nname'];?></label>
		<label class="label control-label" style="color:black; float:right; margin-top:10px;">Posted on <?php echo $post['date_posted']?></label><br/>
		<label class="label control-label" style="color:black; "><?php echo $post['title']?></label><br/>
		<label class="label control-label" style="font-size:12px; color:black;"><?php echo $post['description']?></label>
          <?php echo '		
		<img src="data:image;base64,'.$post[2].'" class="img-responsive img-thumbnail" style="height:300px; width:630px;margin-left:5px; margin-top:0px;">'?>
	</div>	
</form>
		
		
   

<!--FORM FOR COMMENT INPUT-->
   <form id="viewcomment" name="viewcomment" method="post" enctype = "multipart/form-data" action="">
 	<div class="col-md-12 container-responsive" style="background-color:#e4e3e3;border-radius:5px; margin-top:20px; height:170px;">
		<?php echo '		
		<img src="data:image;base64,'.$data[0].'" class="img-responsive img-thumbnail" style="height:50px; width:60px;margin-left:5px; margin-top:10px;">'?>
		<label class="label control-label" style="color:black; margin-top: 10px; margin-left:10px;"><?php echo $data['nname'];?></label>
		<textarea minlength="0" name="txtcomment" class="form-control" placeholder="Comment this post..." required="required" style="margin-top:5px;"></textarea>
		<input type="submit" name="comment" id="post" class="btn-sm btn-primary" value = "Comment" style="margin-top:5px;"/>
		<input type="submit" name="cancel" id="can_cel" class="btn-sm btn-warning" value = "cancel"/>
		
	</div>	
</form>
<br/>

<?php 

$selectcomment=mysql_query("SELECT * FROM comments INNER JOIN post ON post.post_id = comments.post_id JOIN user ON user.id = comments.user_id WHERE comments.post_id = '".$getx[0]."'") ;

while($com= mysql_fetch_array($selectcomment)){?>

<!-- FORM FOR COMMENT DEtail-->
<form id="viewcomdetail" name="viewcomdetail" method="post" enctype = "multipart/form-data" action="">
<div class="col-md-12 container-responsive bg-white" style="border-radius:5px; margin-top:20px;">
	<a href="view_profile.php?x=<?php echo $com['id'];?>/view_profile">
		<?php echo '		
		<img src="data:image;base64,'.$com['img'].'" class="img-responsive img-thumbnail" style="height:50px; width:60px;margin-left:5px; margin-top:-40px;">'?>
		<label class="label control-label" style="color:black; margin-top: 10px; margin-left:10px;"><?php echo $com['nname'];?></label>
	</a>
		<label class="label control-label" style="color:black; float:right; margin-top:10px;">Commented on <?php echo $com['date_com']?></label><br/>
	<div class="container-responsive" style="background-color:#e4e3e3;">
		<label class="label control-label" style="color:black; margin-top: 10px; margin-left:10px;"><?php echo $com['com_detail'];?></label>
	</div><br/>

</div>
</form>
	<?php }?>
	<br/>
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
<form id="posting" name="posting" method="post" enctype = "multipart/form-data" action="">
 <div id="postmodal" class="modal" role="dialog">
    <div class="modaldialog float-left" >
      <div class="modal-content">
        <div class="modal-header bg-primary">
		<?php echo '		
		<img src="data:image;base64,'.$data[0].'" class="img-responsive img-thumbnail" style="height:110px; width:125px;margin-left:5px;">'?>
		<label class="label control-label" style="color:white; margin-top: 10px; margin-left:10px;"><?php echo $data['nname'];?>!</label>
		<label class="label control-label" style="color:white; margin-top: 10px; margin-left:10px;">Would you like to share something?</label>
          <button type="button" class="close" data-dismiss="modal">&times;</button> 
        </div>

       <div class="modal-body">
       	<br/>
       <input type="file" name="postimage" style="position:absolute;margin-top:-40px; width:px;"><br/><br/>
	
		<input type="text" class="form-control" name="txttitle"  value="" required="required" placeholder="Caption here..."style="margin-top:-30px">

		<br/>
		<textarea name="txtdescription" class="form-control" placeholder="Description of your post..." required="required" ></textarea>
		<center><input type="submit" name="post" id="post" class="btn btn-info" value = "Post"/>
		<input type="submit" name="cancel" id="can_cel" class="btn btn-warning" value = "cancel"/></center>
		</div>
      </div>
    </div>
  </div>
</form>