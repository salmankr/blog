<?php
session_start();
header('location: signIn.php');
session_destroy();
?>