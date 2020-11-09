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
<body style = "background-image:url(img/web-development-banner2.jpg); background-attachment:fixed; background-size:cover; ">
	<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">

	<button class="navbar-toggler" data-toggle="collapse" data-target="#collapse_target">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="collapse_target">
		<span class="navbar-text">SCC Community</span>
			<ul class="navbar-nav">

        <li CLass="nav-item">
          <a class="nav-link" href = "user_view.php"></a>
        </li>
        <li CLass="nav-item">
          <a class="nav-link " href = "user_profile.php"><span class="fa fa-user-circle fa-lg"></span> Profile</a>
        </li>
        <li CLass="nav-item">
          <a class="nav-link" href = "" data-toggle="modal" data-target="#postmodal"><span class="fa fa-plus-circle fa-lg"></span> Post</a>
        </li>
				
				
				<li CLass="nav-item">
					<a class="nav-link" href = "logout.php"><span class="fa fa-times-circle fa-lg"></span> Log out</a>
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

//INSERT POST

if(isset($_POST['post'])){
		$image = addslashes($_FILES['postimage']['tmp_name']);
		$name = addslashes($_FILES['postimage']['name']);
		$image = file_get_contents($image);
		$image = base64_encode($image);

	mysql_query("INSERT INTO post (title,img_posted,description,user_id,date_posted) 
	values('".$_POST['txttitle']."',
			'".$image."',
			'".$_POST['txtdescription']."',
			'".$data['id']."',
			'".date('F d, Y')."')");

//check if i already followed my account
		
	$checkmyid = mysql_query("SELECT * FROM follow  WHERE follow_by = '".$_SESSION['id']."' and user_id = '".$_SESSION['id']."'");

//if not then follow my account

	if(mysql_fetch_array($checkmyid)<=0){
	mysql_query("INSERT INTO follow (user_id,follow_by)values('".$_SESSION['id']."','".$_SESSION['id']."')");
	}else{
	$idontknow = "ihopeitworks";
	}

	echo '<script language="javascript"> 
			alert("successfully Posted!");
			location.href="user_view.php";
			</script>';
	
				
				}

	?>


  <!-- Start your project here-->

<div class="container-responsive">
	<div class="row" >
	<!--SIDE BAR-->
	<div class="col-md-3 position-fixed ">
		
	<div class="col-md-12 container" style="background-color:#e4e3e3; border-radius:5px; height:120px; margin-top:60px; margin-left:5px;">
	<form id="sidebar" name="sidebar" method="post" enctype = "multipart/form-data" action="">
		<a href="user_update.php">
		<?php if (empty( $data[0])){
			echo '<img src="img/noimage.png" class="img-responsive img-thumbnail rounded-circle" style="height:110px; width:125px;margin-top:-40px;margin-left:5px;"/>';
		}else{
		echo '		
		<img src="data:image;base64,'.$data[0].'" class="img-responsive img-thumbnail rounded-circle" style="height:110px; width:125px;margin-top:-40px;margin-left:5px;">'?><?php } ?></a>
		<label class="label control-label" style="color:black; margin-top: 10px; margin-left:10px;"><?php echo $data['nname'];?></label><br/>

		<label class="label control-label" style="color:black;margin-top: 5px; margin-left:10px;"><?php echo $data['fname'];?></label>

		<label class="label control-label" style="color:black;margin-top: 5px; margin-left: 10px;"><?php echo $data['lname'];?></label>

		
 	</form>  	
 	</div>
 </br>
 		<label class="label control-label position-fixed" style="color:white; margin-top: -15px; margin-left:5px;">People you may want to follow:</label>
 	
 	<div class=" ml-1 mt-1" style="overflow-y: scroll; height:360px;">
 	
<form id="lowersidebar" name="lowersidebar" method="post" enctype = "multipart/form-data" action="">
	<?php 

//	$filtersuggest = mysql_query("SELECT * FROM follow join user on user.id=follow.user_id WHERE follow_by = '".$_SESSION['id']."'");
//	$filterresult= mysql_fetch_array($filtersuggest)
		
	
	
	?>

	<?php
	//SELECT SUGGESTED USER WHICH YOU DID NOT FOLLOW...	
	$suggest = mysql_query("SELECT * FROM user WHERE id NOT IN (SELECT user_id FROM follow WHERE follow_by='".$_SESSION['id']."');");
	
	//$suggest = mysql_query("SELECT * FROM user join follow on follow.user_id=user.id WHERE user_id !='".$_SESSION['id']."' and follow_by !='".$_SESSION['id']."' ");
		while($showsuggest= mysql_fetch_array($suggest)){?>

 		<div class="col-md-12 container-responsive bg- ml-1 mt-2" style="background-color:#e4e3e3;border-radius:5px; height:120px; width:95%;">
 	
		<a href="view_profile.php?x=<?php echo $showsuggest['id'];?>/view_profile">
		<?php 
		if(empty($showsuggest[0])){
			echo '		
		<img src="img/noimage.png" class="img-responsive img-thumbnail rounded-circle" style="height:75px; width:80px;margin-top:15px;margin-left:5px;">';
		}else{
		echo '		
		<img src="data:image;base64,'.$showsuggest[0].'" class="img-responsive img-thumbnail rounded-circle" style="height:75px; width:80px;margin-top:15px;margin-left:5px;">'?><?php }?></a>
		<label class="label control-label" style="color:black; margin-top: 2px; margin-left:10px;"><?php echo $showsuggest['nname'];?></label><br/>

		<label class="label control-label" style="color:black;margin-top: 2px; margin-left:10px;"><?php echo $showsuggest['fname'];?></label>

		<label class="label control-label" style="color:black;margin-top: 2px; margin-left: 10px;"><?php echo $showsuggest['lname'];?></label>

		
 
 	</div>
 <?php }?>

 </form>
	</div>
</div>
	<!--SIDEBAR-->

	<div class="col-md-6" style="margin-top:60px; margin-left:335px;">

		<?php
	$selectfollower=mysql_query("SELECT * FROM follow WHERE follow_by = '".$_SESSION['id']."'") ;
	$follow= mysql_fetch_array($selectfollower)
	
?>
	<?php 

	$selectpost=mysql_query("SELECT * FROM post INNER JOIN follow ON follow.user_id = post.user_id JOIN user ON user.id = follow.user_id WHERE follow.follow_by = '".$follow['follow_by']."'  ORDER BY post.date_posted DESC") ;
	if($viewpost= mysql_fetch_array($selectpost)<=0){
		echo '<h1 class="text-white text-center mt-5">No Post....</h1>';
		}else{
	while($viewpost= mysql_fetch_array($selectpost)){ 

			?>


	<form id="viewhome" name="viewhome" method="post" enctype = "multipart/form-data" action="">

 	<div class="col-md-12 container-responsive " style="background-color:#e4e3e3;border-radius:05px; margin-top:0px;">
 		<a href="view_profile.php?x=<?php echo $viewpost['id'];?>/view_profile">
		<?php if (empty( $viewpost['img'])){
			echo '<img src="img/noimage.png" class="img-responsive img-thumbnail rounded-circle" style="height:110px; width:125px;margin-top:-40px;margin-left:5px;"/>';
		}else{
		echo '		
		<img src="data:image;base64,'.$viewpost['img'].'" class="img-responsive img-thumbnail rounded-circle" style="height:110px; width:125px;margin-top:-40px;margin-left:5px;">'?><?php } ?>
		<label class="label control-label" style="color:black; margin-top: 10px; margin-left:10px;"><?php echo $viewpost['nname'];?></label>
		</a>
		<label class="label control-label" style="color:black; float:right; margin-top:10px;">Posted on <?php echo $viewpost['date_posted']?></label><br/>
		<label class="label control-label" style="color:black; "><?php echo $viewpost['title']?></label><br/>
		<label class="label control-label" style="font-size:12px; color:black;"><?php echo $viewpost['description']?></label>
          <?php echo '		
		<img src="data:image;base64,'.$viewpost['img_posted'].'" class="img-responsive img-thumbnail" style="height:300px; width:630px;margin-left:5px; margin-top:0px;">'?>

		<?php 
$com_num = mysql_query("SELECT COUNT(*) as totalcomment FROM comments WHERE post_id = '".$viewpost['post_id']."'");
$com_num_result = mysql_fetch_assoc($com_num);

		?>
	<a href="user_comment.php?x=<?php echo $viewpost['post_id'];?>/com_post">
		<label class="label control-label" style = "color:black;">Comment (<?php echo $com_num_result['totalcomment']; ?>)</label>
	</a>
	</div>	
	
</form>

		<br/>
		<br/>
       <?php }} ?> 
	

	</div>
	

<?php 
if (isset($_POST['search'])){
$viewusers = mysql_query("SELECT * FROM user  WHERE nname LIKE '%".$_POST['txtuser']."%' and id !='".$_SESSION['id']."'");
$viewusernum = mysql_query("SELECT COUNT(*) as totalfollowed FROM user  WHERE nname LIKE '%".$_POST['txtuser']."%' and id !='".$_SESSION['id']."'");
$label='Result(s):';
$usernum= mysql_fetch_assoc($viewusernum);
}else{

$viewusers = mysql_query("SELECT * FROM follow join user on user.id=follow.user_id WHERE follow_by = '".$_SESSION['id']."'");
	
	//SO ITS NOT GONNA APPEAR -1 IN THE NUMBER OF FOLLOWED IF I HAVENT FOLLOWED ANYONE
	if(mysql_fetch_array($viewusers)>0){
	$viewusers = mysql_query("SELECT * FROM follow join user on user.id=follow.user_id WHERE follow_by = '".$_SESSION['id']."' and user_id != '".$_SESSION['id']."' ");

	$viewusernum = mysql_query("SELECT COUNT(*)-1 as totalfollowed FROM follow join user on user.id=follow.user_id WHERE follow_by = '".$_SESSION['id']."'");
	
	$label='People Youve Followed:';
	$usernum= mysql_fetch_assoc($viewusernum);
	}else{
	$viewusers = mysql_query("SELECT * FROM follow join user on user.id=follow.user_id WHERE follow_by = '".$_SESSION['id']."'");

	$viewusernum = mysql_query("SELECT COUNT(*) as totalfollowed FROM follow join user on user.id=follow.user_id WHERE follow_by = '".$_SESSION['id']."'");
	
	$label='People Youve Followed:';
	$usernum= mysql_fetch_assoc($viewusernum);

	}
}
?>
		
	<div class="col-md-3 position-fixed" style="height:82%; margin-top:50px; margin-left: 1020px; ">

<form id="ss" name="ss" method="post" enctype = "multipart/form-data" action="">

		<input type="text" class="form-control position-fixed" name="txtuser" placeholder="Search User" required="required"   style="width:240px; margin-left:-5px; margin-top:-10px;">
		<button type="submit" name="search" id="search" class="btn-sm btn-success position-fixed" style="position:absolute; margin-top:-10px; margin-left:240px;"> <span class= "fa fa-search"></span> Search</button></br>
	</br>		
	<label class="label control-label position-fixed" style="color:white; position:absolute; margin-top:-20px; margin-left:5px;"><?php echo $label;?> <font style="font-size: 24px;"color="white">(<?php echo $usernum['totalfollowed'];?>)</font></label>
	</form>

<div class="col-md-12 position-fixed container" style="overflow-y: scroll; width:300px; height:70%; margin-top:10px;">
		<?php while($users= mysql_fetch_array($viewusers)){ ?>
		<div class="col-md-12 container" style="background-color:#e4e3e3; border-radius:5px; height:110px; margin-top:10px; margin-left:-5px;">
		<form id="rightsidebar" name="rightsidebar" method="post" enctype = "multipart/form-data" action="">
		<a href="view_profile.php?x=<?php echo $users['id'];?>/view_profile">
		<?php
		if(empty($users['img'])){
			echo '	<img src="img/noimage.png" class="img-responsive img-thumbnail rounded-circle" style="height:70px; width:80px;margin-top:10px;margin-left:-10px;">';
		}else{
		 echo '	<img src="data:image;base64,'.$users['img'].'" class="img-responsive img-thumbnail rounded-circle" style="height:70px; width:80px;margin-top:10px;margin-left:-10px;">'?><?php }?></a>
		<label class="label control-label" style="color:black; position:absolute; margin-top:30px; margin-left:5px;"><?php echo $users['nname'];?></label><br/>
		
		<a href="view_profile.php?x=<?php echo $users['id'];?>/view_profile">
		<label class="label control-label" style="font-size:12px; margin-left: 5px; margin-top:10px;">VIEW PROFILE</label>
		</a>
 	 </form>
 	 </div>
 	<?php }?>
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
<form id="posting" name="posting" method="post" enctype = "multipart/form-data" action="">
 <div id="postmodal" class="modal" role="dialog">
 	<center>
    <div class="modaldialog" style="width:500px;">
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
       <input type="file" name="postimage" style="position:absolute;margin-top:-30px; margin-left:-230px;" required="required"><br/><br/>
	
		<input maxlength="50" type="text" class="form-control" name="txttitle"  value="" required="required" placeholder="Caption here..."style="margin-top:-30px">

		<br/>
		<textarea maxlength="50" name="txtdescription" class="form-control" placeholder="Description of your post..." required="required" ></textarea>
		<center><input type="submit" name="post" id="post" class="btn btn-info" value = "Post"/>
		</center>
		</div>
      </div>
    </div></center>
  </div>
</form>