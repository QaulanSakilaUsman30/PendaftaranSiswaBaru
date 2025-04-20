<?php
 session_start();
 session_destroy();
 unset($_SESSION['sid_admin']);
 unset($_SESSION['snama_admin']);

 header('location:../../Login Admin/index.php');
 exit();
?>