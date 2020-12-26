<?php
include "koneksi.php";
$sql = "SELECT * FROM waipu";
$result = mysqli_query($conn,$sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/hampus.css">
    <title>Delete</title>
</head>

<body>
    <table style="width:25%;" border="1">
        <tr>
            <th>No</th>
            <th>Settings</th>
            <th>Judul</th>
            <th>Caption</th>
            <th>Foto</th>
        </tr>
        <?php
        $no = 1;
        ?>
        <?php foreach ($result as $data) :?>
        <tr>
            <td><?= $no ?></td>
            <td><a href="hampus.php?id=<?= $data["id"] ?>">Delete</a></td>
            <td><?= $data["nama"] ?></td>
            <td><?= $data["caption"] ?></td>
            <td><img src="pict/<?= $data["file"] ?>" alt=""></td>
        </tr>
        <?php $no++; ?>
        <?php endforeach ?>
    </table>

</body>

</html>