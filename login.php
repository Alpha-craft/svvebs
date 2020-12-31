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
    <title>Login</title>
</head>

<body>

    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <br>
        <button type="submit" name="login">Login!</button>
    </form>
    <a href="register.php">Daftar?</a>
</body>

</html>