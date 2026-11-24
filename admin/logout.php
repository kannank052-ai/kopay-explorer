<?php
session_start();

$_SESSION = [];

session_unset();
session_destroy();

header("Location: /kopay%20explorer/admin/login.php");
exit();
?>