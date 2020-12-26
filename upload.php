<?php
include "koneksi.php";

if (isset($_POST['submit'])){
    $nama = $_POST["nama"];
    $nama_file = $_FILES["file"]["name"];
    $tipe_file = $_FILES["file"]["type"];
    $ukuran_file = $_FILES["file"]["size"];
    $tmp_name = $_FILES["file"]["tmp_name"];
    $emror = $_FILES["file"]["error"];


    $ekstensi = ["jpg","jpeg","gif","png"];
    $ekstensigambar = explode(".",$nama_file);
    $ekstensigambar = strtolower( end($ekstensigambar));
    if (!in_array($ekstensigambar,$ekstensi)){
        echo "Yang anda Upload Bukan gambar";
        return false;
    }

    //setelah gambar sudah dicek maka tinggal upload
    move_uploaded_file($tmp_name,"pict/".$nama_file);
    $query = "INSERT INTO waipu VALUES (null,'$nama','$nama_file')";
    mysqli_query($conn,$query);
    $tukang_cek = mysqli_affected_rows($conn);
    if ($tukang_cek > 0){
        echo "<script>alert('Data berhasil Dimasukkan');</script>";
        sleep(3);
        header("Location:index.php");
    }
    else{
        echo "Gamgal/emror";
        echo "<br>";
        echo mysqli_error($conn);
    }

     


}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Upload</title>
</head>

<body>

    <form action="" method="post" enctype="multipart/form-data">
        <label for="nama">Nama Character:</label>
        <input type="text" name="nama" id="nama">
        <div class="clear"></div>
        <label for="gambar">Pilih Foto</label>
        <input type="file" name="file" id="gambar">
        <div class="clear"></div>
        <button type="submit" name="submit">Upload!</button>
    </form>

    <!-- <?= var_dump($_POST) ?>
    <?= var_dump($_FILES) ?> -->
</body>

</html>