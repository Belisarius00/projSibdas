<?php
// login/logout.php
session_start();
session_unset();
session_destroy();
// REDIRECT CHANGE: Tell the browser to go up one level to frontoffice
header("Location: ../frontoffice/index.php");
exit;
?>