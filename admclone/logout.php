<?php
session_destroy();
unset($_SESSION['admindata']);
header("Location:../login.php");
?>