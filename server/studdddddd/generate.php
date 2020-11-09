<?php 
session_start();
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
  <table width="500" border="0" align="center">
    <tr>
      <th height="40" scope="col">Generate Report</th>
    </tr>
    <tr>
      <td height="40">Please Select Year: 
        <select name="selectyear" id="selectyear">
          <option>-Please Select-</option>
<option value="2019"<?php if($_POST['selectyear']=="2019"){ echo 'Selected';} ?>>2019</option>
<option value="2018"<?php if($_POST['selectyear']=="2018"){ echo 'Selected';} ?>>2018</option>
<option value="2017"<?php if($_POST['selectyear']=="2017"){ echo 'Selected';} ?>>2017</option>
      </select></td>
    </tr>    <tr>
      <td height="40">Please Select Month: 
        <select name="selectmonth" id="selectmonth">
          <option>-Please Select-</option>
<option value="January"<?php if($_POST['selectmonth']=="January"){ echo 'Selected';} ?>>January</option>
<option value="February"<?php if($_POST['selectmonth']=="February"){ echo 'Selected';} ?>>February</option>
<option value="March"<?php if($_POST['selectmonth']=="March"){ echo 'Selected';} ?>>March</option>
<option value="April"<?php if($_POST['selectmonth']=="April"){ echo 'Selected';} ?>>April</option>
      </select></td>
    </tr>
    <tr>
      <td height="40"><input type="submit" name="Select" id="Select" value="Select" /></td>
    </tr>
    <tr>
      <td height="40">
      <?php if($_POST['Select']=="Select"){?>
<a target="_blank" href="reportPDF.php?getyear=<?php echo $_POST['selectyear'];?>&getmonth=<?php echo $_POST['selectmonth'];?>">
      Print Preview</a>
      <?php }?>
      </td>
    </tr>
  </table>
</form>
<?php include '../footer.php';?>
</body>
</html>