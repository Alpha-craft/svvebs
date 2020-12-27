<?php
include "koneksi.php";
$sql = 'SELECT * FROM waipu ORDER BY id DESC';
$waipu = mysqli_query($conn,$sql);
// $assoc = mysqli_fetch_assoc($waipu);
// $wadah;
// foreach ($assoc as $data){
// $wadah[]["id"] = $data["id"];
// $wadah[]["nama"] = $data["nama"];
// $wadah[]["file"] = $data["file"];
// $wadah[]["caption"] = $data["caption"];

// }
$result = mysqli_fetch_assoc($waipu);
if (isset($_POST["cari"])){
    $keyword = $_POST["keyword"];
    $caption = $result["caption"];
    $waipu = mysqli_query($conn,"SELECT * FROM waipu WHERE nama LIKE '%$keyword%' OR nama LIKE '%$caption%' "); //% berarti wild card 
    //menggunakan like agar keyword lebih fleksibel dan tidak harus sama persis dengan inputan user 
}
                
if (isset($_POST['upload'])){
    $caption = $_POST["caption"];
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
    
    $nama_file = uniqid(); //agar nama file menjadi random
    $nama_file .= '.';
    $nama_file .= $ekstensigambar;
    //setelah gambar sudah dicek maka tinggal upload
    
    move_uploaded_file($tmp_name,"pict/".$nama_file);
    $query = "INSERT INTO waipu VALUES (null,'$nama','$nama_file','$caption')";
    mysqli_query($conn,$query);
    
    header("Location:index.php");
}
if (isset($_POST["upload"])){
$tukang_cek = mysqli_affected_rows($conn);
if (mysqli_affected_rows($conn) > 0){
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
        <script>
        function berhasil() {
            Swal.fire(
                'Success',
                'Gambar Berhasil di Upload',
                'success'
            )
        }
        </script>
        ";
        // sleep(3);
        // header("Location:index.php");
    }
    else{
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
          });
          </script>
        ";
        echo "<br>";
        echo mysqli_error($conn);
    }
}
// if (!isset($_POST["cari"])){
//     echo 
//     "
//     <script>
//     function hampus() {
//         let search = document.getElementById('search');
//         search.value = null;
//     }
//     </script>
//     ";
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <title>Svvebs</title>
</head>

<body>
    <ul class="nav nav-pills sticky-top">
        <!-- <li class="nav-item">
            <a class="nav-link mr-auto" data-toggle="pill" href="#cari">Search</a>
        </li> -->
        <li class="nav-item ">
            <a class="nav-link active" data-toggle="pill" href="#home">Home</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" data-toggle="pill" href="#upload">Upload</a>
        </li>
        <li class="nav-item ml-auto">
            <form class="sticky-top" action="" method="post">
                <div class="input-group mb-3 ">
                    <div class="input-group-append">
                        <button class="btn btn-danger" type="reset">clear</button>
                        <button class="btn btn-success" type="submit" name="cari">Cari</button>
                    </div>
                    <input id="search" type="text" class="form-control" autofocus placeholder="Search.." name="keyword">
                </div>
            </form>
        </li>
    </ul>


    <div class="container-fluid">
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane container active" id="home">

                <div class="card-columns ">
                    <?php foreach ($waipu as $wife) :?>
                    <div class="image">
                        <div class="card">
                            <div onload="" class="load">
                                <a href="target.php?id=<?= $wife["id"] ?>">
                                    <img id="img<?= $wife['id']?>" class="loader" src="pict/<?php echo $wife['file'] ?>"
                                        alt="<?= $wife["nama"] ?>">
                                </a>
                            </div>
                            <div class="card-body">
                                <h4 href="#demo<?= $wife["id"]?>" data-toggle="collapse" class="card-title">
                                    <?= $wife["nama"] ?> </h4>
                                <div id="demo<?= $wife["id"] ?>" class="collapse">
                                    <p class="card-text text-center"><?= $wife["caption"] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <!-- </div> -->


            </div>

            <!-- <div class="tab-pane container fade" id="cari">
                
            </div> -->

            <div class="tab-pane container fade" id="upload">
                <div class="relativ">
                    <!-- Upload -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama">Judul:</label>
                            <input type="text" class="form-control" name="nama" id="nama" required>
                            <label for="caption">Caption:</label>
                            <input type="text" class="form-control" name="caption" id="caption">
                        </div>

                        <div class="custom-file">
                            <input class="custom-file-input" type="file" name="file" id="gambar" required>
                            <label class="custom-file-label" for="gambar">Pilih Foto</label>
                        </div>
                        <div class="clear"></div>
                        <button onclick="kirim()" class="btn btn-primary" type="submit" name="upload">Upload!</button>
                        <img style="width:50%;height:auto;margin:auto;display:block;" class="img" id="img" src=""
                            accept="image/*    ">
                    </form>

                </div>
            </div>
        </div>

    </div>




    <script src=" script/script.js"></script>
</body>

</html>