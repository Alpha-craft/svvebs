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
    <title>Register account</title>
</head>

<body>

    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <br>
        <label for="confirmpw">Konfirmasi Password</label>
        <input type="password" name="password2" id="confirmpw">
        <br>
        <button type="submit" name="register">Register!</button>
    </form>


</body>

</html>