<?php
include "koneksi.php";
$id = $_GET["id"];
$sql = "SELECT * FROM waipu WHERE id='$id' ";
$result = mysqli_query($conn,$sql);
$sql1 = "SELECT * FROM waipu ORDER BY id ASC";
$query = mysqli_query($conn,$sql1);

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
    <link rel="stylesheet" href="css/target.css">
    <title>Document</title>

</head>

<body>
    <div class="container">

        <?php foreach($result as $wife): ?>
        <div class="card">
            <a href="target.php?id=<?= $wife["id"] ?>">
                <img style="width:75%;height:auto;margin:auto;display:block;border-radius:30px;"
                    src="pict/<?php echo $wife['file'] ?>" alt="<?= $wife["nama"] ?>">
            </a>
            <div class="card-body">
                <h4 class="card-title"><?= $wife["nama"] ?> </h4>
                <p class="card-text"><?= $wife["caption"] ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <hr>
    <div class="container">
        <div class="card-columns">
            <?php foreach ($query as $sampingan) :?>
            <div class="flip-box">
                <div class="flip-box-inner">
                    <div class="flip-box-front">
                        <div class="card">
                            <img style="width:100%;height:auto;border-radius:30px;" src="pict/<?= $sampingan["file"] ?>"
                                alt="">
                        </div>
                        <!-- tampak depan -->
                    </div>
                    <div class="flip-box-back">
                        <!-- tampak belakang -->
                        <div class="card">

                            <div class="card-title">
                                <?= $sampingan["nama"] ?>
                            </div>
                            <p class="card-text text-center"><?= $sampingan["caption"] ?></p>

                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="card">
                <img src="pict/<?= $sampingan["file"] ?>" alt="<?= $sampingan["nama"] ?>">
                <div class="card-body">
                    <div class="card-title"><?= $sampingan["nama"] ?></div>
                </div>
            </div> -->
            <?php endforeach ?>
        </div>
    </div>
</body>

</html>