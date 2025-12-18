<?php
session_start();
session_unset();
session_destroy();

// Arahkan kembali ke halaman login (sesuaikan dengan nama file login Anda)
header("Location: login.php"); 
exit();
?>