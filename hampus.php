<?php
include "koneksi.php";
$id = $_GET["id"];
$query = mysqli_query($conn,$sql);
$delfile = mysqli_query($conn,"SELECT file FROM waipu WHERE id= '$id' ");
$del = mysqli_fetch_assoc($delfile);
unlink("pict/".$del["file"]);

$sql = "DELETE FROM waipu WHERE id = '$id' ";
header("Location:delete.php");
?>