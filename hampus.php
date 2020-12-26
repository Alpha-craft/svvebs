<?php
include "koneksi.php";
$id = $_GET["id"];
$sql = "DELETE FROM waipu WHERE id = '$id' ";
$query = mysqli_query($conn,$sql);
$delfile = mysqli_query($conn,"SELECT file FROM waipu WHERE id= '$id' ");
$del = mysqli_fetch_assoc($delfile);
unlink("pict/".$del["file"]);

header("Location:delete.php");
?>