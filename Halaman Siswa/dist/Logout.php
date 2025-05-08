<?php
 session_start();
 session_destroy();
 unset($_SESSION['nisnPeserta']);
 unset($_SESSION['namaPeserta']);
 unset($_SESSION['tlPeserta']);
 unset($_SESSION['status_ortu']);

 header('location:Login.php');
 exit();
?>