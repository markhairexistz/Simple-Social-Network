<?php session_start();
include '../connect.php';
include '../head.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="500" border="1" align="center">
    <tr>
      <th height="30" colspan="3" bgcolor="#00FFFF" scope="col">User View</th>
    </tr>
   
    <tr>
      <th width="82" height="30" scope="col">No.</th>
      <th width="216" scope="col">Name of User</th>
      <th width="180" scope="col">Action</th>
    </tr>
    
  <?php $i=1;
$result = mysql_query("Select * from user where Status='Pending' order by First_name asc");
  while($rs = mysql_fetch_array($result)){
  ?>  
    <tr>
      <th height="30"><?php echo $i;?></th>
      <th height="30"><?php echo $rs['First_name'].' '.$rs['Last_name'];?></th>
      <th height="30">
<a href="viewUser.php?app=<?php echo $rs['User_id'];?>">
Approve</a> 
| 
<a href="viewUser.php?dis=<?php echo $rs['User_id']; ?>"> Disapprove</a>
</th>
    </tr>
    
  <?php $i++; } ?>  
    
  </table>
</form>
</body>
</html>

<?php include '../footer.php';?>



<?php 
//Code for Approve user
if($_GET['app']!=""){

mysql_query("Update user set Status='Approved' 
where User_id='".$_GET['app']."'");

echo '<script language="javascript">;
alert("User Successfully Approved");
location.href="viewUser.php";
</script>'; 

	}

//Code for Dispprove user
if($_GET['dis']!=""){

mysql_query("Update user set Status='Disapproved' 
where User_id='".$_GET['dis']."'");

echo '<script language="javascript">;
alert("User Successfully Disapproved");
location.href="viewUser.php";
</script>'; 

	}



?>


