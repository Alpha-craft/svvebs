<?php
session_start();
$_SESSION = []; //menimpa session dengan array kosong
session_unset();
session_destroy();

header("Location:index.php");
?>