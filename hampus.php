<?php
include "koneksi.php";
$id = $_GET["id"];
$sql = "DELETE FROM waipu WHERE id = '$id' ";
$query = mysqli_query($conn,$sql);
$delfile = mysqli_query($conn,"SELECT file FROM waipu WHERE id= '$id' ");
foreach ($delfile as $del){
    unlink("pict/".$del);
}

header("Location:delete.php");
?>