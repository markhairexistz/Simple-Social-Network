<?php
session_start();
unset($_SESSION['getuser']);
session_destroy();

header("Location: index2.php");
exit;
?>