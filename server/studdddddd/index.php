<?php session_start();
include '../connect.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body>
<form id="form1" name="form1" method="post" action="">
<br /><br /><br /><br /><br />
<table width="300" border="1" align="center">
  <tr>
    <th height="30" colspan="2" bgcolor="#00FFFF" scope="col">Admin Login</th>
    </tr>
  <tr>
    <td width="103" height="30">&nbsp;</td>
    <td width="181" height="30">&nbsp;</td>
  </tr>
  <tr>
    <td height="30" align="right">Username:</td>
    <td height="30"><input type="text" name="txtusername" id="txtusername" /></td>
  </tr>
  <tr>
    <td height="30" align="right">Password:</td>
    <td height="30"><input type="password" name="txtpassword" id="txtpassword" /></td>
  </tr>
  <tr>
    <td height="30">&nbsp;</td>
    <td height="30"><input type="submit" name="button" id="button" value="Login" /></td>
  </tr>
  <tr>
    <td height="30" colspan="2" bgcolor="#00FFFF">&nbsp;</td>
    </tr>
</table>
</form>
</body>
</html>


<?php 
// code login for admin - index.php
if($_POST['button']=="Login"){

$result = mysql_query("Select * from admin where Username='".$_POST['txtusername']."' and Password='".$_POST['txtpassword']."'");
$rs = mysql_fetch_array($result);
 if(mysql_num_rows($result)>=1){
	$_SESSION['log']=true;
	$_SESSION['var_username']=$rs['Username'];
	echo '<script language="javascript">;
	alert("Login Success!");
	location.href="viewUser.php";
	</script>'; 
}else{	
	echo '<script language="javascript">;
	alert("Invalid Login!");
	</script>';  	
 }     
}
?>