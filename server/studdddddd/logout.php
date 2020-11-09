<?php
session_start();
$_SESSION['log']=false;
session_destroy();
header("Location: index.php");
 ?>