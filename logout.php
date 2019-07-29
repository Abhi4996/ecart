<?php
include 'includes/sessionStart.php';
unset($_SESSION["user"]);
header("Location: login.php");
?>