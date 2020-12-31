<?php

session_start();
if(isset($_SESSION["login"])){ //jika belum login

    // paksa untu login
    header("index.php");
    exit;
}
require "koneksi.php";
if(isset($_POST["login"])){

    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $result = mysqli_query($conn,"SELECT * FROM user WHERE username = '$username' ");

    // cek username apakah sudah ada
    if (mysqli_num_rows($result) === 1){ //mysqli_num_rows untuk menghitung berapa baris yang dikembalikan dari fungsi SELECT dari variabel $result jika ada maka akan me return 1 jika tidak maa 0

        //jia benar

        // cek password 
        $row = mysqli_fetch_assoc($result);
        //menggunakan password_verify 
        // password verify adalah kebalian dari hash password dia mengecek dia mengecek sebuah string dengan hash nya
        // password_verify membutuhkan dua params yang pertama sebuah string dan yang kedua hash dari string tersebut
        if(password_verify($password,$row["password"] ) ){
            //jika sudah diverifikasi 

            //set session
            $_SESSION["login"] = true;

            //arahkan ke halaman lain
            header("Location:index.php");
            exit;
        }
        else{
            echo "
            <script src='https://cdn.jsdelivr.net/npm/promise-polyfill'></script>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@10'></script>
                <script>
                alert('Password atau Username salah');
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    footer: '<a href>Why do I have this issue?</a>'
                  })
                </script>
            ";
        }
        
        
        
    }
    else{
        echo "
            <script>
            alert('Password atau Username salah');
            </script>
        ";
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="box">
            <div class="center">
                <form action="" method="post">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="username">Username:</label>
                            <input class="form-control" type="text" name="username" id="username">
                        </div>
                        <br>
                        <div class="form-group col-md-12">
                            <label for="password">Password:</label>
                            <input class="form-control" type="password" name="password" id="password">
                        </div>
                        <br>
                        <button class="btn btn-info col-md-12 col-sm-12 " type="submit" name="login">Login <i
                                class="las la-sign-in-alt"></i></button>
                    </div>
                </form>

                <h4><a href="register.php">Daftar<i class="las la-user-plus"></i></a></h4>
            </div>
        </div>
    </div>
</body>

</html>