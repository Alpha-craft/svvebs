<?php
require "koneksi.php";

if(isset($_POST["register"])){
    $username = strtolower( stripcslashes(($_POST["username"])));
    $password = mysqli_real_escape_string($conn,$_POST["password"]);
    $password2 = mysqli_real_escape_string($conn,$_POST["password2"]);
    
    //cek username sudah terdaftar atau belum
    $result = mysqli_query($conn,"SELECT username FROM user WHERE username = '$username' ");
    if(mysqli_fetch_assoc($result)){ //if true maka tidak boleh
        echo "
        <script>
            alert('Username yang akan anda daftarkan sudah terdaftar coba username lain');
        </script>
        ";
        header("Location:register.php");
        return false;
    }


    // cek konfirmasi password
    if ($password !== $password2){
    echo "
    <script>
        alert('Konfirmasi password tidak sesuai');
    </script>
    ";
    // header("Location:register.php");
    return false;
    }
    
    // enkripsi password
    $password = password_hash($password,PASSWORD_DEFAULT);

    //  masukkan kedalam database

    mysqli_query($conn,"INSERT INTO user VALUES (null,'$username','$password') ");


    //cek keberhasilan
    if(mysqli_affected_rows($conn) > 0){
        echo "
        <script>
        alert('User baru telah ditambahkan');
        </script>
        ";
        header("Location:login.php");
    }
    else {
        echo mysqli_error($conn);
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
    <link rel="stylesheet" href="css/login.css">
    <title>Register account</title>
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
                        <div class="form-group col-md-12">
                            <label for="confirmpw">Konfirmasi Password</label>
                            <input class="form-control" type="password" name="password2" id="confirmpw">
                        </div>
                        <br>
                        <button class="btn btn-info col-md-6" type="submit" name="register">Register!</button>
                        <button class="btn btn-danger col-md-6" type="reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>