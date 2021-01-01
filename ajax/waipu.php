<?php
require '../koneksi.php';
$keyword = $_GET["keyword"];
$sql = "SELECT * FROM waipu WHERE nama LIKE '%$keyword%' OR caption LIKE '%$keyword%' ";
$waipu = mysqli_query($conn,$sql);
?>
<div class="card-columns ">
    <?php foreach ($waipu as $wife) :?>
    <div class="image">
        <div data-toggle="tooltip" title="<?= $wife["nama"] ?>" class="card">

            <a href="target.php?id=<?= $wife["id"] ?>">
                <!-- http://localhost/test/project/svvebs/ -->
                <figure class="progressive">
                    <img id="img<?= $wife['id']?>" class="progressive__img progressive--not-loaded"
                        data-progressive="pict/<?php echo $wife['file'] ?>"
                        data-progressive-sm="pict/<?php echo $wife['file'] ?>" src="pict/<?php echo $wife['file'] ?>"
                        alt="<?= $wife["nama"] ?>">
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