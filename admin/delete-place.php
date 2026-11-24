<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

require_once '../config.php';

if (!isset($_GET['id'])) {
    header("Location: manage-places.php");
    exit();
}

$id = intval($_GET['id']);

$sql = "DELETE FROM places WHERE id = $id";

mysqli_query($conn, $sql);

header("Location: manage-places.php");
exit();
?>
