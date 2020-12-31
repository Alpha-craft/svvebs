<?php
session_start();
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
    
    if (!isset($_SESSION["login"])){ //cek sudah login atau belum
        
        header("Location:login.php");
        exit;

    }
    

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
    $tukang_cek = mysqli_affected_rows($conn);
    if (mysqli_affected_rows($conn) > 0){
        echo "
        <script>
        
        Swal.fire(
            'Success',
            'Gambar Berhasil di Upload',
            'success'
            )
            
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
        echo mysqli_error($conn);
    }

    sleep(2);
    header("Location:index.php");
}
// if (isset($_POST["upload"])){

// }
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
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script> -->
    <link rel="stylesheet" href="https://unpkg.com/progressively/dist/progressively.min.css">
    <script src="https://unpkg.com/progressively/dist/progressively.min.js"></script>

    <title>Svvebs</title>
</head>

<body>
    <ul class="nav nav-pills sticky-top">
        <!-- <li class="nav-item">
            <a class="nav-link mr-auto" data-toggle="pill" href="#cari">Search</a>
        </li> -->
        <li class="nav-item ">
            <a class="nav-link active" data-toggle="pill" href="#home">Home <i class="las la-home"></i></a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" data-toggle="pill" href="#upload">Upload <i class="las la-upload"></i></a>
        </li>
        <!-- <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#login">login<i class="las la-user"></i></a>
        </li> -->
        <li class="nav-item ml-auto">
            <form class="sticky-top" action="" method="post">
                <div class="input-group mb-3 ">
                    <input id="search" type="text" class="form-control" autofocus placeholder="Search.." name="keyword">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit" name="cari"><i class="las la-search"></i></button>
                        <button class="btn btn-danger" type="reset"><i class="las la-times"></i></button>
                    </div>
                </div>
            </form>
        </li>
        <li class="nav-item">
            <div onclick="" class="custom-control custom-switch">
                <input type="checkbox" onclick="myFunction()" class="custom-control-input" id="switch1">
                <label class="custom-control-label" for="switch1"></label>
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

                            <a href="target.php?id=<?= $wife["id"] ?>">
                                <!-- http://localhost/test/project/svvebs/ -->
                                <figure class="progressive">
                                    <img id="img<?= $wife['id']?>" class="progressive__img progressive--not-loaded"
                                        data-progressive="pict/<?php echo $wife['file'] ?>"
                                        data-progressive-sm="pict/<?php echo $wife['file'] ?>"
                                        src="pict/<?php echo $wife['file'] ?>" alt="<?= $wife["nama"] ?>">
                                </figure>
                            </a>
                            <div class="card-body ">
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


            </div>


            <!-- <div class="tab-pane container fade" id="login">
                login
                <form>
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
                        </div>
                        <div class="col">
                            <input type="password" class="form-control" placeholder="Enter password" name="pswd">
                        </div>
                    </div>
                </form>
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
                            <input class="custom-file-input " type="file" name="file" id="gambar" required>
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



    <!-- <script src="https://raw.githubusercontent.com/w3c/IntersectionObserver/master/polyfill/intersection-observer.js">
    </script> -->
    <script type="text/javascript" src="script/script.js"></script>
</body>

</html>