<?php
session_destroy();
unset($_SESSION['userdata']);
header("Location:login.php");
?>