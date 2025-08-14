<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location: http://localhost/railway/admin_login.php");
exit();
?>
