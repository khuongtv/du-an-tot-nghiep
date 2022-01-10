<?php
require_once "connection.php";
//Lấy id của categories
$ads_id = $_GET['id'];
//Lấy 8 bản ghi trong bảng product
$sql = "SELECT * FROM likes WHERE ads_id = $ads_id ORDER BY like_id DESC LIMIT 0,8";
$stml = $conn->prepare($sql);
$stml->execute();
$products = $stml->fetchAll(PDO::FETCH_ASSOC);
echo
    count($products);
'số lượng sản phẩm';
// var_dump($product);
// die;
?>
<?php include_once "layout/header.php" ?>
<main>
    <!--List products-->
    <article>
        <?php foreach ($products as $p) : ?>

            <div class="bien" style="width: 24%;float:left ; margin-top:40px ; margin-left: 10px;">
                <div class="card">


                    <div class="containe">
                        <img src="img/<?= $p['like_image'] ?>" width="100%">
                        <div class="middle">
                            <div class="text"><a class="bo" href="">
                                    <button type="button" class="btn btn-danger">thêm vào giỏ</button>

                                </a></div>
                        </div>
                    </div>

                    <div class="card-body7">
                        <div class="card-body">
                            <div class="text0"></div>
                            <p class="card-text9">
                                <h3><?= $p['like_name'] ?></h3>
                            </p>

                            <div class="price"><?= $p['price'] ?></div><br>

                            <button style="background-color: black;"> <a href="chitiet2.php?id=<?= $p['like_id'] ?>" class="btn btn-primary1">MUA NGAY</a></button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>

    </article>
    <!--End list products-->
</main>
<!-- Phần nội dung website -->
<!-- Kết thuc nội dung -->
<?php include_once "layout/footer.php" ?>